<x-layout>
    <div class="container py-4">
        <x-slot name="title">
            {{ __('messages.my_purchases') }}
        </x-slot>

        <h2 class="mb-4">{{ __('messages.my_purchases') }}</h2>

        <form method="get" action="{{ route('purchases.index') }}" class="mb-4">
            <div class="row g-2 align-items-center">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="{{ __('messages.search_listings') }}" value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="category_id" class="form-select">
                        <option value="">{{ __('messages.all_categories') }}</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">{{ __('messages.filter') }}</button>
                </div>
            </div>
        </form>

        @if($purchases->count())
            <div class="list-group">
                @foreach($purchases as $purchase)
                    <x-item-row :listing="$purchase->listing" :purchase="$purchase" />
                @endforeach
            </div>
            <div class="mt-4">
                {{ $purchases->appends(['filter' => $filter, 'search' => $search, 'category' => $category, 'sort' => $sort])->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="alert alert-info mt-4">
                {{ __('messages.no_purchases') }}
            </div>
        @endif
    </div>
</x-layout>