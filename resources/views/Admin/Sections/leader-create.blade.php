@extends('layout.admin')

@section('content')
    <div class="container-fluid mt-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="fw-bold mb-1">
                    Tambah Anggota - {{ $section->title }}
                </h4>
                <small class="text-muted">
                    Tambahkan data baru pada section
                    <strong>{{ $section->title }}</strong>
                </small>
            </div>
        </div>


        <!-- Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                {{-- Alert Global --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terjadi Kesalahan!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.leader.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="section_id" value="{{ $section->id }}">

                    <div class="row">

                        <!-- Kolom Kiri -->
                        <div class="col-md-8">

                            <!-- Jabatan -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Jabatan</label>
                                <input type="text" name="position" value="{{ old('position') }}"
                                    class="form-control @error('position') is-invalid @enderror" required>

                                @error('position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Nama -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror" required>

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Gelar -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Gelar</label>
                                <input type="text" name="degree" value="{{ old('degree') }}"
                                    class="form-control @error('degree') is-invalid @enderror">

                                @error('degree')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-4">

                            <!-- Foto -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Foto</label>

                                <input type="file" name="photo" id="photoInput"
                                    class="form-control @error('photo') is-invalid @enderror">

                                <small class="text-muted">
                                    Format: JPG / PNG <br>
                                    Maksimal: 2MB <br>
                                    Rekomendasi ukuran: <strong>840 x 1040 px (rasio 4:5)</strong>
                                </small>

                                @error('photo')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Preview -->
                            <div class="mt-3">
                                <img id="previewImage" class="img-fluid rounded shadow-sm"
                                    style="max-height:300px; object-fit:cover; display:none;">
                            </div>

                        </div>

                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            Simpan Data
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection


@push('scripts')
    <script>
        document.getElementById('photoInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const img = new Image();
            const reader = new FileReader();

            reader.onload = function(event) {
                img.src = event.target.result;
                img.onload = function() {
                    const ratio = img.width / img.height;

                    if (Math.abs(ratio - (4 / 5)) > 0.01) {
                        alert("⚠ Rasio gambar harus 4:5 (contoh 840x1040)");
                        e.target.value = "";
                        return;
                    }

                    const preview = document.getElementById('previewImage');
                    preview.src = event.target.result;
                    preview.style.display = "block";
                };
            };

            reader.readAsDataURL(file);
        });
    </script>
@endpush
