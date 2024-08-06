<!-- resources/views/layouts/auth.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>State Wildlife Crime Management System (SWCMS)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="State Wildlife Crime Management System(SWCMS)" name="description" />
    <meta content="State Wildlife Crime Management System(SWCMS)" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{ asset('assets/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<body class="loading auth-fluid-pages pb-0">
    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="text-center">
                        <div class="auth-logo">
                            <a href="index.html" class="logo logo-dark text-center">
                                <span class="logo-lg text-center">
                                    <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="150">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light text-center">
                                <span class="logo-lg">
                                    <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="22">
                                </span>
                            </a>
                        </div>
                    </div>
                    <!-- title-->
                    <h3 class="mt-10 text-success" align="center">Log In </h3>
                    <p class="text-black mb-4">Enter your user name and password to access account.</p>
                    <!-- Main content -->
                    @yield('content')
                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <p class="text-muted">Powered by <a href="#" class="text-muted ms-1"><b>ORSAC</b></a></p>
                    </footer>
                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->
        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h1 class="mb-3 text-white">State Wildlife Crime Management System (SWCMS)</h1>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->
    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>
</html>
