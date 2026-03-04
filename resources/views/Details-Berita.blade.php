@extends('layout.App')

@section('content')

@php use Illuminate\Support\Str; @endphp

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-9">

            <!-- Gambar Utama -->
            @if ($berita->image)
                <div class="detail-image mb-4">
                    <img src="{{ asset($berita->image) }}" alt="{{ $berita->title }}" class="img-fluid rounded w-100">
                </div>
            @endif

            <!-- Kategori -->
            @if ($berita->category)
                <span class="badge bg-success mb-3">
                    {{ $berita->category }}
                </span>
            @endif

            <!-- Judul -->
            <h1 class="fw-bold mb-3">
                {{ $berita->title }}
            </h1>

            <!-- META INFO (SUDAH DISESUAIKAN) -->
            <div class="text-muted mb-4">

                <i class="bi bi-calendar-event"></i>
                {{ $berita->published_at
                    ? \Carbon\Carbon::parse($berita->published_at)->translatedFormat('d F Y')
                    : '-' }}

                &nbsp;&nbsp;|&nbsp;&nbsp;

                <i class="bi bi-person"></i>
                {{ optional($berita->user)->name ?? 'Admin' }}

                &nbsp;&nbsp;|&nbsp;&nbsp;

                <i class="bi bi-eye"></i>
                {{ $berita->views ?? 0 }} Dilihat

            </div>

            <!-- Isi Berita -->
            <div class="detail-content">
                {!! $berita->content !!}
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-between mt-5">
                <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">
                    ← Kembali ke Berita
                </a>

                <button onclick="shareBerita()" class="btn btn-primary">
                    Bagikan Berita
                </button>
            </div>

            <script>
                function shareBerita() {
                    if (navigator.share) {
                        navigator.share({
                            title: "{{ $berita->title }}",
                            text: "{{ Str::limit(strip_tags($berita->excerpt ?? $berita->content), 100) }}",
                            url: "{{ url()->current() }}"
                        });
                    } else {
                        alert('Browser tidak mendukung fitur share');
                    }
                }
            </script>

        </div>
    </div>
</div>

@endsection
