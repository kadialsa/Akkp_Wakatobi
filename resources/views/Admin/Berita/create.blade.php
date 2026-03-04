@extends('layout.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

            <div>
                <h4 class="fw-bold mb-1">
                    Tambah Berita
                </h4>

                <small class="text-muted">
                    Tambah Berita website AKKP Wakatobi
                </small>
            </div>
        </div>
        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Judul -->
                    <div class="mb-3">
                        <label class="form-label">Judul Berita</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="category" class="form-control" value="{{ old('category') }}">
                    </div>

                    <!-- Ringkasan -->
                    <div class="mb-3">
                        <label class="form-label">Ringkasan</label>
                        <textarea name="excerpt" rows="3" class="form-control">{{ old('excerpt') }}</textarea>
                    </div>

                    <!-- Konten -->
                    <div class="mb-3">
                        <label class="form-label">Isi Berita</label>
                        <textarea name="content" rows="7" class="form-control" required>{{ old('content') }}</textarea>
                    </div>

                    <!-- Gambar -->
                    <div class="mb-3">
                        <label class="form-label">Gambar Utama</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <!-- Tanggal Publish -->
                    <div class="mb-3">
                        <label class="form-label">Tanggal Publish</label>
                        <input type="date" name="published_at" class="form-control" value="{{ old('published_at') }}">
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>Publish</option>
                        </select>
                    </div>

                    <!-- Tombol -->
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                </form>

            </div>
        </div>

    </div>
@endsection
