@extends('layout.App')

@section('content')
    <div class="container py-5">

        <!-- TITLE SECTION -->
        <div class="row mb-5">
            <div class="col text-center">
                <h1 class="fw-bold text-title-dark">
                   BERITA AKKP WAKATOBI
                </h1>

                <p class="text-muted">
                    Informasi kegiatan akademik, kemahasiswaan, dan pengabdian masyarakat pesisir
                </p>

                <hr class="mx-auto" style="width:90px;height:4px;background:linear-gradient(90deg,#014f86,#2a9d8f);">
            </div>
        </div>


        <!-- CARD SECTION -->
        <div class="row g-4 gy-5">

            @forelse($beritas as $item)
                <div class="col-lg-4 col-md-6">

                    <div class="card news-card h-100 shadow-sm">

                        @php
                            $image = $item->image;

                            if (!$image) {
                                $imageUrl = 'https://via.placeholder.com/600x400?text=No+Image';
                            } elseif (\Illuminate\Support\Str::startsWith($image, ['http://', 'https://'])) {
                                $imageUrl = $image;
                            } elseif (\Illuminate\Support\Str::startsWith($image, 'uploads/')) {
                                $imageUrl = asset($image);
                            } else {
                                $imageUrl = asset('uploads/beritas/' . $image);
                            }
                        @endphp

                        <!-- IMAGE -->
                        <img src="{{ $imageUrl }}" class="card-img-top news-img" alt="{{ $item->title }}"
                            style="height:220px;object-fit:cover;">


                        <div class="card-body">

                            <!-- KATEGORI -->
                            <span class="badge badge-akkp mb-2">
                                {{ $item->category ?? 'Berita' }}
                            </span>

                            <!-- JUDUL -->
                            <h5 class="card-title mt-2">
                                {{ $item->title }}
                            </h5>

                            <!-- RINGKASAN -->
                            <p class="card-text">
                                {{ $item->excerpt }}
                            </p>

                        </div>


                        <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">

                            <div class="d-flex flex-column">

                                <!-- TANGGAL -->
                                <span class="news-date text-muted small"style="font-size:15px;">
                                    <i class="bi bi-calendar-event"></i>

                                    {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->translatedFormat('d M Y') : '-' }}
                                </span>

                                {{-- Views --}}
                                <span class="news-views text-muted" style="font-size:15px;">
                                    <i class="fa fa-eye me-1"></i> {{ $item->views ?? 0 }} Dilihat
                                </span>

                            </div>


                            <!-- DETAIL BUTTON -->
                            <a href="{{ route('berita.detail', $item->slug) }}" class="btn btn-akkp btn-sm">
                                Baca Selengkapnya
                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12 text-center">
                    <p class="text-muted">
                        Belum ada berita tersedia
                    </p>
                </div>
            @endforelse

        </div>


        <!-- PAGINATION -->
        <div class="mt-5 d-flex justify-content-center">
            {{ $beritas->links() }}
        </div>

    </div>
@endsection
