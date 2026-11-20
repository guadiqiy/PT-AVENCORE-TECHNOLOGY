<a href="{{ route('services.show', $service->slug) }}" class="av-card text-decoration-none">
    <div class="av-thumb">
        @if ($service->image_url)
            <img src="{{ $service->image_url }}" alt="{{ $service->name }}" loading="lazy">
        @else
            <img src="{{ asset('images/logo-icon.png') }}" alt="" class="ph">
        @endif
    </div>
    <div class="av-card-body">
        <span class="av-tag">{{ $service->category->name }}</span>
        <h3>{{ $service->name }}</h3>
        <p>{{ $service->summary }}</p>
        <div class="av-card-foot">
            <span class="av-price">{{ $service->price_label }}</span>
            <span class="av-more">Lihat detail</span>
        </div>
    </div>
</a>
