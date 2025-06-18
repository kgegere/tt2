<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <style>
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

        .square-image-container {
            width: 100%;
            aspect-ratio: 1 / 1;
            background: #f8f9fa;
            overflow: hidden;
            display: flex;
            align-items: stretch;
            justify-content: stretch;
        }

        .square-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            /* The following two lines FORCE upscaling of small images */
            min-width: 100%;
            min-height: 100%;
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

        /* Add more as needed for your UI */
    </style>
</head>

<body>
    <x-navbar />
    <main class="container">
        {{ $slot }}
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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