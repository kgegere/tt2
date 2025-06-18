<x-layout>
    <x-slot name="title">{{ __('messages.edit_listing') }}</x-slot>
    <div class="container py-4">
        <h2>{{ __('messages.edit_listing') }}</h2>

        @if ($errors->any())
            <div class="container py-2">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('messages.close')}}"></button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        

        <form method="POST" action="{{ route('listing.update', $listing->id) }}" enctype="multipart/form-data" class="mt-4">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">{{ __('messages.title_label') }}</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title', $listing->title) }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('messages.description') }}</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $listing->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('messages.price') }}</label>
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" step="1"
                       value="{{ old('price', $listing->price) }}">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('messages.category') }}</label>
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    <option value="">{{ __('messages.choose_category') }}</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $listing->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('messages.image') }}</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                @if($listing->image)
                    <div class="mt-2">
                        <img src="{{ url('images/' . $listing->image) }}" alt="{{ __('messages.current_image') }}" style="max-width: 120px; max-height: 120px;">
                        <div class="text-muted small">{{ __('messages.current_image') }}</div>
                    </div>
                @endif
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('messages.update_listing') }}</button>
        </form>
    </div>
</x-layout>