<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="BPS Kabupaten Probolinggo">
    <title>Pendaftaran {{$survey->name}} - Aplikasi Mitra BPS Kabupaten Probolinggo</title>
    <!-- Favicon -->
    <link rel="icon" href="/assets/img/brand/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="/assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="/assets/css/argon.css?v=1.1.0" type="text/css">
    <link rel="stylesheet" href="/assets/style.css" type="text/css">

    <!-- <script src="https://accounts.google.com/gsi/client" async defer></script> -->
</head>

<body class="bg-default">
    <!-- Navbar -->
    <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="/pages/dashboards/dashboard.html">
                                <img src="/assets/img/brand/blue.png">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="/pages/dashboards/dashboard.html" class="nav-link">
                            <span class="nav-link-inner--text">Panduan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-6 py-lg-6 pt-lg-9">
            <div class="container">
                <div class="header-body text-center mb-6">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <img src="/assets/img/bps.svg" class="logosurveyregister">
                            <h2 class="text-white">Aplikasi Mitra BPS Kabupaten Probolinggo</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card bg-secondary border-0 mb-0">
                            <div class="card-header bg-transparent pb-5">
                                <div class="text-muted text-center mt-2 mb-3"><small>Anda Akan Melakukan Pendaftaran: </small></div>
                                <div class="text-muted text-center mt-2 mb-3">
                                    <span class="badge badge-lg badge-success">{{$survey->name}}</span>
                                </div>
                                <div class="text-muted text-center mt-2 mb-3"><small>Sebelum Mendaftar, Anda Harus Login Terlebih Dahulu</small></div>
                                <div class="btn-wrapper text-center">
                                    <a href="/auth/redirect" class="btn btn-neutral btn-icon btn-block">
                                        <span class="btn-inner--icon"><img src="/assets/img/icons/common/google.svg"></span>
                                        <span class="btn-inner--text">Google</span>
                                    </a>
                                </div>
                                <!-- <div id="g_id_onload" data-client_id="1039896322538-k9hgc3govclgss9uv638p1h8en31eo7f.apps.googleusercontent.com" data-context="signin" data-ux_mode="redirect" data-callback="handleCredentialResponse" data-auto_prompt="false">
                                </div>
                                <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline" data-text="continue_with" data-size="large" data-logo_alignment="left">
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer id="footer-main" class="py-5">
        <div class="container">
            <div class="row justify-content-xl-between align-items-center">
                <div class="col-xl-12">
                    <div class="copyright text-center text-muted">
                        © 2021 Badan Pusat Statistik Kabupaten Probolinggo
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Argon JS -->
    <script src="/assets/js/argon.js?v=1.1.0"></script>
    <!-- Demo JS - remove this in your project -->
    <script src="/assets/js/demo.min.js"></script>

    <!-- <script>
        function handleCredentialResponse(response) {
            // decodeJwtResponse() is a custom function defined by you
            // to decode the credential response.
            const responsePayload = decodeJwtResponse(response.credential);

            console.log("ID: " + responsePayload.sub);
            console.log('Full Name: ' + responsePayload.name);
            console.log('Given Name: ' + responsePayload.given_name);
            console.log('Family Name: ' + responsePayload.family_name);
            console.log("Image URL: " + responsePayload.picture);
            console.log("Email: " + responsePayload.email);
        }
    </script> -->
</body>

</html>