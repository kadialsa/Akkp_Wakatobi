<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name') }}</title>

    <!-- Favicon -->
    <link href="{{ asset('img/logo.png') }}" rel="icon">

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.slides.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
                <div class="sidebar-brand-icon p-1 ">
                    <img src="/img/logo.png" alt="Logo AKKP Wakatobi" class="img-fluid logo-sidebar">
                </div>
                <div class="sidebar-brand-text mx-3">AKKP WAKATOBI</div>
            </a>

            <hr class="sidebar-divider my-0">

            <!-- Dashboard -->
            <li class="nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Home Page
            </div>

            <!-- Sliders -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSliders"
                    aria-expanded="false" aria-controls="collapseSliders">
                    <i class="fas fa-fw fa-images"></i>
                    <span>Sliders</span>
                </a>
                <div id="collapseSliders" class="collapse" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.slides.create') }}">New Slider</a>
                        <a class="collapse-item" href="{{ route('admin.slides.index') }}">All Sliders</a>
                    </div>
                </div>
            </li>

            <!-- About / Sambutan -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.about.edit') }}">
                    <i class="fas fa-fw fa-handshake"></i>
                    <span>Sambutan</span></a>
            </li>

            <!-- Cooperation -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.cooperation.index') }}">
                    <i class="fas fa-fw fa-handshake"></i>
                    <span>Kerjasama</span></a>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Tentang Page
            </div>

            <!-- Visi Misi -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVisi"
                    aria-expanded="false" aria-controls="collapseVisi">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Visi & Misi</span>
                </a>
                <div id="collapseVisi" class="collapse" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.visimisi.edit') }}">Visi & Misi</a>
                        <a class="collapse-item" href="{{ route('admin.sejarah.edit') }}">Sejarah Singkat</a>
                        <a class="collapse-item" href="{{ route('admin.tupoksi.edit') }}">Tupoksi</a>
                    </div>
                </div>
            </li>

            <!-- Struktur Organisasi -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStruktur"
                    aria-expanded="false" aria-controls="collapseStruktur">
                    <i class="fas fa-fw fa-sitemap"></i>
                    <span>Struktur Organisasi</span>
                </a>
                <div id="collapseStruktur" class="collapse" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.struktur.edit') }}">Gambar Struktur</a>
                        <a class="collapse-item" href="{{ route('admin.section.index') }}">Data Struktur</a>
                    </div>
                </div>
            </li>

            <!-- Program Studi -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.video.index') }}">
                    <i class="fas fa-fw fa-video"></i>
                    <span>Videos</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Program Studi
            </div>

            <!-- Program Studi -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.prodi.index') }}">
                    <i class="fas fa-fw fa-graduation-cap"></i>
                    <span>Program Studi</span>
                </a>
            </li>


            <!-- Akreditasi -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.akreditasi.index') }}">
                    <i class="fas fa-fw fa-certificate"></i>
                    <span>Akreditasi</span></a>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Prostingan
            </div>

            <!-- Berita -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBerita"
                    aria-expanded="false" aria-controls="collapseBerita">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>Berita</span>
                </a>
                <div id="collapseBerita" class="collapse" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.berita.create') }}">New Berita</a>
                        <a class="collapse-item" href="{{ route('admin.berita.index') }}">All Berita</a>
                    </div>
                </div>
            </li>

            <!-- Contact Admin -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.contact.index') }}">
                    <i class="fas fa-fw fa-envelope"></i>
                    <span>Contact</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.header.edit') }}">
                    <i class="fas fa-fw fa-image"></i>
                    <span>Header Image</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar  static-top shadow">

                    <!-- Toggle Sidebar -->
                    <button id="sidebarToggle" class="btn btn-link d-none d-md-inline-block">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Sidebar Toggle (Mobile) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->

                    <ul class="navbar-nav ml-auto">
                        <!-- Messages -->
                        <li class="nav-item no-arrow mx-1">
                            <a class="nav-link position-relative" href="{{ route('admin.contact.index') }}">

                                <i class="fas fa-envelope fa-fw"></i>

                                @if (!empty($unreadMessages) && $unreadMessages > 0)
                                    <span class="badge badge-danger badge-counter">
                                        {{ $unreadMessages }}
                                    </span>
                                @endif

                            </a>
                        </li>
                        {{-- Top Bar --}}
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- User Dropdown -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">

                                <!-- Nama User (Dynamic) -->
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small fw-bold">
                                    {{ Auth::user()->name }}
                                </span>

                                <!-- Foto Profile -->
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}"
                                    style="width:35px;height:35px;object-fit:cover;">
                            </a>

                            <!-- Dropdown Menu -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in p-0"
                                aria-labelledby="userDropdown"
                                style="min-width:240px;border-radius:14px;overflow:hidden;">

                                <!-- Header User -->
                                <div class="px-3 py-3 bg-light border-bottom">
                                    <div class="font-weight-bold text-dark">
                                        {{ auth()->user()->name }}
                                    </div>
                                    <small class="text-muted">
                                        {{ ucfirst(auth()->user()->role) }}
                                    </small>
                                </div>


                                <!-- Menu -->
                                <div class="p-2">

                                    <!-- Account -->
                                    <a class="dropdown-item d-flex align-items-center rounded mb-1"
                                        href="{{ route('profile.edit') }}">

                                        <i class="fas fa-user-cog mr-2 text-primary"></i>
                                        <span>Settings Account</span>

                                    </a>


                                    {{-- Superadmin Only --}}
                                    @if (auth()->user()->role == 'superadmin')
                                        <a class="dropdown-item d-flex align-items-center rounded mb-1"
                                            href="{{ route('admin.users.index') }}">

                                            <i class="fas fa-users-cog mr-2 text-success"></i>
                                            <span>Manajemen Admin</span>

                                        </a>
                                    @endif


                                    <div class="dropdown-divider"></div>


                                    <!-- Logout -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <button type="submit"
                                            class="dropdown-item d-flex align-items-center text-danger rounded">

                                            <i class="fas fa-sign-out-alt mr-2"></i>
                                            Logout

                                        </button>

                                    </form>

                                </div>

                            </div>
                        </li>
                    </ul>

                </nav>  

                <!-- End of Topbar -->

                <div id="page-content">
                    @yield('content')
                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; AKKP Wakatobi {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    @stack('scripts')

    <script>
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {

                let input = document.getElementById(this.dataset.target);
                let icon = this.querySelector('i');

                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }

            });
        });

        document.getElementById("sidebarToggle").addEventListener("click", function() {
            document.getElementById("wrapper").classList.toggle("toggled");
        });

        document.getElementById("sidebarToggleTop").addEventListener("click", function() {
                    document.getElementById("wrapper").classList.toggle("toggled");
    </script>

</body>

</html>
