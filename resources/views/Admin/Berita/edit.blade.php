@extends('layout.admin')

@section('content')
    <div class="container-fluid mt-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

            <div>
                <h4 class="fw-bold mb-1">
                    Edit Berita
                </h4>

                <small class="text-muted">
                    Update data Berita website AKKP Wakatobi
                </small>
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Judul -->
                    <div class="mb-3">
                        <label class="form-label">Judul Berita</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $berita->title) }}"
                            required>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="category" class="form-control"
                            value="{{ old('category', $berita->category) }}">
                    </div>

                    <!-- Ringkasan -->
                    <div class="mb-3">
                        <label class="form-label">Ringkasan</label>
                        <textarea name="excerpt" rows="3" class="form-control">{{ old('excerpt', $berita->excerpt) }}</textarea>
                    </div>

                    <!-- Konten -->
                    <div class="mb-3">
                        <label class="form-label">Isi Berita</label>
                        <textarea name="content" rows="7" class="form-control" required>{{ old('content', $berita->content) }}</textarea>
                    </div>

                    <!-- Gambar -->
                    <div class="mb-3">
                        <label class="form-label">Gambar Utama</label>

                        @if ($berita->image)
                            <div class="mb-2">
                                <img src="{{ asset($berita->image) }}"
                                    style="width:120px;height:80px;object-fit:cover;border-radius:6px;">
                            </div>
                        @endif

                        <input type="file" name="image" class="form-control">
                    </div>

                    <!-- Tanggal Publish -->
                    <div class="mb-3">
                        <label class="form-label">Tanggal Publish</label>
                        <input type="date" name="published_at" class="form-control"
                            value="{{ old('published_at', $berita->published_at) }}">
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">

                            <option value="draft" {{ old('status', $berita->status) == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>

                            <option value="publish" {{ old('status', $berita->status) == 'publish' ? 'selected' : '' }}>
                                Publish
                            </option>

                        </select>
                    </div>

                    <!-- Tombol -->
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>

                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                </form>

            </div>
        </div>

    </div>
@endsection
