@props(['listing', 'purchase' => null])

<div class="list-group-item d-flex align-items-center justify-content-between flex-wrap">
    <a href="{{ route('listing.show', $listing->id) }}" class="d-flex align-items-center text-decoration-none flex-grow-1">
        @if($listing->image)
            <img src="{{ url('images/' . $listing->image) }}" alt="{{ $listing->title }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px; margin-right: 16px;">
        @endif
        <div>
            <div class="fw-bold">{{ $listing->title }}</div>
            <div class="text-muted small">{{ $listing->category->name ?? '' }}</div>
            @if($purchase)
                <div class="text-muted small">{{ __('messages.purchased_on', ['date' => $purchase->created_at->diffForHumans()]) }}</div>
            @endif
        </div>
    </a>
    <div class="d-flex align-items-center gap-2 ms-3">
        <span class="fw-bold text-primary">€{{ number_format($listing->price, 2) }}</span>
        @can('update', $listing)
            <a href="{{ route('listing.edit', $listing->id) }}" class="btn btn-sm btn-warning">{{ __('messages.edit') }}</a>
        @endcan
        @can('delete', $listing)
            <form method="POST" action="{{ route('listing.destroy', $listing->id) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this listing?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">{{ __('messages.delete') }}</button>
            </form>
        @endcan
    </div>
</div>