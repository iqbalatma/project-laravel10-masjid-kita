<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vertical Navbar - Mazer Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('mazer/dist/assets/css/main/app.css') }}">

    <link rel="shortcut icon" href="{{ asset('mazer/dist/assets/images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('mazer/dist/assets/images/logo/favicon.png') }}" type="image/png">
</head>

<body>
    <div id="app">
        <x-dashboard.sidebar></x-dashboard.sidebar>
        <div id="main" class='layout-navbar'>
            <x-dashboard.header></x-dashboard.header>
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Vertical Layout with Navbar</h3>
                                <p class="text-subtitle text-muted">Navbar will appear on the top of the page.</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Layout Vertical Navbar</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        {{ $slot }}
                    </section>
                </div>

                <x-dashboard.footer></x-dashboard.footer>
            </div>
        </div>
    </div>
    <script src="{{ asset('mazer/dist/assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('mazer/dist/assets/js/app.js') }}"></script>

</body>

</html>
