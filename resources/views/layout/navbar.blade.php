<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow sticky-top py-0">
    <div class="container-fluid align-items-stretch px-0">

        <!-- LOGO -->
        <a href="/" class="navbar-brand px-4">
            <img src="/img/logo1.png" alt="Logo AKKP Wakatobi" style="height:100px;">
        </a>

        <!-- TOGGLER -->
        <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto align-items-center gap-1 px-lg-3">

                <li class="nav-item">
                    <a href="{{ route('home.index') }}" class="nav-link">Beranda</a>
                </li>

                <!-- Tentang AKKP -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle">Tentang AKKP</a>
                    <ul class="dropdown-menu shadow border-0 mt-2">
                        <li><a href="{{ route('about.index') }}" class="dropdown-item">About</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a href="{{ route('struktur.index') }}" class="dropdown-item">Struktur Organisasi</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a href="{{ route('video.user') }}" class="dropdown-item">Video Terkait</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a href="https://sinta.kemdiktisaintek.go.id/affiliations/profile/8244393"
                                class="dropdown-item">
                                Penelitian dan Pengembangan
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a href="https://perpustakaan.akkpwakatobi.ac.id/" class="dropdown-item" target="_blank">
                                Perpustakaan
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Program Studi -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle">Program Studi</a>
                    <ul class="dropdown-menu shadow border-0 mt-2">
                        @forelse($navbarProdis as $prodi)
                            <li>
                                <a href="{{ route('prodi.show', $prodi->slug) }}" class="dropdown-item">
                                    {{ $prodi->name }}
                                </a>
                            </li>
                            @if (!$loop->last)
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endif
                        @empty
                            <li>
                                <span class="dropdown-item text-muted">
                                    Belum ada Program Studi
                                </span>
                            </li>
                        @endforelse
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('berita.index') }}" class="nav-link">Berita</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                </li>

                <!-- MOBILE JOIN -->
                <li class="nav-item d-lg-none w-100">
                    <div class="px-3 mt-3">
                        <a href="https://pentaru.kkp.go.id/" class="btn btn-join-mobile w-100 text-center">
                            Join Now <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </li>

            </ul>
        </div>

        <!-- DESKTOP JOIN (DI LUAR MENU) -->
        <div class="d-none d-lg-flex align-items-stretch">
            <a href="https://pentaru.kkp.go.id/" class="btn btn-join-now px-4">
                Join Now <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>

    </div>
</nav>
<!-- Navbar End -->

<script>
    // Navbar hide on scroll down, show on scroll up
    let lastScrollTop = 0;
    const navbar = document.querySelector('.navbar');

    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop && scrollTop > 100) {
            // Scroll ke bawah
            navbar.style.top = "-100px";
        } else {
            // Scroll ke atas
            navbar.style.top = "0";
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });
</script>

<script>
    document.querySelectorAll('.dropdown-toggle').forEach(function(el) {
        el.addEventListener('click', function(e) {
            if (window.innerWidth < 992) {
                e.preventDefault();
                let parent = this.parentElement;
                parent.classList.toggle('show');

                let menu = parent.querySelector('.dropdown-menu');
                menu.classList.toggle('show');
            }
        });
    });
</script>
