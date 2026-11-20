/*
 * Hero background PT Avencore Technology
 * Partikel biru mengambang + garis jaringan di <canvas id="heroCanvas">.
 * Ringan: jeda saat tab disembunyikan / hero keluar layar, DPR dibatasi,
 * jumlah partikel menyesuaikan luas layar, dan menghormati prefers-reduced-motion.
 */
(function () {
    'use strict';

    var canvas = document.getElementById('heroCanvas');
    if (!canvas || !canvas.getContext) { return; }

    var hero = canvas.closest('.av-hero') || canvas.parentElement;
    var ctx = canvas.getContext('2d');
    var motionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');

    var COLORS = ['22,119,255', '22,119,255', '90,162,255']; // biru elektrik + satu varian lebih terang
    var particles = [];
    var w = 0, h = 0, dpr = 1;
    var linkDist = 130;
    var isMobile = false;
    var running = false, inView = true;
    var rafId = 0, last = 0, minFrame = 0;
    var resizeTimer = 0;

    // Sprite glow dibuat sekali, lalu dipakai ulang (jauh lebih murah daripada shadowBlur)
    var sprite = (function () {
        var s = document.createElement('canvas');
        s.width = s.height = 64;
        var c = s.getContext('2d');
        var g = c.createRadialGradient(32, 32, 0, 32, 32, 32);
        g.addColorStop(0, 'rgba(22,119,255,0.9)');
        g.addColorStop(0.4, 'rgba(22,119,255,0.25)');
        g.addColorStop(1, 'rgba(22,119,255,0)');
        c.fillStyle = g;
        c.fillRect(0, 0, 64, 64);
        return s;
    })();

    function rand(min, max) { return min + Math.random() * (max - min); }
    function clamp(v, min, max) { return Math.max(min, Math.min(max, v)); }

    function createParticle() {
        var angle = Math.random() * Math.PI * 2;
        var speed = rand(6, 20); // px per detik
        return {
            x: Math.random() * w,
            y: Math.random() * h,
            vx: Math.cos(angle) * speed,
            vy: Math.sin(angle) * speed,
            r: rand(0.8, 2.2),
            color: COLORS[Math.floor(Math.random() * COLORS.length)],
            phase: Math.random() * Math.PI * 2,
            twinkle: rand(0.0006, 0.0016)
        };
    }

    function resize() {
        var rect = hero.getBoundingClientRect();
        var oldW = w, oldH = h;
        w = Math.max(1, Math.round(rect.width));
        h = Math.max(1, Math.round(rect.height));
        dpr = Math.min(window.devicePixelRatio || 1, 2);

        canvas.width = Math.round(w * dpr);
        canvas.height = Math.round(h * dpr);
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

        isMobile = w < 768;
        linkDist = isMobile ? 95 : 135;
        minFrame = isMobile ? 1000 / 40 : 0; // di HP dibatasi ~40 fps

        var target = Math.round((w * h) / (isMobile ? 20000 : 13000));
        target = clamp(target, isMobile ? 22 : 36, isMobile ? 44 : 90);

        // sesuaikan posisi lama dengan ukuran baru
        if (oldW && oldH) {
            for (var i = 0; i < particles.length; i++) {
                particles[i].x *= w / oldW;
                particles[i].y *= h / oldH;
            }
        }
        while (particles.length < target) { particles.push(createParticle()); }
        if (particles.length > target) { particles.length = target; }

        if (motionQuery.matches) { draw(performance.now()); }
    }

    function step(dt) {
        var maxSpeed = 24, minSpeed = 5;
        for (var i = 0; i < particles.length; i++) {
            var p = particles[i];

            // belokan acak halus supaya gerakan terasa natural
            p.vx += (Math.random() - 0.5) * 10 * dt;
            p.vy += (Math.random() - 0.5) * 10 * dt;

            var sp = Math.sqrt(p.vx * p.vx + p.vy * p.vy) || 0.0001;
            if (sp > maxSpeed) { p.vx = p.vx / sp * maxSpeed; p.vy = p.vy / sp * maxSpeed; }
            else if (sp < minSpeed) { p.vx = p.vx / sp * minSpeed; p.vy = p.vy / sp * minSpeed; }

            p.x += p.vx * dt;
            p.y += p.vy * dt;

            if (p.x < -10) { p.x = w + 10; } else if (p.x > w + 10) { p.x = -10; }
            if (p.y < -10) { p.y = h + 10; } else if (p.y > h + 10) { p.y = -10; }
        }
    }

    function draw(t) {
        ctx.clearRect(0, 0, w, h);

        // garis penghubung antar partikel yang berdekatan
        var ld2 = linkDist * linkDist;
        ctx.lineWidth = 1;
        for (var i = 0; i < particles.length; i++) {
            var a = particles[i];
            for (var j = i + 1; j < particles.length; j++) {
                var b = particles[j];
                var dx = a.x - b.x, dy = a.y - b.y;
                var d2 = dx * dx + dy * dy;
                if (d2 < ld2) {
                    var alpha = (1 - Math.sqrt(d2) / linkDist) * 0.38;
                    ctx.strokeStyle = 'rgba(22,119,255,' + alpha.toFixed(3) + ')';
                    ctx.beginPath();
                    ctx.moveTo(a.x, a.y);
                    ctx.lineTo(b.x, b.y);
                    ctx.stroke();
                }
            }
        }

        // partikel: glow lembut + titik inti
        for (var k = 0; k < particles.length; k++) {
            var p = particles[k];
            var tw = 0.65 + 0.35 * Math.sin(t * p.twinkle + p.phase);
            var gs = p.r * 9;

            ctx.globalAlpha = 0.45 * tw;
            ctx.drawImage(sprite, p.x - gs / 2, p.y - gs / 2, gs, gs);

            ctx.globalAlpha = 0.95 * tw;
            ctx.fillStyle = 'rgb(' + p.color + ')';
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
            ctx.fill();
        }
        ctx.globalAlpha = 1;
    }

    function loop(ts) {
        if (!running) { return; }
        rafId = requestAnimationFrame(loop);
        if (ts - last < minFrame) { return; }
        var dt = Math.min((ts - last) / 1000, 0.05);
        last = ts;
        step(dt);
        draw(ts);
    }

    function start() {
        if (running || motionQuery.matches || document.hidden || !inView) { return; }
        running = true;
        last = performance.now();
        rafId = requestAnimationFrame(loop);
    }

    function stop() {
        running = false;
        if (rafId) { cancelAnimationFrame(rafId); rafId = 0; }
    }

    function onMotionChange() {
        if (motionQuery.matches) { stop(); draw(performance.now()); }
        else { start(); }
    }

    function onResize() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(resize, 150);
    }

    // inisialisasi
    resize();
    if (motionQuery.matches) { draw(performance.now()); } else { start(); }

    // jeda saat hero tidak terlihat (hemat baterai)
    if ('IntersectionObserver' in window) {
        new IntersectionObserver(function (entries) {
            inView = entries[0].isIntersecting;
            if (inView) { start(); } else { stop(); }
        }, { threshold: 0 }).observe(hero);
    }

    document.addEventListener('visibilitychange', function () {
        if (document.hidden) { stop(); } else { start(); }
    });

    if ('ResizeObserver' in window) { new ResizeObserver(onResize).observe(hero); }
    else { window.addEventListener('resize', onResize); }

    if (motionQuery.addEventListener) { motionQuery.addEventListener('change', onMotionChange); }
    else if (motionQuery.addListener) { motionQuery.addListener(onMotionChange); }
})();
