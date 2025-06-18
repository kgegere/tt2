<div @class([ 'card' , 'mb-3' , 'shadow-sm' , 'bg-light text-muted' => $listing->is_purchased, ]) @style([ 'opacity: 0.6;' => $listing->is_purchased, ])>
    @if($listing->image)
    <div class="square-image-container">
        <a href="{{ route('listing.show', $listing->id) }}">
            <img src="{{ url('images/' . $listing->image) }}" alt="{{ $listing->title }}">
        </a>
    </div>
    @endif
    <div class="card-body">
        <h5 class="card-title">{{ $listing->title }}</h5>
        <ul class="list-unstyled mb-3">
            <li><strong>{{ __('messages.price') }}:</strong> ${{ number_format($listing->price, 2) }}</li>
            <li><strong>{{ __('messages.posted') }}:</strong> {{ $listing->created_at?->diffForHumans() }}</li>
            <li><strong>{{ __('messages.status') }}:</strong> {{ $listing->is_purchased ? __('messages.purchased') : __('messages.available') }}</li>
        </ul>
        <a href="{{ route('listing.show', $listing->id) }}" class="btn btn-primary">{{ __('messages.view') }}</a>
    </div>
</div>