<x-layout>
    <x-slot name="title">
        {{ __('messages.login_title') }}
    </x-slot>
    <h1 class="mb-4">{{ __('messages.login_title') }}</h1>
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
    <form method="POST" action="{{ route('login') }}" class="mt-3" style="max-width:400px;">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('messages.email_address') }}</label>
            <input type="text" name="email" id="email" class="form-control" autofocus value="{{ old('email') }}">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('messages.password') }}</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.login') }}</button>
    </form>
</x-layout>