<x-layout>
    <div class="container py-4">
        <x-slot name="title">
            {{ $user->id === auth()->id() ? __('messages.user_profile') : $user->name." – ".__('messages.user_profile') }}
        </x-slot>
        <h2 class="mb-4">
            {{ __('messages.user_profile') }}
        </h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

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

        <form method="POST" action="{{ route('user.update') }}" class="mb-4">
            @csrf
            @if(auth()->user()->isAdmin())
                <div class="mb-3">
                    <label>{{ __('messages.user_id') }}</label>
                    <input class="form-control" value="{{ $user->id }}" readonly>
                </div>
                <div class="mb-3">
                    <label>{{ __('messages.role') }}</label>
                    <input class="form-control" value="{{ __('messages.' . $user->role) }}" readonly>
                </div>
            @endif
            <div class="mb-3">
                <label>{{ __('messages.name') }}</label>
                <input name="name" class="form-control" value="{{ old('name', $user->name) }}" >
            </div>
            <div class="mb-3">
                <label>{{ __('messages.email') }}</label>
                <input name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="mb-3">
                <label>{{ __('messages.address') }}</label>
                <input name="address" class="form-control" value="{{ old('address', $user->address) }}" required>
            </div>
            <div class="mb-3">
                <label>{{ __('messages.new_password') }} <span class="text-muted">{{ __('messages.leave_blank_to_keep') }}</span></label>
                <input name="password" type="password" class="form-control" autocomplete="new-password">
            </div>
            <div class="mb-3">
                <label>{{ __('messages.confirm_new_password') }}</label>
                <input name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
            </div>
            <button class="btn btn-primary">{{ __('messages.update_profile') }}</button>
        </form>

        @if($user->id === auth()->id())
            @if(($user->isSeller() || $user->isAdmin()) && Route::currentRouteName() === 'user.profile')
                <hr>
                <h4>{{ __('messages.promote_user_to_seller') }}</h4>
                <form method="POST" action="{{ route('user.promote') }}">
                    @csrf
                    <div class="mb-3">
                        <label>{{ __('messages.email_of_user_to_promote') }}</label>
                        <input name="email" type="email" class="form-control" required>
                    </div>
                    <button class="btn btn-warning">{{ __('messages.promote_to_seller') }}</button>
                </form>
            @endif
        @else
            @if(auth()->user()->isAdmin() && $user->role !== 'seller')
                <hr>
                <form method="POST" action="{{ route('user.promote') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <button class="btn btn-warning">{{ __('messages.promote_this_user_to_seller') }}</button>
                </form>
            @endif
        @endif

        @if(auth()->user()->isAdmin() && $user->promoted_by)
            <hr>
            <div class="alert alert-info mt-3">
            @php
                $promoter = \App\Models\User::find($user->promoted_by);
            @endphp
            {{ __('messages.promoted_by', ['id' => $user->promoted_by, 'name' => $promoter?->name]) }}
            </div>
        @endif

        @if(auth()->user()->isAdmin() && $user->role === 'seller')
            <form method="POST" action="{{ route('user.demote') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <button class="btn btn-danger mt-3">{{ __('messages.demote_this_user_to_buyer') }}</button>
            </form>
        @endif
    </div>
</x-layout>