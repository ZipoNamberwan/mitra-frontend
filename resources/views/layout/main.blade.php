<!-- =========================================================
* Argon Dashboard PRO v1.1.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro
* Copyright 2019 Creative Tim (https://www.creative-tim.com)
* Coded by Creative Tim
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 -->
 <!DOCTYPE html>
 <html>
 
 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
     <meta name="author" content="Creative Tim">
     <title>Aplikasi Database Mitra dan Generator Form Pendaftaran - Backend</title>
     <!-- Favicon -->
     <link rel="icon" href="/assets/img/brand/favicon.png" type="image/png">
     <!-- Fonts -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
     <!-- Icons -->
     <link rel="stylesheet" href="/assets/vendor/nucleo/css/nucleo.css" type="text/css">
     <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
     <!-- Additional Stylesheet -->
     @yield('stylesheet')
     <!-- Argon CSS -->
     <link rel="stylesheet" href="/assets/css/argon.css?v=1.1.0" type="text/css">
     <link rel="stylesheet" href="/assets/style.css">
 
 </head>
 
 <body>
     <!-- Sidenav -->
     <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
         <div class="scrollbar-inner">
             <!-- Brand -->
             <div class="sidenav-header d-flex align-items-center">
                 <a class="navbar-brand" href="/pages/dashboards/dashboard.html">
                     <img src="/assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
                 </a>
                 <div class="ml-auto">
                     <!-- Sidenav toggler -->
                     <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                         <div class="sidenav-toggler-inner">
                             <i class="sidenav-toggler-line"></i>
                             <i class="sidenav-toggler-line"></i>
                             <i class="sidenav- toggler-line"></i>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="navbar-inner">
                 <!-- Collapse -->
                 <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                     <ul class="navbar-nav">
                         <li class="nav-item">
                             {{-- <a class="nav-link @if(url()->current() == url('/')) active @endif" href="/">
                                 <i class="fas fa-home text-primary"></i>
                                 <span class=class="nav-link @if(str_contains(url()->current(), url('surveys'))) active @endif" href="#navbar-dash" data-toggle="collapse" role="button" aria-expanded="@if(str_contains(url()->current(), url('surveys'))) true @else false @endif" aria-controls="navbar-forms">My Survey</span>
                             </a> --}}
                             <a class="nav-link @if(str_contains(url()->current(), url('/statusdaftar')) || str_contains(url()->current(), url('/assess'))) active @endif" href="#navbar-dash" data-toggle="collapse" role="button" aria-expanded="@if(str_contains(url()->current(), url('/mitras')) || str_contains(url()->current(), url('/recruitments'))) true @else false @endif" aria-controls="navbar-forms">
                                 <i class="fas fa-home text-primary"></i>
                                 <span class="nav-link-text">Mitra</span>
                             </a>
                             <div class="collapse @if(str_contains(url()->current(), url('/statusdaftar')) || str_contains(url()->current(), url('/assess'))) show @endif" id="navbar-dash">
                                 <ul class="nav nav-sm flex-column">
                                     <li class="nav-item">
                                         <a href="/statusdaftar" class="nav-link @if(str_contains(url()->current(), url('/statusdaftar'))) active @endif">Status Pendaftaran</a>
                                     </li>
                                     <li class="nav-item">
                                         <a href="/assess" class="nav-link @if(str_contains(url()->current(), url('/assess'))) active @endif">Penilaian</a>
                                     </li>
                                 </ul>
                             </div>
                         </li>
                     </ul>
                     <!-- Divider -->
                     <hr class="my-3">
                     <ul class="navbar-nav">
                         <li class="nav-item">
                             <a class="nav-link @if(str_contains(url()->current(), url('/mitras')) || str_contains(url()->current(), url('/recruitments'))) active @endif" href="#navbar-forms" data-toggle="collapse" role="button" aria-expanded="@if(str_contains(url()->current(), url('/mitras')) || str_contains(url()->current(), url('/recruitments'))) true @else false @endif" aria-controls="navbar-forms">
                                 <i class="fa fa-laptop-code text-green"></i>
                                 <span class="nav-link-text">Mitra</span>
                             </a>
                             <div class="collapse @if(str_contains(url()->current(), url('/mitras')) || str_contains(url()->current(), url('/recruitments'))) show @endif" id="navbar-forms">
                                 <ul class="nav nav-sm flex-column">
                                     <li class="nav-item">
                                         <a href="/mitras" class="nav-link @if(str_contains(url()->current(), url('/mitras'))) active @endif">Semua Mitra</a>
                                     </li>
                                     <li class="nav-item">
                                         <a href="/recruitments" class="nav-link @if(str_contains(url()->current(), url('/recruitments'))) active @endif">Rekruitmen Mitra</a>
                                     </li>
                                     <!-- <li class="nav-item">
                                         <a href="" class="nav-link">Beban Kerja</a>
                                     </li> -->
                                     <!-- <li class="nav-item">
                                         <a href="" class="nav-link">Statistik</a>
                                     </li> -->
                                 </ul>
                             </div>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link @if(str_contains(url()->current(), url('surveys'))) active @endif" href="#navbar-sensus" data-toggle="collapse" role="button" aria-expanded="@if(str_contains(url()->current(), url('surveys'))) true @else false @endif" aria-controls="navbar-forms">
                                 <i class="fas fa-chart-line text-info"></i>
                                 <span class="nav-link-text">Survey</span>
                             </a>
                             <div class="collapse @if(str_contains(url()->current(), url('surveys'))) show @endif" id="navbar-sensus">
                                 <ul class="nav nav-sm flex-column">
                                     <li class="nav-item">
                                         <a href="/surveys" class="nav-link @if(str_contains(url()->current(), url('surveys'))) active @endif">Semua Survey</a>
                                     </li>
                                     <!-- <li class="nav-item">
                                         <a href="" class="nav-link">Generate Form Pendaftaran</a>
                                     </li> -->
                                 </ul>
                             </div>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="/download">
                                 <i class="fas fa-folder-open text-danger"></i>
                                 <span class="nav-link-text">Unduh</span>
                             </a>
                         </li>
                     </ul>
                     <!-- Divider -->
                     <hr class="my-3">
                 </div>
             </div>
         </div>
     </nav>
     <!-- Main content -->
     <div class="main-content" id="panel">
         <!-- Topnav -->
 
         <!-- Page content -->
         <div class="main-content" id="panel">
             <!-- Navigation bar -->
             <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
                 <div class="container-fluid">
                     <div class="collapse navbar-collapse" id="navbarSupportedContent">
                         <!-- Search form -->
                         <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                             <div class="form-group mb-0">
                                 <div class="input-group input-group-alternative input-group-merge">
                                     <div class="input-group-prepend">
                                         <span class="input-group-text"><i class="fas fa-search"></i></span>
                                     </div>
                                     <input class="form-control" placeholder="Search" type="text">
                                 </div>
                             </div>
                             <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                                 <span aria-hidden="true">×</span>
                             </button>
                         </form>
                         <!-- Navbar links -->
                         <ul class="navbar-nav align-items-center ml-md-auto">
                             <li class="nav-item d-xl-none">
                                 <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                                     <div class="sidenav-toggler-inner">
                                         <i class="sidenav-toggler-line"></i>
                                         <i class="sidenav-toggler-line"></i>
                                         <i class="sidenav-toggler-line"></i>
                                     </div>
                                 </div>
                             </li>
                             <li class="nav-item d-sm-none">
                                 <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                                     <i class="ni ni-zoom-split-in"></i>
                                 </a>
                             </li>
                             <li class="nav-item dropdown">
                                 <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     <i class="ni ni-bell-55"></i>
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
                                     <div class="px-3 py-3">
                                         <h6 class="text-sm text-muted m-0">You have <strong class="text-primary">13</strong> notifications.</h6>
                                     </div>
                                     <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
                                 </div>
                             </li>
                         </ul>
                         <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                             <li class="nav-item dropdown">
                                 <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     <div class="media align-items-center">
                                         <!-- Informasi akun  dihapus di sini  -->
                                     </div>
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-right">
                                     <div class="dropdown-header noti-title">
                                         <h6 class="text-overflow m-0">Welcome!</h6>
                                     </div>
                                     <a href="#!" class="dropdown-item">
                                         <i class="ni ni-single-02"></i>
                                         <span>Profile</span>
                                     </a>
                                     <div class="dropdown-divider"></div>
                                     <!-- Logout di hapus-->
                                 </div>
                             </li>
                         </ul>
                     </div>
                 </div>
             </nav>
             @yield('container')
             <!-- Footer -->
             <div class="container-fluid">
                 <footer class="footer pt-0">
                     <div class="row align-items-center justify-content-lg-between">
                         <div class="col-lg-6">
                             <div class="copyright text-center text-lg-left text-muted">
                                 &copy; 2021 <a href="https://probolinggokab.bps.go.id" class="font-weight-bold ml-1" target="_blank">BPS Kabupaten Probolinggo</a>
                             </div>
                         </div>
                     </div>
                 </footer>
             </div>
             <div class="sk-cube-background" id="loading-background" style="display: none;">
                 <div class="sk-cube-grid">
                     <div class="sk-cube sk-cube1"></div>
                     <div class="sk-cube sk-cube2"></div>
                     <div class="sk-cube sk-cube3"></div>
                     <div class="sk-cube sk-cube4"></div>
                     <div class="sk-cube sk-cube5"></div>
                     <div class="sk-cube sk-cube6"></div>
                     <div class="sk-cube sk-cube7"></div>
                     <div class="sk-cube sk-cube8"></div>
                     <div class="sk-cube sk-cube9"></div>
                 </div>
             </div>
         </div>
 
 
 
     </div>
 
     <!-- Argon Scripts -->
     <!-- Core -->
     <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
     <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
     <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
     <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
     <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
     <!-- Optional JS -->
     @yield('optionaljs')
     <!-- Argon JS -->
     <script src="/assets/js/argon.js?v=1.1.0"></script>
 </body>
 
 </html>