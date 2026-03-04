@extends('layout.admin')

@section('content')
<div class="container-fluid mt-4">

    <!-- Header -->
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Manajemen Akreditasi</h3>
        <p class="text-muted mb-0">
            Kelola informasi akreditasi kampus dan program studi
        </p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">

        @foreach ($data as $item)
            <div class="col-xl-4 col-md-6">
                <div class="card border-0 shadow-sm h-100">

                    <!-- Header -->
                    <div class="card-header bg-dark text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold text-uppercase small">
                                {{ $item->type }}
                            </span>

                            @if ($item->badge)
                                <span class="badge bg-{{ $item->badge_color ?? 'secondary' }}">
                                    {{ $item->badge }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="card-body">

                        <form method="POST"
                              action="{{ route('admin.akreditasi.update', $item->id) }}"
                              enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <!-- Judul -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Judul Akreditasi
                                </label>
                                <input type="text"
                                       name="title"
                                       class="form-control"
                                       value="{{ $item->title }}">
                            </div>

                            <!-- Badge -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Status Akreditasi
                                </label>

                                <select name="badge" class="form-select">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Unggul" {{ $item->badge == 'Unggul' ? 'selected' : '' }}>Unggul</option>
                                    <option value="Baik Sekali" {{ $item->badge == 'Baik Sekali' ? 'selected' : '' }}>Baik Sekali</option>
                                    <option value="Baik" {{ $item->badge == 'Baik' ? 'selected' : '' }}>Baik</option>
                                    <option value="Cukup" {{ $item->badge == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                                    <option value="Tidak Terakreditasi" {{ $item->badge == 'Tidak Terakreditasi' ? 'selected' : '' }}>
                                        Tidak Terakreditasi
                                    </option>
                                </select>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Deskripsi
                                </label>
                                <textarea name="description"
                                          rows="3"
                                          class="form-control">{{ $item->description }}</textarea>
                            </div>

                            <!-- Preview Gambar -->
                            @if ($item->image)
                                <div class="mb-3">
                                    <img src="{{ asset($item->image) }}"
                                         class="rounded shadow-sm"
                                         style="width:120px;height:120px;object-fit:cover;">
                                </div>
                            @endif

                            <!-- Upload Gambar (Hanya Gambar) -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Ganti Gambar
                                </label>

                                <input type="file"
                                       name="image"
                                       accept=".jpg,.jpeg,.png"
                                       class="form-control @error('image') is-invalid @enderror">

                                <small class="text-muted">
                                    Ukuran disarankan: 200 x 200 px | Format: JPG/PNG | Maksimal 2MB
                                </small>

                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Upload File (Bisa PDF / Gambar) -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Upload File (PDF / JPG / PNG)
                                </label>

                                <input type="file"
                                       name="file"
                                       accept=".pdf,.jpg,.jpeg,.png"
                                       class="form-control @error('file') is-invalid @enderror">

                                <small class="text-muted">
                                    Format diperbolehkan: PDF, JPG, PNG | Maksimal 5MB
                                </small>

                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @if ($item->file)
                                <div class="mb-3">
                                    <a href="{{ asset($item->file) }}"
                                       target="_blank"
                                       class="btn btn-outline-secondary btn-sm w-100">
                                        Lihat File Saat Ini
                                    </a>
                                </div>
                            @endif

                            <!-- Button -->
                            <button class="btn btn-primary w-100 fw-semibold">
                                Update Data
                            </button>

                        </form>

                    </div>

                </div>
            </div>
        @endforeach

    </div>
</div>
@endsection
