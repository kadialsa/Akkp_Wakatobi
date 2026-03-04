@extends('layout.admin')

@section('content')
    <div class="container-fluid mt-4">

        <h3 class="mb-4">Tambah Program Studi</h3>

        {{-- ALERT ERROR GLOBAL --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.prodi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- ================= IDENTITAS ================= --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header fw-bold">Identitas Prodi</div>
                <div class="card-body">

                    {{-- Nama Prodi --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Prodi *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" required>
                    </div>

                    {{-- Header Title --}}
                    <div class="mb-3">
                        <label class="form-label">Header Title</label>
                        <input type="text" name="header_title" class="form-control" value="{{ old('header_title') }}">
                    </div>

                    {{-- Thumbnail Prodi --}}
                    <div class="mb-3">
                        <label class="form-label">Thumbnail Prodi</label>

                        <input type="file" name="thumbnail" accept=".jpg,.jpeg,.png"
                            class="form-control @error('thumbnail') is-invalid @enderror"
                            onchange="validateFile(this); previewImage(event, 'previewThumbnail')">

                        <small class="text-muted">
                            Ukuran disarankan: 500x500px | Format: JPG, PNG | Maksimal 2MB
                        </small>

                        @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <img id="previewThumbnail" src="{{ asset('img/default-thumbnail.jpg') }}" class="img-fluid rounded mb-3"
                        width="200" alt="Thumbnail Prodi">

                    {{-- Short Description --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Singkat (Untuk Card)</label>
                        <input type="text" name="short_description" class="form-control"
                            placeholder="Contoh: Program vokasi bidang kelautan" value="{{ old('short_description') }}">
                    </div>

                </div>
            </div>

            {{-- ================= SEJARAH ================= --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header fw-bold">Sejarah</div>
                <div class="card-body">
                    <input type="text" name="sejarah_title" class="form-control mb-3" placeholder="Judul Sejarah"
                        value="{{ old('sejarah_title') }}">
                    <textarea name="sejarah_content" class="form-control mb-3" rows="4" placeholder="Isi sejarah">{{ old('sejarah_content') }}</textarea>

                    <div class="mb-3">
                        <label class="form-label">Gambar Sejarah</label>

                        <input type="file" name="sejarah_image" accept=".jpg,.jpeg,.png"
                            class="form-control @error('sejarah_image') is-invalid @enderror"
                            onchange="validateFile(this); previewImage(event, 'previewSejarah')">

                        <small class="text-muted">
                            Ukuran disarankan: 1400x760px | Format: JPG, PNG | Maksimal 2MB
                        </small>

                        @error('sejarah_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <img id="previewSejarah" src="{{ asset('img/default-sejarah.jpg') }}" class="img-fluid rounded mb-3"
                        width="200">
                </div>
            </div>

            {{-- ================= VISI & MISI ================= --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header fw-bold">Visi & Misi</div>
                <div class="card-body">
                    <label>Visi</label>
                    <textarea name="visi" class="form-control mb-3" rows="3">{{ old('visi') }}</textarea>

                    <label>Misi</label>
                    <div id="misi-wrapper">
                        <div class="input-group mb-2">
                            <input type="text" name="misi[]" class="form-control" placeholder="Misi 1">
                            <button type="button" class="btn btn-success" onclick="addMisi()">+</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= TUJUAN & SASARAN ================= --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header fw-bold">Tujuan & Sasaran</div>
                <div class="card-body">
                    <label>Tujuan</label>
                    <textarea name="tujuan" class="form-control mb-3" rows="3">{{ old('tujuan') }}</textarea>

                    <label>Sasaran Strategis</label>
                    <textarea name="sasaran" class="form-control" rows="3">{{ old('sasaran') }}</textarea>
                </div>
            </div>

            {{-- ================= KURIKULUM ================= --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header fw-bold">Kurikulum</div>
                <div class="card-body">
                    <input type="text" name="kurikulum_title" class="form-control mb-3" placeholder="Judul Kurikulum"
                        value="{{ old('kurikulum_title') }}">
                    <textarea name="kurikulum_content" class="form-control" rows="4">{{ old('kurikulum_content') }}</textarea>
                </div>
            </div>

            {{-- ================= KAPRODI ================= --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header fw-bold">Ketua Program Studi</div>
                <div class="card-body">
                    <input type="text" name="kaprodi_name" class="form-control mb-2" placeholder="Nama"
                        value="{{ old('kaprodi_name') }}">
                    <input type="text" name="kaprodi_nip" class="form-control mb-2" placeholder="NIP"
                        value="{{ old('kaprodi_nip') }}">
                    <input type="text" name="kaprodi_nidn" class="form-control mb-3" placeholder="NIDN"
                        value="{{ old('kaprodi_nidn') }}">

                    <div class="mb-3">
                        <label class="form-label">Foto Kaprodi</label>

                        <input type="file" name="kaprodi_photo" accept=".jpg,.jpeg,.png"
                            class="form-control @error('kaprodi_photo') is-invalid @enderror"
                            onchange="validateFile(this); previewImage(event, 'previewKaprodi')">

                        <small class="text-muted">
                            Ukuran disarankan: 300x400px | Format: JPG, PNG | Maksimal 2MB
                        </small>

                        @error('kaprodi_photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <img id="previewKaprodi" src="{{ asset('img/default-user.png') }}" class="img-fluid rounded mb-3"
                        width="200">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.prodi.index') }}" class="btn btn-secondary">Kembali</a>

        </form>
    </div>

    {{-- ================= SCRIPT ================= --}}
    <script>
        function addMisi() {
            let wrapper = document.getElementById('misi-wrapper');
            let div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');
            div.innerHTML = `
        <input type="text" name="misi[]" class="form-control" placeholder="Misi">
        <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">-</button>
    `;
            wrapper.appendChild(div);
        }

        function previewImage(event, previewId) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById(previewId);
                output.src = reader.result;
            };
            reader.readAsDataURL(file);
        }

        function validateFile(input) {
            const file = input.files[0];
            if (!file) return;

            const allowedTypes = ['image/jpeg', 'image/png'];
            const maxSize = 2 * 1024 * 1024; // 2MB

            if (!allowedTypes.includes(file.type)) {
                alert('Hanya file JPG dan PNG yang diperbolehkan!');
                input.value = '';
                return;
            }

            if (file.size > maxSize) {
                alert('Ukuran file maksimal 2MB!');
                input.value = '';
                return;
            }
        }
    </script>
@endsection
