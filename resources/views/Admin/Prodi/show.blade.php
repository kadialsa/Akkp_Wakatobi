@extends('layout.App')

@section('content')

    {{-- ================= HEADER ================= --}}
    <section class="about-modern">
        <div class="container-fluid bg-primary py-5 mb-5 page-header">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-10 text-center">

                        <h1 class="display-3 text-white animated slideInDown">
                            {{ $prodi->header_title ?? $prodi->name }}
                        </h1>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item">
                                    <a class="text-white" href="/">Home</a>
                                </li>
                                <li class="breadcrumb-item text-white active">
                                    {{ $prodi->name }}
                                </li>
                            </ol>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ================= SEJARAH ================= --}}
    <section class="history-section py-5">
        <div class="container">
            <div class="row align-items-center g-5">

                <div class="col-lg-6">
                    <div class="history-text">
                        <h3 class="mb-3">
                            {{ $prodi->sejarah_title ?? 'Sejarah Program Studi' }}
                        </h3>

                        {!! $prodi->sejarah_content
                            ? nl2br(e($prodi->sejarah_content))
                            : '<p class="text-muted">Konten sejarah belum tersedia.</p>' !!}
                    </div>
                </div>

                <div class="col-lg-6 text-center">
                    <img src="{{ $prodi->sejarah_image ? asset($prodi->sejarah_image) : asset('img/default-sejarah.jpg') }}"
                        class="img-fluid rounded shadow-sm" style="max-height:420px; object-fit:cover;">
                </div>

            </div>
        </div>
    </section>


    {{-- ================= PROFIL PRODI ================= --}}
    <section class="profile-prodi py-5">
        <div class="container">
            <div class="row">

                {{-- KAPRODI --}}
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="kaprodi-card text-center p-4 shadow-sm rounded">

                        <h3 class="mb-3">KETUA PROGRAM STUDI</h3>

                        <img src="{{ $prodi->kaprodi_photo ? asset($prodi->kaprodi_photo) : asset('img/default-user.png') }}"
                            class="rounded mb-3 d-block mx-auto" style="width:350px; height:400px; object-fit:cover;">

                        <div class="kaprodi-name fw-bold">
                            {{ $prodi->kaprodi_name ?? '-' }}
                        </div>

                        <div>NIP. {{ $prodi->kaprodi_nip ?? '-' }}</div>
                        <div>NIDN. {{ $prodi->kaprodi_nidn ?? '-' }}</div>

                    </div>
                </div>


                {{-- TAB KONTEN --}}
                <div class="col-lg-8">

                    <ul class="nav nav-tabs mb-4">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#visi">
                                Visi & Misi
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tujuan">
                                Tujuan
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#sasaran">
                                Sasaran Strategis
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">

                        {{-- VISI & MISI --}}
                        <div class="tab-pane fade show active" id="visi">
                            <h5 class="content-title">VISI</h5>
                            <p class="content-text">
                                {{ $prodi->visi ?? 'Visi belum tersedia' }}
                            </p>

                            <h5 class="content-title mt-4">MISI</h5>
                            <ol class="content-text">
                                @forelse ($prodi->misi as $item)
                                    <li>{{ $item->content }}</li>
                                @empty
                                    <li class="text-muted">Misi belum tersedia</li>
                                @endforelse
                            </ol>
                        </div>

                        {{-- TUJUAN --}}
                        <div class="tab-pane fade" id="tujuan">
                            <h5 class="content-title">TUJUAN</h5>

                            @php
                                $tujuanList = is_array($prodi->tujuan)
                                    ? $prodi->tujuan
                                    : json_decode($prodi->tujuan, true);
                            @endphp

                            @if (!empty($tujuanList))
                                <ol class="content-text">
                                    @foreach ($tujuanList as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ol>
                            @else
                                <p class="text-muted">Belum tersedia</p>
                            @endif
                        </div>

                        {{-- SASARAN --}}
                        <div class="tab-pane fade" id="sasaran">
                            <h5 class="content-title">SASARAN STRATEGIS</h5>
                            <p class="content-text">
                                {{ $prodi->sasaran ?? '-' }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ================= KURIKULUM ================= --}}
    <section class="container-xxl py-5 mb-5 kurikulum-section">
        <div class="container">

            <div class="text-center mb-4 text-white">
                <h2 class="fw-bold">
                    {{ $prodi->kurikulum_title ?? 'Kurikulum Program Studi' }}
                </h2>
                <p>
                    Informasi lengkap mengenai kurikulum program studi {{ $prodi->name }}
                </p>
            </div>

            <div class="card shadow-sm border-0 p-4">
                <div class="content-text">
                    @if ($prodi->kurikulum_content)
                        {!! $prodi->kurikulum_content !!}
                    @else
                        <p class="text-muted">Kurikulum belum tersedia.</p>
                    @endif
                </div>
            </div>

        </div>
    </section>


    {{-- ================= AKREDITASI ================= --}}
    <section class="py-5">
        <div class="container">
            <div class="row g-4 justify-content-center">

                @forelse ($akreditasi as $item)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                        <a href="{{ asset($item->file) }}" download class="text-decoration-none text-dark">
                            <div class="accreditation-card shadow-sm rounded h-100">
                                <div class="accreditation-image">
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                                </div>
                                <div class="px-3 pb-4 pt-3 text-center">
                                    <h5>{{ $item->title }}</h5>
                                    <span class="badge bg-{{ $item->badge_color }}">
                                        {{ $item->badge }}
                                    </span>
                                    <p class="mt-2 small"> {{ $item->description }} </p>
                                </div>
                            </div>

                        </a>
                    </div>
                @empty <p class="text-center text-muted">Belum ada data akreditasi</p>
                @endforelse {{-- BAN PT --}}
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <a href="https://www.banpt.or.id/" target="_blank" class="text-decoration-none text-dark">
                        <div class="accreditation-card shadow-sm rounded h-100">
                            <div class="accreditation-image">
                                <img src="{{ asset('img/BAN-PT.jpg') }}" alt="BAN-PT">
                            </div>
                            <div class="p-4 text-center">
                                <h5>Lembaga Akreditasi</h5>
                                <span class="badge bg-warning text-dark">BAN-PT</span>
                                <p class="mt-2 small"> Lembaga resmi akreditasi nasional. </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
