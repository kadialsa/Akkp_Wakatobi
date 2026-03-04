@extends('layout.App')

@section('content')

{{-- ================= HEADER ================= --}}
<section class="bg-primary py-5 mb-5">
    <div class="container text-center text-white">
        <h1 class="display-5 fw-bold mb-3">
            {{ $prodi->header_title ?? $prodi->name }}
        </h1>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item">
                    <a class="text-white text-decoration-none" href="/">Home</a>
                </li>
                <li class="breadcrumb-item active text-white">
                    {{ $prodi->name }}
                </li>
            </ol>
        </nav>
    </div>
</section>


{{-- ================= SEJARAH ================= --}}
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">

            {{-- TEXT --}}
            <div class="col-lg-6">
                <h3 class="fw-bold mb-4">
                    {{ $prodi->sejarah_title ?? 'Sejarah Program Studi' }}
                </h3>

                <div class="text-muted">
                    {!! $prodi->sejarah_content
                        ? nl2br(e($prodi->sejarah_content))
                        : '<p>Konten sejarah belum tersedia.</p>' !!}
                </div>
            </div>

            {{-- IMAGE --}}
            <div class="col-lg-6 text-center">
                <img src="{{ $prodi->sejarah_image ? asset($prodi->sejarah_image) : asset('img/default-sejarah.jpg') }}"
                     class="img-fluid rounded shadow"
                     style="max-height:420px; object-fit:cover;">
            </div>

        </div>
    </div>
</section>


{{-- ================= PROFIL PRODI ================= --}}
<section class="bg-light py-5">
    <div class="container">
        <div class="row g-4">

            {{-- KAPRODI --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100 text-center p-4">
                    <h5 class="fw-bold mb-4">Ketua Program Studi</h5>

                    <img src="{{ $prodi->kaprodi_photo ? asset($prodi->kaprodi_photo) : asset('img/default-user.png') }}"
                         class="img-fluid rounded mb-3"
                         style="max-height:280px; object-fit:cover;">

                    <h6 class="fw-bold mb-1">
                        {{ $prodi->kaprodi_name ?? '-' }}
                    </h6>
                    <small class="text-muted d-block">
                        NIP. {{ $prodi->kaprodi_nip ?? '-' }}
                    </small>
                    <small class="text-muted">
                        NIDN. {{ $prodi->kaprodi_nidn ?? '-' }}
                    </small>
                </div>
            </div>

            {{-- TAB CONTENT --}}
            <div class="col-lg-8">

                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <button class="nav-link active"
                                data-bs-toggle="tab"
                                data-bs-target="#visi">
                            Visi & Misi
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link"
                                data-bs-toggle="tab"
                                data-bs-target="#tujuan">
                            Tujuan
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link"
                                data-bs-toggle="tab"
                                data-bs-target="#sasaran">
                            Sasaran Strategis
                        </button>
                    </li>
                </ul>

                <div class="tab-content bg-white p-4 shadow-sm rounded">

                    {{-- VISI & MISI --}}
                    <div class="tab-pane fade show active" id="visi">
                        <h6 class="fw-bold">Visi</h6>
                        <p class="text-muted">
                            {{ $prodi->visi ?? 'Visi belum tersedia' }}
                        </p>

                        <h6 class="fw-bold mt-4">Misi</h6>
                        <ol class="text-muted">
                            @forelse ($prodi->misi as $item)
                                <li>{{ $item->content }}</li>
                            @empty
                                <li>Misi belum tersedia</li>
                            @endforelse
                        </ol>
                    </div>

                    {{-- TUJUAN --}}
                    <div class="tab-pane fade" id="tujuan">
                        <h6 class="fw-bold">Tujuan</h6>

                        @php
                            $tujuanList = is_array($prodi->tujuan)
                                ? $prodi->tujuan
                                : json_decode($prodi->tujuan, true);
                        @endphp

                        @if (!empty($tujuanList))
                            <ol class="text-muted">
                                @foreach ($tujuanList as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ol>
                        @else
                            <p class="text-muted">Tujuan belum tersedia</p>
                        @endif
                    </div>

                    {{-- SASARAN --}}
                    <div class="tab-pane fade" id="sasaran">
                        <h6 class="fw-bold">Sasaran Strategis</h6>
                        <p class="text-muted">
                            {{ $prodi->sasaran ?? '-' }}
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


{{-- ================= KURIKULUM ================= --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold">
                {{ $prodi->kurikulum_title ?? 'Kurikulum Program Studi' }}
            </h2>
            <p class="text-muted">
                Informasi lengkap mengenai kurikulum program studi {{ $prodi->name }}
            </p>
        </div>

        <div class="card border-0 shadow-sm p-4">
            <div class="text-muted">
                {!! $prodi->kurikulum_content
                    ? nl2br(e($prodi->kurikulum_content))
                    : '<p>Kurikulum belum tersedia.</p>' !!}
            </div>
        </div>
    </div>
</section>


{{-- ================= AKREDITASI ================= --}}
<section class="bg-light py-5">
    <div class="container">
        <div class="row g-4 justify-content-center">

            @forelse ($akreditasi as $item)
                <div class="col-lg-4 col-md-6">
                    <a href="{{ asset($item->file) }}"
                       download
                       class="text-decoration-none text-dark">
                        <div class="card border-0 shadow-sm h-100 text-center">

                            <img src="{{ asset($item->image) }}"
                                 class="card-img-top"
                                 alt="{{ $item->title }}">

                            <div class="card-body">
                                <h6 class="fw-bold">
                                    {{ $item->title }}
                                </h6>

                                <span class="badge bg-{{ $item->badge_color }}">
                                    {{ $item->badge }}
                                </span>

                                <p class="small text-muted mt-2 mb-0">
                                    {{ $item->description }}
                                </p>
                            </div>

                        </div>
                    </a>
                </div>
            @empty
                <p class="text-center text-muted">
                    Belum ada data akreditasi
                </p>
            @endforelse

        </div>
    </div>
</section>

@endsection
