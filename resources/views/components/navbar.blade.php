@if(auth()->check() && auth()->user()->isAdmin())
<nav class="navbar navbar-expand-xl navbar-light bg-light mb-4">
@else
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
@endif
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">{{ __('messages.title') }}</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="box-shadow: none;">
            <span class="navbar-toggler-icon" style="background-image: url('data:image/svg+xml;utf8,<svg viewBox=\'0 0 30 30\' xmlns=\'http://www.w3.org/2000/svg\'><path stroke=\'rgba(255,255,255,1)\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-miterlimit=\'10\' d=\'M4 7h22M4 15h22M4 23h22\'/></svg>');"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                @if(auth()->check())
                <li class="nav-item">
                    @php
                        $name = Auth::user()->name ?? '';
                        // Latvian: remove last character if it is 's' or 'š'
                        if (app()->getLocale() === 'lv' && in_array(mb_substr($name, -1), ['s', 'š'])) {
                            $name = mb_substr($name, 0, mb_strlen($name) - 1);
                        }
                    @endphp
                    <a class="nav-link" href="{{ route('user.profile') }}">
                        {{ __('messages.hello_user', ['name' => $name]) }}
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/listing') }}">{{ __('messages.browse_listings') }}</a>
                </li>
                @auth
                @can('create', new \App\Models\Listing)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('listing.create') }}">{{ __('messages.create_listing') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('listing.mine') }}">{{ __('messages.my_listings') }}</a>
                </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('purchases.index') }}">{{ __('messages.my_purchases') }}</a>
                </li>
                @if(auth()->check() && auth()->user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users') }}">{{ __('messages.user_management') }}</a>
                    </li>
                @endif
                <li class="nav-item d-flex align-items-center">
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link p-0"
                            style="background: none; border: none; color: #fff; line-height: 1.5;">
                            {{ __('messages.logout') }}
                        </button>
                    </form>
                </li>
                @endauth
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('messages.register') }}</a>
                </li>
                @endguest
                <li class="nav-item">
                    @if(app()->getLocale() === 'en')
                        <a class="nav-link" href="{{ route('lang.switch', 'lv') }}" style="font-variant: small-caps;">lv</a>
                    @else
                        <a class="nav-link" href="{{ route('lang.switch', 'en') }}" style="font-variant: small-caps;">en</a>
                    @endif
                </li>
                <li class="nav-item">
                    <button id="darkModeToggle" class="nav-link btn btn-link p-0" style="background:none; border:none;">
                        <span id="darkModeIcon" class="bi"></span>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>