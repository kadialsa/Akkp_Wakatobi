@extends('layout.App')


@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">

            @foreach ($sliders as $slider)
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset('uploads/sliders/' . $slider->image) }}" alt="{{ $slider->title }}">

                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                        style="background: rgba(24, 29, 56, .7);">

                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-sm-10 col-lg-8">

                                    <h2 class="display-3 text-white animated slideInDown">
                                        {{ $slider->title }}
                                    </h2>

                                    @if ($slider->description)
                                        <p class="fs-5 text-white mb-4 pb-2">
                                            {{ $slider->description }}
                                        </p>
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!-- Carousel End -->

    <!-- Service Start -->

    <div class="container-xxl mb-5  service-section">
        <div class="container position-relative">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-title-dark">INFORMASI & LAYANAN</h2>
            </div>

            <div class="row g-4 justify-content-center">

                <!-- Penelitian dan Pengembangan -->
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <a href="https://sinta.kemdiktisaintek.go.id/affiliations/profile/8244393" target="_blank" class="text-decoration-none text-dark">
                        <div class="service-item text-center p-4 h-100">
                            <div class="service-icon">
                                <i class="fa fa-flask"></i>
                            </div>
                            <h5>PENELITIAN DAN PENGEMBANGAN</h5>
                            <p>
                                Informasi mengenai kegiatan penelitian, inovasi, dan pengembangan yang dilakukan oleh
                                kampus.
                            </p>
                        </div>
                    </a>
                </div>

                <!-- Tentang Kami -->
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <a href="/about" class="text-decoration-none text-dark">
                        <div class="service-item text-center p-4 h-100">
                            <div class="service-icon">
                                <i class="fa fa-home"></i>
                            </div>
                            <h5>TENTANG KAMI</h5>
                            <p>
                                Mengenal profil, sejarah, serta visi pengembangan kampus kami.
                            </p>
                        </div>
                    </a>
                </div>

                <!-- Perpustakaan -->
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <a href="https://perpustakaan.akkpwakatobi.ac.id/" target="_blank"
                        class="text-decoration-none text-dark">
                        <div class="service-item text-center p-4 h-100">
                            <div class="service-icon">
                                <i class="fa fa-book-open"></i>
                            </div>
                            <h5>PERPUSTAKAAN</h5>
                            <p>
                                Akses koleksi buku dan referensi akademik secara online dan offline.
                            </p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
    {{-- Service End --}}

    <!-- About Start -->
    <div class="container-fluid py-5 about-section">

        <div class="container">
            <div class="row g-5">
                {{-- Gambar About --}}
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        @if ($about && $about->image)
                            <div class="about-img-wrapper">
                                <img src="{{ asset('uploads/about/' . $about->image) }}" alt="{{ $about->name }}"
                                    class="about-img">
                            </div>
                        @else
                            <img class="img-fluid position-absolute w-100 h-100" src="img/default-about.jpg" alt="About"
                                style="object-fit: cover;">
                        @endif
                    </div>
                </div>

                {{-- Konten About --}}
                <div class="col-lg-6 fadeInUp" data-wow-delay="0.3s">
                    <h2 class="mb-4 text-title-dark">SAMBUTAN DIREKTUR AKKP </h2>
                    <h4 class="mb-2 text-title-dark">{{ $about->name ?? 'Nama Tidak Tersedia' }}</h4>
                    <h6 class="about-title mb-4 ">{{ $about->title ?? '' }}</h6>
                    <p class="section-text mb-4 text-title-light">{!! $about->description ?? 'Deskripsi About belum ditambahkan.' !!}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- About End -->

    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">

            <!-- Title -->
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="text-title-dark">BERITA</h1>
                <h5 class="mb-5 text-title-medium">New Post</h5>
            </div>

            <!-- Card Berita -->
            <div class="row g-4 justify-content-center">

                @forelse($beritaTerbaru as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="card news-card h-100">

                            @php
                                $image = $item->image;

                                if (!$image) {
                                    $imageUrl = 'https://via.placeholder.com/600x400?text=No+Image';
                                } elseif (Str::startsWith($image, ['http://', 'https://'])) {
                                    $imageUrl = $image;
                                } elseif (Str::startsWith($image, 'uploads/')) {
                                    $imageUrl = asset($image);
                                } else {
                                    $imageUrl = asset('uploads/beritas/' . $image);
                                }
                            @endphp

                            <img src="{{ $imageUrl }}" class="card-img-top news-img" alt="{{ $item->title }}">

                            <div class="card-body">

                                <span class="badge badge-akkp mb-2">
                                    {{ $item->category ?? 'Berita' }}
                                </span>

                                <h5 class="card-title mt-2">
                                    {{ $item->title }}
                                </h5>

                                <p class="card-text">
                                    {{ $item->excerpt ? $item->excerpt : \Illuminate\Support\Str::limit(strip_tags($item->content), 120) }}
                                </p>

                            </div>

                            <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">

                                <span class="news-views text-muted" style="font-size:15px;">
                                    <i class="fa fa-eye me-1"></i> {{ $item->views ?? 0 }} Dilihat
                                </span>

                                <span class="news-date">
                                    {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->translatedFormat('d M Y') : '-' }}
                                </span>

                                <a href="{{ route('berita.detail', $item->slug) }}" class="btn btn-akkp btn-sm">
                                    Baca Selengkapnya
                                </a>

                            </div>

                        </div>
                    </div>

                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada berita terbaru</p>
                    </div>
                @endforelse

            </div>

        </div>
    </div>

    <!-- Courses End -->


    <!-- Prodi Start -->
    <div class="container-xxl py-5">
        <div class="container">

            <div class="text-center wow fadeInUp">
                <h2 class="mb-5 text-title-dark">PROGRAM STUDI</h2>
            </div>

            <div class="row g-4 justify-content-center">

                @forelse($prodis as $prodi)
                    <div class="col-lg-3 col-md-6 wow fadeInUp">
                        <div class="team-item bg-light h-100">

                            {{-- Thumbnail --}}
                            <div class="overflow-hidden">
                                <img class="img-fluid rounded"
                                    src="{{ $prodi->thumbnail ? asset($prodi->thumbnail) : asset('img/default.jpg') }}"
                                    alt="{{ $prodi->name }}">
                            </div>

                            {{-- Nama & Short Description --}}
                            <div class="text-center p-4">
                                <h5 class="mb-0">{{ strtoupper($prodi->name) }}</h5>
                                <small>{{ $prodi->short_description ?? '-' }}</small>
                            </div>

                            {{-- Read More --}}
                            <div class="text-center p-2">
                                <a href="{{ route('prodi.show', $prodi->slug) }}"
                                    class="btn btn-primary rounded-pill px-3 py-2 fw-semibold d-inline-flex align-items-center gap-2">
                                    READ MORE <span>→</span>
                                </a>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>Belum ada program studi</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>


    <!-- prodi End -->

    @if (isset($cooperations) && $cooperations->count())
        <section class="py-5">
            <div class="container">
                <h2 class="text-center mb-5 text-title-dark">KERJASAMA</h2>

                <div class="row row-cols-2 row-cols-md-5 g-3 justify-content-center">
                    @foreach ($cooperations as $item)
                        <div class="col">
                            <div class="p-3 text-center h-100">
                                <img src="{{ asset('uploads/cooperation/' . $item->image) }}" class="img-fluid"
                                    style="max-height:140px; object-fit:contain;">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
