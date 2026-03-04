@extends('layout.App')

@section('content')
    <section class="about-modern">


        <!-- Header Start -->
        <div class="container-fluid bg-primary py-5 mb-5 page-header">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-10 text-center">
                        <h2 class="display-5 text-white animated slideInDown">TENTANG AKKP WAKATOBI</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                                <li class="breadcrumb-item"><a class="text-white" href="#">Tetang AKKP WAKATOBI</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->

        {{-- Sejarah --}}
        @if ($sejarah)
            <div class="container py-3">

                <!-- Judul -->
                <div class="text-center mb-5">
                    <h2 class="text-title-dark">SEJARAH SINGKAT AKKP WAKATOBI</h2>
                </div>

                <div class="row align-items-start g-4">

                    <!-- Gambar -->
                    <div class="col-lg-5">
                        @if ($sejarah->foto)
                            <img src="{{ asset('uploads/sejarah/' . $sejarah->foto) }}" alt="Sejarah AKKP Wakatobi"
                                class="history-image mb-4">
                        @else
                            <img src="{{ asset('img/SejarahAkkp.jpg') }}" alt="Sejarah AKKP Wakatobi"
                                class="history-image mb-4">
                        @endif

                        <a href="https://www.google.com/maps/place/KJA+Minawisata+AKKP+Wakatobi/@-5.334145,123.621042,17.14z"
                            target="_blank" class="btn btn-custom w-100">
                            <i class="bi bi-geo-alt-fill me-2"></i>
                            Lokasi AKKP Wakatobi
                        </a>
                    </div>

                    <!-- Teks -->
                    <div class="col-lg-7">
                        @foreach (explode("\n", $sejarah->sejarah) as $paragraf)
                            @if (trim($paragraf) !== '')
                                <p class="history-text">
                                    {{ $paragraf }}
                                </p>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>
        @endif


        {{-- VISI & MISI --}}

        @if ($visimisi)
            <section class="tupoksi-section py-5">
                <div class="container py-2">

                    <div class="text-center mb-3">
                        <h2 class="text-title-dark">VISI & MISI</h2>
                        <p class="text-muted">Landasan utama arah dan tujuan organisasi</p>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-9">
                            <div class="content-box">

                                <!-- VISI -->
                                <h4 class="section-heading text-title-medium">Visi</h4>
                                <p class="content-text">
                                    {{ $visimisi->visi }}
                                </p>

                                <!-- MISI -->
                                <h4 class="section-heading mt-4 text-title-medium">Misi</h4>

                                <ol class="content-list">
                                    @foreach (explode("\n", $visimisi->misi) as $item)
                                        @if (trim($item) !== '')
                                            <li>{{ $item }}</li>
                                        @endif
                                    @endforeach
                                </ol>

                            </div>
                        </div>
                    </div>

                </div>
            </section>
        @endif

        <!-- TUGAS & FUNGSI POKOK -->
        @if ($tupoksi)
            <div class="container mt-5">

                <!-- JUDUL -->
                <div class="text-center mb-5">
                    <h2 class=" text-title-dark">TUGAS POKOK & FUNGSI</h2>
                    <p class="text-mutede">
                        Peran dan tanggung jawab utama Akademi Komunitas Kelautan dan Perikanan Wakatobi
                    </p>
                </div>

                <div class="row g-4">

                    <!-- TUGAS POKOK -->
                    <div class="col-md-6">
                        <div class="tupoksi-card h-100">
                            <div class="tupoksi-icon">
                                <i class="bi bi-clipboard-check"></i>
                            </div>
                            <h4 class="tupoksi-title text-title-medium">Tugas Pokok</h4>
                            <p class="p-text">
                                {{ $tupoksi->tugas_pokok }}
                            </p>
                        </div>
                    </div>

                    <!-- FUNGSI -->
                    <div class="col-md-6">
                        <div class="tupoksi-card h-100">
                            <div class="tupoksi-icon">
                                <i class="bi bi-diagram-3"></i>
                            </div>
                            <h4 class="tupoksi-title text-title-medium">Fungsi</h4>

                            <ol class="tupoksi-list">
                                @foreach (explode("\n", $tupoksi->fungsi) as $item)
                                    @if (trim($item) !== '')
                                        <li>{{ $item }}</li>
                                    @endif
                                @endforeach
                            </ol>

                        </div>
                    </div>

                </div>
            </div>
        @endif

    </section>
@endsection
