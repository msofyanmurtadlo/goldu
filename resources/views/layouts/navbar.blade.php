<div class="position-relative iq-banner">
    <!--Nav Start-->
    <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
        <div class="container-fluid navbar-inner">
            <a href="{{ route('home') }}" class="navbar-brand">
                <!--Logo start-->
                <!--logo End-->

                <!--Logo start-->
                <div class="logo-main">
                    <div class="logo-normal">
                        <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2"
                                transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                            <rect x="7.72803" y="27.728" width="28" height="4" rx="2"
                                transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2"
                                transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2"
                                transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                        </svg>
                    </div>
                    <div class="logo-mini">
                        <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2"
                                transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                            <rect x="7.72803" y="27.728" width="28" height="4" rx="2"
                                transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2"
                                transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2"
                                transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                        </svg>
                    </div>
                </div>
                <!--logo End-->




                <h4 class="logo-title">{{ $settings['Site_Name'] ?? 'Goldu' }}</h4>
            </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                    <svg width="20px" class="icon-20" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                    </svg>
                </i>

            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <span class="mt-2 navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" id="notification-drop" data-bs-toggle="dropdown">
                            <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19.7695 11.6453C19.039 10.7923 18.7071 10.0531 18.7071 8.79716V8.37013C18.7071 6.73354 18.3304 5.67907 17.5115 4.62459C16.2493 2.98699 14.1244 2 12.0442 2H11.9558C9.91935 2 7.86106 2.94167 6.577 4.5128C5.71333 5.58842 5.29293 6.68822 5.29293 8.37013V8.79716C5.29293 10.0531 4.98284 10.7923 4.23049 11.6453C3.67691 12.2738 3.5 13.0815 3.5 13.9557C3.5 14.8309 3.78723 15.6598 4.36367 16.3336C5.11602 17.1413 6.17846 17.6569 7.26375 17.7466C8.83505 17.9258 10.4063 17.9933 12.0005 17.9933C13.5937 17.9933 15.165 17.8805 16.7372 17.7466C17.8215 17.6569 18.884 17.1413 19.6363 16.3336C20.2118 15.6598 20.5 14.8309 20.5 13.9557C20.5 13.0815 20.3231 12.2738 19.7695 11.6453Z"
                                    fill="currentColor"></path>
                                <path opacity="0.4"
                                    d="M14.0088 19.2283C13.5088 19.1215 10.4627 19.1215 9.96275 19.2283C9.53539 19.327 9.07324 19.5566 9.07324 20.0602C9.09809 20.5406 9.37935 20.9646 9.76895 21.2335L9.76795 21.2345C10.2718 21.6273 10.8632 21.877 11.4824 21.9667C11.8123 22.012 12.1482 22.01 12.4901 21.9667C13.1083 21.877 13.6997 21.6273 14.2036 21.2345L14.2026 21.2335C14.5922 20.9646 14.8734 20.5406 14.8983 20.0602C14.8983 19.5566 14.4361 19.327 14.0088 19.2283Z"
                                    fill="currentColor"></path>
                            </svg>
                            <span class="bg-danger dots"></span>

                        </a>
                        <div class="p-0 sub-drop dropdown-menu dropdown-menu-end" aria-labelledby="notification-drop">
                            <div class="m-0 shadow-none card">
                                <div class="py-3 card-header d-flex justify-content-between bg-primary">
                                    <div class="header-title">
                                        <h5 class="mb-0 text-white">Transaction {{ '(' . $notifcount . ')' }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="p-0 card-body">
                                    @foreach ($notif as $u)
                                        <div class="iq-sub-card">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="p-1 avatar-40 rounded-pill bg-soft-primary d-flex justify-content-center align-items-center">
                                                    @if ($u->type == 'Convertion')
                                                        <i class="fa-solid fa-file-invoice-dollar"></i>
                                                    @elseif ($u->type == 'Bonus')
                                                        <i class="fa-solid fa-circle-dollar-to-slot"></i>
                                                    @else
                                                        <i class="icon">
                                                            <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M21.9964 8.37513H17.7618C15.7911 8.37859 14.1947 9.93514 14.1911 11.8566C14.1884 13.7823 15.7867 15.3458 17.7618 15.3484H22V15.6543C22 19.0136 19.9636 21 16.5173 21H7.48356C4.03644 21 2 19.0136 2 15.6543V8.33786C2 4.97862 4.03644 3 7.48356 3H16.5138C19.96 3 21.9964 4.97862 21.9964 8.33786V8.37513ZM6.73956 8.36733H12.3796H12.3831H12.3902C12.8124 8.36559 13.1538 8.03019 13.152 7.61765C13.1502 7.20598 12.8053 6.87318 12.3831 6.87491H6.73956C6.32 6.87664 5.97956 7.20858 5.97778 7.61852C5.976 8.03019 6.31733 8.36559 6.73956 8.36733Z"
                                                                    fill="currentColor"></path>
                                                                <path opacity="0.4"
                                                                    d="M16.0374 12.2966C16.2465 13.2478 17.0805 13.917 18.0326 13.8996H21.2825C21.6787 13.8996 22 13.5715 22 13.166V10.6344C21.9991 10.2297 21.6787 9.90077 21.2825 9.8999H17.9561C16.8731 9.90338 15.9983 10.8024 16 11.9102C16 12.0398 16.0128 12.1695 16.0374 12.2966Z"
                                                                    fill="currentColor"></path>
                                                                <circle cx="18" cy="11.8999" r="1"
                                                                    fill="currentColor">
                                                                </circle>
                                                            </svg></i>
                                                    @endif
                                                </div>
                                                <div class="ms-3 w-100">
                                                    <h6 class="mb-0 ">{{ $u->type }}</h6>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>{{ $u->ballance < 0 ? '(-$' . number_format(abs($u->ballance), 2) . ')' : '$' . number_format($u->ballance, 2) }}
                                                        </p>
                                                        <small
                                                            class="float-end font-size-12">{{ \Carbon\Carbon::parse($u->created_at)->format('d/m/Y') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="p-0 card-footer d-flex justify-content-center align-items-center">
                                    <a href="{{ route('transactions.index') }}">Views All</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" id="notification-drop">
                            <i class="fa-solid fa-dollar-sign"></i>
                            {{ Auth::user()->ballance }}
                            <span class="bg-danger dots"></span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('template/dashboard/assets') }}/images/avatars/01.png"
                                alt="User-Profile"
                                class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                            <img src="{{ asset('template/dashboard/assets') }}/images/avatars/avtar_1.png"
                                alt="User-Profile"
                                class="theme-color-purple-img img-fluid avatar avatar-50 avatar-rounded">
                            <img src="{{ asset('template/dashboard/assets') }}/images/avatars/avtar_2.png"
                                alt="User-Profile"
                                class="theme-color-blue-img img-fluid avatar avatar-50 avatar-rounded">
                            <img src="{{ asset('template/dashboard/assets') }}/images/avatars/avtar_4.png"
                                alt="User-Profile"
                                class="theme-color-green-img img-fluid avatar avatar-50 avatar-rounded">
                            <img src="{{ asset('template/dashboard/assets') }}/images/avatars/avtar_5.png"
                                alt="User-Profile"
                                class="theme-color-yellow-img img-fluid avatar avatar-50 avatar-rounded">
                            <img src="{{ asset('template/dashboard/assets') }}/images/avatars/avtar_3.png"
                                alt="User-Profile"
                                class="theme-color-pink-img img-fluid avatar avatar-50 avatar-rounded">
                            <div class="caption ms-3 d-none d-md-block ">
                                <h6 class="mb-0 caption-title">{{ '@' . Auth::user()->username }}</h6>
                                <p class="mb-0 caption-sub-title">{{ Auth::user()->name }}</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../dashboard/app/user-profile.html">Profile</a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li> <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav> <!-- Nav Header Component Start -->
    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    @yield('nav')
                </div>
            </div>
        </div>
        <div class="iq-header-img">
            <img src="{{ asset('template/dashboard/assets') }}/images/dashboard/top-header.png" alt="header"
                class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('template/dashboard/assets') }}/images/dashboard/top-header1.png" alt="header"
                class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('template/dashboard/assets') }}/images/dashboard/top-header2.png" alt="header"
                class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('template/dashboard/assets') }}/images/dashboard/top-header3.png" alt="header"
                class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('template/dashboard/assets') }}/images/dashboard/top-header4.png" alt="header"
                class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('template/dashboard/assets') }}/images/dashboard/top-header5.png" alt="header"
                class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
        </div>
    </div> <!-- Nav Header Component End -->
    <!--Nav End-->
</div>
