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
    </style>
</head>

<body>
    <x-navbar />
    <main class="container">
        {{ $slot }}
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>