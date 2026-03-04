@extends('layout.App')

@section('content')
    <!-- Header -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header d-flex align-items-center">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h2 class="display-5 text-white">STRUKTUR ORGANISASI</h2>
                    <nav>
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item">
                                <a class="text-white" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item text-white active">Struktur Organisasi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container py-5">

        <!-- Judul -->
        <div class="text-center mb-4">
            <h3 class="fw-bold text-title-dark">STRUKTUR ORGANISASI</h3>
            <p class="text-muted">Akademi Komunitas Kelautan dan Perikanan Wakatobi</p>
        </div>

        <!-- Gambar -->
        <div class="row">
            <div class="col-12">
                @if ($struktur && $struktur->image)
                    <img src="{{ asset('uploads/struktur/' . $struktur->image) }}"
                        class="img-fluid w-100 shadow-sm struktur-img">
                @else
                    <p class="text-center text-muted">
                        Struktur organisasi belum tersedia.
                    </p>
                @endif
            </div>
        </div>

    </div>

    <!-- CIVITAS (TANPA CONTAINER BARU) -->
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
                                <img src="{{ asset('uploads/leaders/' . $leader->photo) }}" class="img-fluid">
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
