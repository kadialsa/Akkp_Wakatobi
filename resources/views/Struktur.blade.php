@extends('layout.App')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-5 text-white animated slideInDown ">STRUKTUR ORGANISASI</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Struktur Organisasi</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <div class="container py-5">
        <!-- Judul -->
        <div class="text-center mb-4">
            <h3 class="fw-bold text-title-dark">STRUKTUR ORGANISAI</h3>
            <p class="text-muted">Akademi Komunitas Kelautan dan Perikanan Wakatobi</p>
        </div>

        <!-- Gambar Struktur -->
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="org-wrapper text-center">
                    @if ($struktur && $struktur->image)
                        <img src="{{ asset('uploads/struktur/' . $struktur->image) }}" alt="Struktur Organisasi"
                            class="org-image img-fluid rounded shadow-sm"
                            style="width:100%; max-width:1200px; height:700px; object-fit:cover;">
                    @else
                        <p class="text-center text-muted text-title-dark">Struktur organisasi belum tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h3 class="fw-bold text-title-dark">CIVITAS AKADEMIKA</h3>
            <p class="text-muted">Akademi Komunitas Kelautan dan Perikanan Wakatobi</p>
        </div>

        @foreach ($sections as $section)
            <div class="text-center mb-4">
                <h3 class="fw-bold text-title-dark">{{ $section->title }}</h3>
            </div>

            <div class="row g-4 text-center justify-content-center">
                @foreach ($section->leaders as $leader)
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-5">

                        <h5 class="leader-title text-title-medium">
                            {{ $leader->position }}
                        </h5>

                        <div class="leader-card">
                            @if ($leader->photo)
                                <img src="{{ asset('uploads/leaders/' . $leader->photo) }}" alt="{{ $leader->name }}"
                                    class="img-fluid">
                            @else
                                <img src="https://via.placeholder.com/400x600?text=No+Image" class="img-fluid">
                            @endif
                        </div>

                        <div class="leader-name">
                            {{ $leader->name }}, {{ $leader->degree }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
