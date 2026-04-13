@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Edit Data Akreditasi</h3>
            <a href="{{ route('admin.akreditasi.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
            </div>
        @endif

        {{-- Error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.akreditasi.update', $data->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $data->title) }}"
                            required>
                    </div>

                    {{-- Status Akreditasi --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status Akreditasi</label>
                        <select name="badge" id="badgeSelect" class="form-select">
                            <option value="">-- Pilih Status --</option>
                            <option value="Unggul" {{ old('badge', $data->badge) == 'Unggul' ? 'selected' : '' }}>Unggul
                            </option>
                            <option value="Baik Sekali" {{ old('badge', $data->badge) == 'Baik Sekali' ? 'selected' : '' }}>
                                Baik Sekali</option>
                            <option value="Baik" {{ old('badge', $data->badge) == 'Baik' ? 'selected' : '' }}>Baik
                            </option>
                            <option value="Cukup" {{ old('badge', $data->badge) == 'Cukup' ? 'selected' : '' }}>Cukup
                            </option>
                            <option value="Tidak Terakreditasi"
                                {{ old('badge', $data->badge) == 'Tidak Terakreditasi' ? 'selected' : '' }}>Tidak
                                Terakreditasi</option>
                            <option value="Tahap Akreditas"
                                {{ old('badge', $data->badge) == 'Tahap Akreditas' ? 'selected' : '' }}>Tahap Akreditas
                            </option>
                        </select>
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $data->description) }}</textarea>
                    </div>

                    {{-- Gambar lama --}}
                    @if ($data->image)
                        <div class="mb-3">
                            <label class="form-label">Gambar Akreditasi Saat Ini</label>
                            <div class="mb-2">
                                <img src="{{ asset($data->image) }}" alt="Gambar Akreditasi"
                                    style="max-height: 150px; border-radius:6px;">
                            </div>
                        </div>
                    @endif

                    {{-- Ganti Gambar --}}
                    <div class="mb-3">
                        <label class="form-label">Ganti Gambar (Opsional)</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    {{-- File lama --}}
                    @if ($data->file)
                        <div class="mb-3">
                            <label class="form-label">File Sertifikat Saat Ini</label>
                            <div class="mb-2">
                                <a href="{{ asset($data->file) }}" target="_blank">{{ basename($data->file) }}</a>
                            </div>
                        </div>
                    @endif

                    {{-- Ganti File --}}
                    <div class="mb-3">
                        <label class="form-label">Ganti File Sertifikat (Opsional)</label>
                        <input type="file" name="file" class="form-control">
                    </div>

                    {{-- Submit --}}
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    {{-- Script otomatis set badge color --}}
    <script>
        const badgeSelect = document.getElementById('badgeSelect');
        const badgeColor = document.getElementById('badgeColor');

        const badgeColors = {
            'Unggul': 'warning',
            'Baik Sekali': 'info',
            'Baik': 'primary',
            'Cukup': 'success',
            'Tidak Terakreditasi': 'danger',
            'Tahap Akreditas': 'success'
        };

        badgeSelect.addEventListener('change', function() {
            badgeColor.value = badgeColors[this.value] || '';
        });

        window.addEventListener('DOMContentLoaded', () => {
            const selected = badgeSelect.value;
            if (selected) badgeColor.value = badgeColors[selected] || '';
        });
    </script>

@endsection
