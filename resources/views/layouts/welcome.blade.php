<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ $settings['Site_Name'] ?? 'Goldu' }}</title>
    <link href="{{ asset('template/welcome/styles.css') }}" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ asset('template/dashboard/assets') }}/images/favicon.ico" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous">
    </script>
</head>

<body>
    <div id="layoutDefault">
        <div id="layoutDefault_content">
            <main>
                <nav class="navbar navbar-marketing navbar-expand-lg bg-white navbar-light">
                    <div class="container">
                        <a class="navbar-brand text-dark" href="/"> <svg class=" icon-30" viewBox="0 0 30 30"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2"
                                    transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"></rect>
                                <rect x="7.72803" y="27.728" width="28" height="4" rx="2"
                                    transform="rotate(-45 7.72803 27.728)" fill="currentColor"></rect>
                                <rect x="10.5366" y="16.3945" width="16" height="4" rx="2"
                                    transform="rotate(45 10.5366 16.3945)" fill="currentColor"></rect>
                                <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2"
                                    transform="rotate(45 10.5562 -0.556152)" fill="currentColor"></rect>
                            </svg> {{ $settings['Site_Name'] ?? 'Goldu' }}</a><button class="navbar-toggler"
                            type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation"><i data-feather="menu"></i></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto mr-lg-5">
                                @auth
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/home') }}">Home </a></li>
                                @else
                                    <a class="btn btn-link btn-marketing rounded-pill" href="{{ route('login') }}">Login</a>
                                    @if (Route::has('register'))
                                        <a class="btn-teal btn rounded-pill px-4 ml-lg-4"
                                            href="{{ route('register') }}">Register</a>
                                    @endif
                                @endauth
                            </ul>
                        </div>
                    </div>
                </nav>

                @yield('content')
            </main>
        </div>
        <div id="layoutDefault_footer">
            <footer class="footer pt-10 pb-5 mt-auto bg-dark footer-dark">
                <div class="container">

                    <hr class="my-5" />
                    <div class="row align-items-center">
                        <div class="col-md-6 small">Copyright &copy; <a href="https://sofyan.biz.id">@sofyan</a> 2020
                        </div>
                        <div class="col-md-6 text-md-right small">
                            <a href="javascript:void(0);">Privacy Policy</a>
                            &middot;
                            <a href="javascript:void(0);">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('template/welcome/scripts.js') }}"></script>
</body>

</html>
