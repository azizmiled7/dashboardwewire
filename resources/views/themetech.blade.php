<!doctype html>
<html lang="en">



<head>

    <meta charset="utf-8" />
    <title>wewire Admin & Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/logotest3.png">

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/assets/css/app.css" type="text/css">

</head>

<body data-sidebar="dark" data-layout-mode="light">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    @if(session('message'))
    <div id="alert-message" class="hidden">
        <script>
            $(document).ready(function() {
                toastr.options = {
                    "positionClass": "toast-top-center",
                    "progressBar": true,
                    "timeOut": 4000
                };
                toastr.success('{{ session('message') }}');
            });
        </script>
    </div>
    @endif

    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box logo-container">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="/assets/images/logo2.png" alt="" height="40">
                            </span>
                            <span class="logo-lg">
                                <img src="/assets/images/logo2.png" alt="" height="17">
                            </span>
                        </a>

                        <a href="/dashboard" class="logo logo-light justify-content">
                            <span class="logo-sm">
                                <img src="/assets/images/logo2.png" alt="" height="28">
                            </span>
                            <span class="logo-lg">
                                <img src="/assets/images/logo2.png" alt="" height="55">
                            </span>
                        </a>

                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <input type="text" id="search" class="form-control" placeholder="Search here...">

                    </form>


                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..."
                                            aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>






                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="bx bx-bell bx-tada"></i>

                            <span class="badge bg-danger rounded-pill" id="notification-count"></span>

                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">

                            <div data-simplebar style="max-height: 230px;">
                                <a href="javascript: void(0);" class="text-reset notification-item">

                                </a>
                                <a href="javascript: void(0);" class="text-reset notification-item">

                                </a>


                            </div>
                            <div class="p-2 border-top d-grid">
                                <a href="/contact" class="btn btn-sm btn-link font-size-14 text-center"
                                    href="javascript:void(0)">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View
                                        More..</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-none d-xl-inline-block ms-1" key="t-henry">
                                @if (auth()->check())
                                    <p>Welcome, {{ auth()->user()->name }}</p>
                                @else
                                    <p>Please log in to view this content</p>
                                @endif
                            </span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="/profile"><i
                                    class="bx bx-user font-size-16 align-middle me-1"></i> <span
                                    key="t-profile">profile</span></a>
                            <a class="dropdown-item d-block" href="#"><span
                                    class="badge bg-success float-end">11</span><i
                                    class="bx bx-wrench font-size-16 align-middle me-1"></i> <span
                                    key="t-settings">Settings</span></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="bx bx-cog bx-spin"></i>
                        </button>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <a href="/">
                            <li class="menu-title" key="t-menu">Admin Dashboard</li>

                            <li>
                        </a>
                        <a href="/dashboardtech" >
                            <i class="bx bx-user-circle"></i>
                            <span key="t-dashboards">Dashboard</span>
                        </a>
                       
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-group"></i>
                                <span key="t-dashboards">technicien</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">

                                <li><a href="/techniciens" key="t-crypto">list Technicien</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-group"></i>
                                <span key="t-dashboards">materiels</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">

                                <li><a href="/list-pp" key="t-crypto">list materiels</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-group"></i>
                                <span key="t-dashboards">intervention</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/create" key="t-default">ajouter</a></li>

                                <li><a href="/interventions" key="t-crypto">list intervention</a></li>
                            </ul>
                        </li>
 <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-group"></i>
                                <span key="t-dashboards">affectation</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">

                                <li><a href="/affectation" key="t-crypto">list d'affectation</a></li>
                            </ul>
                        </li>
                        

                        <li>
                            <a href="/contact" class="waves-effect">
                                <i class="bx bxs-user-detail"></i>
                                <span key="t-chat">contact</span>
                            </a>
                        </li>


                        



                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">


                @yield('content')













                <!-- container-fluid -->
            </div>

            <!-- end modal -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            we are in
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                designed & developed By mohamed aziz miled 
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center px-3 py-4">

                <h5 class="m-0 me-2">Settings</h5>

                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h6 class="text-center mb-0">Choose Layouts</h6>

            <div class="p-4">
                <div class="mb-2">
                    <img src="/assets/images/layouts/layout-1.jpg" class="img-thumbnail" alt="layout images">
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                    <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                </div>

                <div class="mb-2">
                    <img src="/assets/images/layouts/layout-2.jpg" class="img-thumbnail" alt="layout images">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch">
                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </div>




            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="/assets/libs/jquery/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>

    <!-- apexcharts -->
    <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- dashboard init -->
    <script src="/assets/js/pages/dashboard.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    @yield('script')
   



</body>


</html>
