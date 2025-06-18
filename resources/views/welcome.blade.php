<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>shNOp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .main-content {
            margin: 40px auto 0 auto;
            padding: 2rem;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
            max-width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 1.5rem;
            color: #1a202c;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            margin: 1rem 0;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn:hover,
        .btn:focus {
            color: #fff !important;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .search-box {
            margin-top: 1.5rem;
        }

        .search-box input[type="text"] {
            padding: 0.5rem;
            width: 70%;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            font-size: 1rem;
        }

        .search-box button {
            padding: 0.5rem 1rem;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 4px;
            margin-left: 0.5rem;
            cursor: pointer;
            opacity: 1;
            transition: background 0.2s;
        }

        .search-box button:hover {
            background: #1d4ed8;
        }

        .note {
            color: #64748b;
            font-size: 0.95rem;
            margin-top: 0.5rem;
        }

        .recent-listings {
            margin-top: 2rem;
            text-align: left;
        }

        .recent-listings h2 {
            font-size: 1.2rem;
            color: #1a202c;
            margin-bottom: 1rem;
        }

        .listing-item {
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .listing-item strong {
            display: block;
            margin-bottom: 0.5rem;
        }

        .listing-item span {
            color: #64748b;
            font-size: 0.95rem;
        }

        .d-grid {
            display: grid;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .btn-outline-primary {
            background: transparent;
            color: #2563eb;
            border: 1px solid #2563eb;
        }

        .btn-outline-primary:hover {
            background: #2563eb;
            color: #fff;
        }

        .btn-outline-secondary {
            background: transparent;
            color: #4b5563;
            border: 1px solid #d1d5db;
        }

        .btn-outline-secondary:hover {
            background: #f3f4f6;
        }

        .btn-outline-dark {
            background: transparent;
            color: #111827;
            border: 1px solid #374151;
        }

        .btn-outline-dark:hover {
            background: #374151;
            color: #fff;
        }

        .recent-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .recent-grid-item {
            aspect-ratio: 1 / 1;
            min-width: 0;
            min-height: 0;
            max-width: 100%;
            max-height: 100%;
            background: #f1f5f9;
        }

        .navbar.bg-light {
            background-color: #007bff !important;
            /* Bootstrap primary blue */
        }

        .navbar .navbar-brand,
        .navbar .nav-link {
            color: #fff !important;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link:focus {
            color: #cce5ff !important;
        }

        .navbar .nav-link.btn-link {
            color: #fff !important;
            background: none !important;
            border: none;
            box-shadow: none;
            text-decoration: none;
            cursor: pointer;
            font-weight: 400;
            padding: 0.5rem 1rem;
            transition: color 0.2s;
        }

        .navbar .nav-link.btn-link:hover,
        .navbar .nav-link.btn-link:focus {
            color: #cce5ff !important;
            background: none !important;
            text-decoration: none;
        }

        body.dark-mode {
            background: #181a1b !important;
            color: #e0e0e0 !important;
        }
        body.dark-mode .navbar.bg-light {
            background-color: #222831 !important;
        }
        body.dark-mode .navbar .navbar-brand,
        body.dark-mode .navbar .nav-link {
            color: #e0e0e0 !important;
        }
        body.dark-mode .navbar .nav-link:hover,
        body.dark-mode .navbar .nav-link:focus {
            color: #ffd369 !important;
        }
        body.dark-mode .main-content,
        body.dark-mode .card,
        body.dark-mode .list-group-item,
        body.dark-mode .modal-content {
            background: #23272b !important;
            color: #e0e0e0 !important;
            border-color: #393e46 !important;
        }
        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background: #23272b !important;
            color: #e0e0e0 !important;
            border-color: #393e46 !important;
        }
        body.dark-mode .btn-primary,
        body.dark-mode .btn-outline-primary {
            background: #393e46 !important;
            color: #ffd369 !important;
            border-color: #ffd369 !important;
        }
        body.dark-mode .btn-primary:hover,
        body.dark-mode .btn-outline-primary:hover {
            background: #ffd369 !important;
            color: #23272b !important;
        }
        body.dark-mode .alert {
            background: #23272b !important;
            color: #ffd369 !important;
            border-color: #ffd369 !important;
        }
        body.dark-mode .recent-grid-item {
            background: #23272b !important;
        }
        body.dark-mode .square-image-container {
            background: #23272b !important;
        }
        body.dark-mode,
        body.dark-mode h1,
        body.dark-mode h2 {
            color: #e0e0e0 !important;
        }
    </style>
</head>

<body>
    <x-navbar />
    <div class="main-content">
        <h1>{{ __('messages.title') }}</h1>
        <p class="note" style="margin-bottom: 1.5rem;">
            {{ __('messages.subtitle') }}
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center;">
            <a href="{{ url('/listing') }}" class="btn">{{ __('messages.browse_listings') }}</a>
            @if(auth()->check() && (auth()->user()->isSeller() || auth()->user()->isAdmin()))
            <a href="{{ route('listing.create') }}" class="btn btn-outline-primary">{{ __('messages.create_listing') }}</a>
            @endif
        </div>
        <div class="search-box">
            <form method="get" action="{{ url('/listing') }}">
                <input type="text" name="search" placeholder="{{ __('messages.search_listings') }}" value="{{ request('search') }}">
                <button type="submit">{{ __('messages.search') }}</button>
            </form>
            <form action="{{ route('listings.lucky') }}" method="get">
                <a href="#" class="note" style="display:inline-block; cursor:pointer;" onclick="this.closest('form').submit(); return false;">
                    {{ __('messages.im_feeling_lucky') }}
                </a>
            </form>
        </div>

        <?php if (isset($recentListings) && $recentListings->count()): ?>
            <div class="recent-listings">
                <h2>{{ __('messages.recently_viewed_items') }}</h2>
                <div class="recent-grid">
                    <?php foreach ($recentListings as $listing): ?>
                        <?php if ($listing->image): ?>
                            <a href="{{ url('/listing/' . $listing->id) }}"
                                class="border rounded overflow-hidden bg-light text-center recent-grid-item"
                                style="display: flex; align-items: center; justify-content: center;">
                                <img
                                    src="{{ url('images/' . $listing->image) }}"
                                    alt="{{ $listing->title }}"
                                    style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1 / 1; display: block;">
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Detect system preference on first visit
        function getPreferredTheme() {
            if (localStorage.getItem('darkMode')) {
                return localStorage.getItem('darkMode') === 'true';
            }
            return window.matchMedia('(prefers-color-scheme: dark)').matches;
        }

        function setDarkMode(enabled) {
            document.body.classList.toggle('dark-mode', enabled);
            localStorage.setItem('darkMode', enabled ? 'true' : 'false');
            // Update icon/text
            const icon = document.getElementById('darkModeIcon');
            const text = document.getElementById('darkModeText');
            if (icon) {
                icon.className = enabled ? 'bi bi-moon-fill' : 'bi bi-sun-fill';
            }
            if (text) {
                text.textContent = enabled ? 'Light mode' : 'Dark mode';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Set initial mode
            setDarkMode(getPreferredTheme());

            // Toggle on click
            const toggle = document.getElementById('darkModeToggle');
            if (toggle) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const enabled = !document.body.classList.contains('dark-mode');
                    setDarkMode(enabled);
                });
            }
        });
    </script>
    <!-- Bootstrap Icons CDN for sun/moon icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</body>

</html>