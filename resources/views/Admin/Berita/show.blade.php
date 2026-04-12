@extends('layout.admin')

@section('content')
<div class="container-fluid mt-4">

    <!-- Header -->
    <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h4 class="fw-bold mb-0">Detail Berita</h4>
            <small class="text-muted">Preview lengkap berita</small>
        </div>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary btn-sm">
            ← Kembali
        </a>
    </div>

    <div class="row g-4">

        <!-- Konten Utama -->
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <!-- Judul -->
                    <h2 class="fw-bold mb-3 text-title-dark berita-title">
                        {{ $berita->title }}
                    </h2>

                    <!-- Gambar -->
                    @if ($berita->image)
                        <div class="mb-4">
                            <img src="{{ asset($berita->image) }}"
                                 class="img-fluid rounded-4 w-100 berita-img">
                        </div>
                    @endif

                    <!-- Isi -->
                    <div class="mt-4 berita-content">
                        {!! nl2br(e($berita->content)) !!}
                    </div>

                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <h6 class="fw-bold mb-4 text-uppercase text-muted">
                        Informasi Berita
                    </h6>

                    <div class="mb-3">
                        <small class="text-muted d-block">Kategori</small>
                        <span class="fw-semibold">
                            {{ $berita->category ?? 'Umum' }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Tanggal</small>
                        <span class="fw-semibold">
                            {{ $berita->published_at ? \Carbon\Carbon::parse($berita->published_at)->format('d M Y') : '-' }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Author</small>
                        <span class="fw-semibold">
                            {{ optional($berita->user)->name ?? 'Admin' }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Views</small>
                        <span class="fw-semibold">
                            {{ $berita->views ?? 0 }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Status</small>
                        @if ($berita->status == 'publish')
                            <span class="badge bg-success px-3 py-2">Publish</span>
                        @else
                            <span class="badge bg-secondary px-3 py-2">Draft</span>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>
@endsection
