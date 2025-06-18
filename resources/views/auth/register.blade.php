<x-layout>
    <x-slot name="title">
        {{ __('messages.register_title') }}
    </x-slot>
    <h1 class="mb-4">{{ __('messages.register_title') }}</h1>
    @if ($errors->any())
        <div class="container py-2">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{!! $error !!}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('messages.close')}}"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('messages.full_name') }}</label>
            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name') <small class="text-danger">{!! $message !!}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('messages.email_address') }}</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
            @error('email') <small class="text-danger">{!! $message !!}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">{{ __('messages.address') }}</label>
            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
            @error('address') <small class="text-danger">{!! $message !!}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('messages.password') }}</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password') <small class="text-danger">{!! $message !!}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('messages.confirm_password') }}</label>
            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
            @error('password_confirmation') <small class="text-danger">{!! $message !!}</small> @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.register') }}</button>
    </form>
</x-layout>