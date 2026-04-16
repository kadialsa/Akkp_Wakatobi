@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-4">

        <!-- Judul -->
        <div class="text-center mb-4">
            <h3 class="fw-bold">Struktur Organisasi</h3>
            <p class="text-muted">
                Akademi Komunitas Kelautan dan Perikanan Wakatobi
            </p>
        </div>


        <div class="row justify-content-center">

            <!-- Lebih besar -->
            <div class="col-xl-11 col-lg-12">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif


                <div class="card shadow border-0">

                    <div class="card-body p-4">

                        <form action="{{ route('admin.struktur.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <!-- Upload -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    Upload Gambar Struktur Organisasi
                                </label>

                                <input type="file" class="form-control" name="image" accept="image/*"
                                    onchange="previewImage(this)">

                                <small class="text-muted">
                                    Ukuran Gambar 1600 x 900 px | Format JPG / PNG | maksimal 2MB
                                </small>
                            </div>


                            <!-- Preview Lebih Besar -->
                            <div class="text-center mb-3">

                                <!-- Preview Lebih Besar -->
                                <div class="text-center mb-3">

                                    <img id="preview"
                                        src="{{ $struktur && $struktur->image ? asset('uploads/struktur/' . $struktur->image) : '#' }}"
                                        class="img-fluid rounded border {{ $struktur && $struktur->image ? '' : 'd-none' }}"
                                        style="
                                            max-height:750px;
                                            object-fit:contain;
                                            max-width:100%;
                                            padding:10px;
                                            background:#f8f9fa;">

                                </div>

                            </div>



                            <div class="text-center mb-4">
                                <small id="imageSize" class="text-muted">

                                    @php
                                        $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/struktur/' . $struktur->image;
                                    @endphp

                                    @if ($struktur && $struktur->image && file_exists($path))
                                        Ukuran gambar:
                                        {{ getimagesize($path)[0] }} x {{ getimagesize($path)[1] }} px
                                    @else
                                        Pilih gambar untuk melihat ukuran
                                    @endif

                                </small>
                            </div>



                            <div class="text-end">

                                <button class="btn btn-primary px-4">
                                    Simpan
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
