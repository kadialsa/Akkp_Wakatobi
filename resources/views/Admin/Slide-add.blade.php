@extends('layout.Admin')

@section('content')
<div class="container-fluid mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h4 class="fw-bold mb-1">Tambah Slider</h4>
            <small class="text-muted">
                Tambahkan slider baru AKKP Wakatobi
            </small>
        </div>
    </div>

    <!-- Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.slides.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <!-- Judul -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Judul Slider <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="title"
                           value="{{ old('title') }}"
                           class="form-control @error('title') is-invalid @enderror"
                           placeholder="Masukkan judul slider"
                           required>

                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="description"
                              class="form-control @error('description') is-invalid @enderror"
                              rows="4"
                              placeholder="Masukkan deskripsi slider (opsional)">{{ old('description') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Gambar -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Gambar Slider <span class="text-danger">*</span>
                    </label>
                    <input type="file"
                           name="image"
                           class="form-control @error('image') is-invalid @enderror"
                           required>

                    <small class="text-muted">
                        Rekomendasi ukuran: <b>1920 × 800 px</b>
                    </small>

                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="is_active"
                            class="form-select @error('is_active') is-invalid @enderror">
                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>
                            Aktif
                        </option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>
                            Nonaktif
                        </option>
                    </select>

                    @error('is_active')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Urutan -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Urutan</label>
                    <input type="number"
                           name="position"
                           value="{{ old('position', 0) }}"
                           class="form-control @error('position') is-invalid @enderror">

                    <small class="text-muted">
                        Angka lebih kecil akan tampil lebih dulu
                    </small>

                    @error('position')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Action -->
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.slides.index') }}"
                       class="btn btn-light">
                        Batal
                    </a>

                    <button type="submit"
                            class="btn btn-primary px-4">
                        Simpan Slider
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
