<x-layout>
    <x-slot name="title">
        {{ __('messages.browse_listings') }}
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-between align-items-center mb-4">
            <div class="col-auto">
                <h1 class="mb-0 fw-bold">
                    <i class="bi bi-box-seam me-2"></i>
                    {{ __('messages.browse_listings') }}
                </h1>
            </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6 col-lg-4 mb-2 mb-md-0">
                <form method="get" class="d-flex">
                    <input type="hidden" name="filter" value="{{ $filter ?? 'available' }}">
                    <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control me-2" placeholder="{{ __('messages.search_listings') }}">
                    <button type="submit" class="btn btn-primary">{{ __('messages.search') }}</button>
                </form>
                </div>
                <div class="col-md-4 col-lg-3">
                    <form method="get" class="d-flex">
                        <select name="filter" onchange="this.form.submit()" class="form-select me-2" style="width:auto; min-width:fit-content;">
                            <option value="available" {{ ($filter ?? 'available') === 'available' ? 'selected' : '' }}>{{ __('messages.available') }}</option>
                            <option value="purchased" {{ ($filter ?? '') === 'purchased' ? 'selected' : '' }}>{{ __('messages.purchased') }}</option>
                            <option value="all" {{ ($filter ?? '') === 'all' ? 'selected' : '' }}>{{ __('messages.all') }}</option>
                        </select>
                        <select name="category" onchange="this.form.submit()" class="form-select me-2" style="width:auto; min-width:fit-content;">
                            <option value="">{{ __('messages.all_categories') }}</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ ($category ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <select name="sort" onchange="this.form.submit()" class="form-select" style="width:auto; min-width:fit-content;">
                            <option value="">{{ __('messages.sort_by') }}</option>
                            <option value="price_asc" {{ ($sort ?? '') === 'price_asc' ? 'selected' : '' }}>{{ __('messages.price_low_high') }}</option>
                            <option value="price_desc" {{ ($sort ?? '') === 'price_desc' ? 'selected' : '' }}>{{ __('messages.price_high_low') }}</option>
                            <option value="date_asc" {{ ($sort ?? '') === 'date_asc' ? 'selected' : '' }}>{{ __('messages.date_oldest') }}</option>
                            <option value="date_desc" {{ ($sort ?? '') === 'date_desc' ? 'selected' : '' }}>{{ __('messages.date_newest') }}</option>
                        </select>
                        @if(!empty($search))
                            <input type="hidden" name="search" value="{{ $search }}">
                        @endif
                    </form>
                </div>
            </div>
        </div>

        @if ($listings->count())
            <div class="row g-4">
                @foreach ($listings as $listing)
                    <div class="col-md-6 col-lg-4 d-flex">
                        <x-item-card :listing="$listing" class="flex-fill shadow-sm rounded-4 border-0" />
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $listings->appends(['filter' => $filter, 'search' => $search, 'category' => $category, 'sort' => $sort])->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="alert alert-info text-center py-5">
                {{ __('messages.no_items') }}
            </div>
        @endif
    </div>
</x-layout>