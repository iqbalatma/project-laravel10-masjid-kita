<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? "Title" }}</title>

    <link rel="stylesheet" href="{{ asset('mazer/dist/assets/css/main/app.css') }}">

    <link rel="shortcut icon" href="{{ asset('mazer/dist/assets/images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('mazer/dist/assets/images/logo/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                                <h3>{{ $title ?? "Default Title" }}</h3>
                                <p class="text-subtitle text-muted">{{ $description ?? "Default description" }}</p>
                            </div>
                            <x-dashboard.breadcumb></x-dashboard.breadcumb>
                        </div>
                    </div>
                    <x-alert></x-alert>
                    <section class="section">
                        {{ $slot }}
                    </section>
                </div>

                <x-dashboard.footer></x-dashboard.footer>
            </div>
        </div>
    </div>
    @vite("resources/js/app.js")
    <script src="{{ asset('mazer/dist/assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('mazer/dist/assets/js/app.js') }}"></script>

    @stack('scripts')
</body>

</html>
