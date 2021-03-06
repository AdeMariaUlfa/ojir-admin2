<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('template_utama/img/ojir.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('template_utama/img/ojir.png') }}">
    <title>
        Admin Ojir
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('template_utama/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('template_utama/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('template_utama/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('template_utama/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
</head>

<body class="bg-dark">
    <!-- //isi menu di atas -->
    <main class="main-content  mt-0">
        @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message}}
        </div>
        @endif
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-light">
                                    <h3 class="font-weight-bolder text-info text-gradient">Welcome Back - Ojir Website </h3>
                                    <p class="mb-0">Enter your email and password</p>
                                </div>
                                <div class="card-body bg-light">
                                    <form role="form" action="{{ route('firebaseLogin') }}" method="POST" 
                                          enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" aria-label="email" aria-describedby="user-addon">
                                        </div>
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <div class="mb-3">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Login</button>
                                        </div>
                                    </form><br>
                                    <small class="d-block text-center mt-3">Bank sampah belum terdaftar?
                                        <a href="{{ route('register') }}">Daftar disini !</a>
                                    </small>
                                    <small class="d-block text-center mt-3">Belum daftar sebagai member?
                                        <a href="{{ route('registerMember') }}">Daftar disini !</a>
                                    </small>
                                   
                                </div>
                                @if($message = Session::get('fail'))
                                    <div class="alert alert-danger" style="opacity: 90%;" role="alert">
                                        {{ $message}}
                                    </div>
                                    @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url(../template_utama/img/recycle.webp)"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!--   Core JS Files   -->
    <script src="{{ asset('template_utama/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('template_utama/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template_utama/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('template_utama/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('template_utama/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
</body>

</html>