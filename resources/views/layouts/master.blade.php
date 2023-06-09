<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>AwesomeMahar</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/ico.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/business/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/business/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}"
        type="text/css">

    {{-- <x-embed-styles /> --}}

    <!-- Page plugins -->
    <link rel="stylesheet"
        href="{{ asset('assets/business/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/business/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/business/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-confirm.min.css') }}" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/business/css/argon.css?v=1.2.1') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/business/css/custom.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/business/vendor/fullcalendar/dist/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/business/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    @yield('head')
</head>

<body>

    <div class="main-content" id="panel">
        <nav class="navbar navbar-top navbar-expand navbar-dark  bg-blue">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- <a class="text-white text-uppercase" href="#">
                        <?php echo $page; ?></i>
                    </a> -->
                    <!-- Search form -->
                    <!-- <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                        <div class="form-group mb-0">
                            <div class="input-group input-group-alternative input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input class="form-control" placeholder="Search" type="text">
                            </div>
                        </div>
                        <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main"
                            aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </form> -->
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center  mr-md-auto ">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                                data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                        <!-- <li class="nav-item d-sm-none">
                            <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                                <i class="ni ni-zoom-split-in"></i>
                            </a>
                        </li> -->
                        <!--    <li class="nav-item dropdown">
        
                           <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                                <!-- Dropdown header --
                            <div class="px-3 py-3">
                                <h6 class="text-sm text-muted m-0">You have <strong class="text-primary">13</strong>
                                    notifications.</h6>
                            </div>
                            <!-- List group --
                            <div class="list-group list-group-flush">
                                <a href="#!" class="list-group-item list-group-item-action">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <!-- Avatar --
                                            <img alt="Image placeholder" src="assets/img/theme/team-1.jpg"
                                                class="avatar rounded-circle">
                                        </div>
                                        <div class="col ml--2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h4 class="mb-0 text-sm">John Snow</h4>
                                                </div>
                                                <div class="text-right text-muted">
                                                    <small>2 hrs ago</small>
                                                </div>
                                            </div>
                                            <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="#!" class="list-group-item list-group-item-action">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <!-- Avatar --
                                            <img alt="Image placeholder" src="assets/img/theme/team-2.jpg"
                                                class="avatar rounded-circle">
                                        </div>
                                        <div class="col ml--2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h4 class="mb-0 text-sm">John Snow</h4>
                                                </div>
                                                <div class="text-right text-muted">
                                                    <small>3 hrs ago</small>
                                                </div>
                                            </div>
                                            <p class="text-sm mb-0">A new issue has been reported for Argon.</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="#!" class="list-group-item list-group-item-action">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <!-- Avatar --
                                            <img alt="Image placeholder" src="assets/img/theme/team-3.jpg"
                                                class="avatar rounded-circle">
                                        </div>
                                        <div class="col ml--2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h4 class="mb-0 text-sm">John Snow</h4>
                                                </div>
                                                <div class="text-right text-muted">
                                                    <small>5 hrs ago</small>
                                                </div>
                                            </div>
                                            <p class="text-sm mb-0">Your posts have been liked a lot.</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="#!" class="list-group-item list-group-item-action">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <!-- Avatar --
                                            <img alt="Image placeholder" src="assets/img/theme/team-4.jpg"
                                                class="avatar rounded-circle">
                                        </div>
                                        <div class="col ml--2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h4 class="mb-0 text-sm">John Snow</h4>
                                                </div>
                                                <div class="text-right text-muted">
                                                    <small>2 hrs ago</small>
                                                </div>
                                            </div>
                                            <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="#!" class="list-group-item list-group-item-action">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <!-- Avatar --
                                            <img alt="Image placeholder" src="assets/img/theme/team-5.jpg"
                                                class="avatar rounded-circle">
                                        </div>
                                        <div class="col ml--2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h4 class="mb-0 text-sm">John Snow</h4>
                                                </div>
                                                <div class="text-right text-muted">
                                                    <small>3 hrs ago</small>
                                                </div>
                                            </div>
                                            <p class="text-sm mb-0">A new issue has been reported for Argon.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- View all --
                            <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View
                                all</a>
                </div>
                        </li> -->
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="ni ni-ungroup"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default  dropdown-menu-right ">
                                <div class="row shortcuts px-4">
                                    <a href="#!" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                                            <i class="ni ni-calendar-grid-58"></i>
                                        </span>
                                        <small>Calendar</small>
                                    </a>
                                    <a href="#!" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                                            <i class="ni ni-email-83"></i>
                                        </span>
                                        <small>Email</small>
                                    </a>
                                    <a href="#!" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                                            <i class="ni ni-credit-card"></i>
                                        </span>
                                        <small>Payments</small>
                                    </a>
                                    <a href="#!" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                                            <i class="ni ni-books"></i>
                                        </span>
                                        <small>Reports</small>
                                    </a>
                                    <a href="#!" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
                                            <i class="ni ni-pin-3"></i>
                                        </span>
                                        <small>Maps</small>
                                    </a>
                                    <a href="#!" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                                            <i class="ni ni-basket"></i>
                                        </span>
                                        <small>Shop</small>
                                    </a>
                                </div>
                            </div>
                        </li> -->
                    </ul>
                    @php
                        // $picture = asset('assets/img/image_placeholder.png');
                        // if (!is_null(auth()->user()->picture) && file_exists(auth()->user()->picture)) {
                        //     $picture = auth()->user()->picture;
                        // }
                    @endphp
                    <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        {{-- <img alt="Image placeholder" src="{{ asset($picture) }}"> --}}
                                    </span>
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span
                                            {{-- class="mb-0 text-sm  font-weight-bold">{{ ucwords(auth()->user()->first_name) . ' ' . ucwords(auth()->user()->last_name) }}</span> --}}
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome!</h6>
                                </div>
                                {{-- <a href="#!" class="dropdown-item"> --}}
                                {{-- <i class="ni ni-single-02"></i> --}}
                                {{-- <span>My profile</span> --}}
                                {{-- </a> --}}
                                {{-- <a href="#!" class="dropdown-item"> --}}
                                {{-- <i class="ni ni-settings-gear-65"></i> --}}
                                {{-- <span>Settings</span> --}}
                                {{-- </a> --}}
                                {{-- <a href="#!" class="dropdown-item"> --}}
                                {{-- <i class="ni ni-calendar-grid-58"></i> --}}
                                {{-- <span>Activity</span> --}}
                                {{-- </a> --}}
                               
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>

    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{ asset('assets/business/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('assets/business/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/business/vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('assets/business/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/business/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <!-- Optional JS -->
    <script src="{{ asset('assets/business/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/business/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/business/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/business/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/business/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/business/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/business/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    {{-- <!-- <script src="{{ asset('assets/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script> --> --}}
    <!-- Optional JS -->
    <script src="{{ asset('assets/business/vendor/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/business/vendor/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/business/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <!-- Argon JS -->
    <script src="{{ asset('assets/business/vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/business/vendor/chart.js/dist/Chart.extension.js') }}"></script>
    <script src="{{ asset('assets/business/js/argon.js?v=1.2.1') }}"></script>
    <!-- Demo JS - remove this in your project -->
    <script src="{{ asset('assets/business/js/demo.min.js') }}"></script>

    @yield('script')
</body>

</html>
