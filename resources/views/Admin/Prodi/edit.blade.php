@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-4">

        <h3 class="mb-4">Edit Program Studi</h3>

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

        <form action="{{ route('admin.prodi.update', $prodi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- ================= IDENTITAS ================= --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header fw-bold">Identitas Program Studi</div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Program Studi</label>
                        <input type="text" name="name" value="{{ old('name', $prodi->name) }}" class="form-control"
                            placeholder="Contoh: D3 Teknik Informatika">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Header Halaman</label>
                        <input type="text" name="header_title" value="{{ old('header_title', $prodi->header_title) }}"
                            class="form-control" placeholder="Contoh: Selamat Datang di Prodi TI">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Thumbnail Program Studi</label>

                        @if ($prodi->thumbnail)
                            <div class="mb-2">
                                <img src="{{ asset('uploads/prodi/thumbnail/' . $prodi->thumbnail) }}" width="150" class="rounded border">
                            </div>
                        @endif

                        <input type="file" name="thumbnail" class="form-control" accept=".jpg,.jpeg,.png"
                            onchange="validateFile(this); previewImage(event,'previewThumbnail')">

                        <small class="text-muted">
                            Ukuran disarankan: 500x500px | Format: JPG/PNG | Maksimal 2MB
                        </small>

                        <img id="previewThumbnail" class="img-fluid rounded d-none mt-2" width="200">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi Singkat (Card Prodi)</label>
                        <input type="text" name="short_description" class="form-control"
                            placeholder="Contoh: Program vokasi unggulan bidang teknologi"
                            value="{{ old('short_description', $prodi->short_description) }}">
                    </div>

                </div>
            </div>

            {{-- ================= SEJARAH ================= --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header fw-bold">Sejarah</div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Sejarah</label>
                        <input type="text" name="sejarah_title" value="{{ old('sejarah_title', $prodi->sejarah_title) }}"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Isi Sejarah</label>
                        <textarea name="sejarah_content" class="form-control" rows="4">{{ old('sejarah_content', $prodi->sejarah_content) }}</textarea>
                    </div>

                    @if ($prodi->sejarah_image)
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Gambar Saat Ini</label><br>
                            <img src="{{ asset('uploads/prodi/sejarah/' . $prodi->sejarah_image) }}" width="150" class="rounded border">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ganti Gambar Sejarah</label>

                        <input type="file" name="sejarah_image" class="form-control" accept=".jpg,.jpeg,.png"
                            onchange="validateFile(this); previewImage(event,'previewSejarah')">
                        <small class="text-muted">
                            Ukuran disarankan: 1400x760px | Format: JPG/PNG | Maksimal 2MB
                        </small>

                        <img id="previewSejarah" class="img-fluid rounded d-none mt-2" width="200">
                    </div>

                </div>
            </div>

            {{-- ================= VISI & MISI ================= --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header fw-bold">Visi & Misi</div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Visi Program Studi</label>
                        <textarea name="visi" class="form-control" rows="3">{{ old('visi', $prodi->visi) }}</textarea>
                    </div>

                    <label class="form-label fw-semibold">Daftar Misi</label>
                    <div id="misi-wrapper">
                        @php
                            $oldMisi = old('misi', $prodi->misi->pluck('content')->toArray());
                        @endphp

                        @foreach ($oldMisi as $m)
                            <div class="input-group mb-2">
                                <input type="text" name="misi[]" value="{{ $m }}" class="form-control">
                                <button type="button" class="btn btn-danger"
                                    onclick="this.parentElement.remove()">-</button>
                            </div>
                        @endforeach

                        @if (count($oldMisi) == 0)
                            <div class="input-group mb-2">
                                <input type="text" name="misi[]" class="form-control" placeholder="Misi">
                                <button type="button" class="btn btn-success" onclick="addMisi()">+</button>
                            </div>
                        @endif
                    </div>

                    <button type="button" class="btn btn-sm btn-success mt-2" onclick="addMisi()">
                        Tambah Misi
                    </button>

                </div>
            </div>

            {{-- ================= TUJUAN & SASARAN ================= --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header fw-bold">Tujuan & Sasaran</div>
                <div class="card-body">

                    {{-- TUJUAN DINAMIS --}}
                    <label class="form-label fw-semibold">Daftar Tujuan Program Studi</label>

                    <div id="tujuan-wrapper">
                        @php
                            $oldTujuan = old(
                                'tujuan',
                                is_array($prodi->tujuan) ? $prodi->tujuan : json_decode($prodi->tujuan, true) ?? [],
                            );
                        @endphp

                        @foreach ($oldTujuan as $t)
                            <div class="input-group mb-2">
                                <input type="text" name="tujuan[]" value="{{ $t }}" class="form-control">
                                <button type="button" class="btn btn-danger"
                                    onclick="this.parentElement.remove()">-</button>
                            </div>
                        @endforeach

                        @if (count($oldTujuan) == 0)
                            <div class="input-group mb-2">
                                <input type="text" name="tujuan[]" class="form-control" placeholder="Tujuan">
                                <button type="button" class="btn btn-success" onclick="addTujuan()">+</button>
                            </div>
                        @endif
                    </div>

                    <button type="button" class="btn btn-sm btn-success mt-2" onclick="addTujuan()">
                        Tambah Tujuan
                    </button>

                    <hr>

                    {{-- SASARAN --}}
                    <div class="mt-3">
                        <label class="form-label fw-semibold">Sasaran Strategis</label>
                        <textarea name="sasaran" class="form-control" rows="3">{{ old('sasaran', $prodi->sasaran) }}</textarea>
                    </div>

                </div>
            </div>

            {{-- ================= KURIKULUM ================= --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header fw-bold">Kurikulum</div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Kurikulum</label>
                        <input type="text" name="kurikulum_title"
                            value="{{ old('kurikulum_title', $prodi->kurikulum_title) }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi Kurikulum</label>
                        <textarea id="editor_kurikulum" name="kurikulum_content" class="form-control" rows="4">
                         {{ old('kurikulum_content', $prodi->kurikulum_content) }}
                         </textarea>
                    </div>

                </div>
            </div>

            {{-- ================= KETUA PROGRAM STUDI ================= --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header fw-bold">Ketua Program Studi</div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Ketua Prodi</label>
                        <input type="text" name="kaprodi_name"
                            value="{{ old('kaprodi_name', $prodi->kaprodi_name) }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">NIP</label>
                        <input type="text" name="kaprodi_nip" value="{{ old('kaprodi_nip', $prodi->kaprodi_nip) }}"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">NIDN</label>
                        <input type="text" name="kaprodi_nidn"
                            value="{{ old('kaprodi_nidn', $prodi->kaprodi_nidn) }}" class="form-control">
                    </div>

                    @if ($prodi->kaprodi_photo)
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Foto Saat Ini</label><br>
                            <img src="{{ asset('uploads/prodi/kaprodi/' . $prodi->kaprodi_photo) }}" width="150" class="rounded border">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ganti Foto Kaprodi</label>

                        <input type="file" name="kaprodi_photo" class="form-control" accept=".jpg,.jpeg,.png"
                            onchange="validateFile(this); previewImage(event, 'previewKaprodi')">

                        <small class="text-muted">
                            Ukuran disarankan: 300x400px (Portrait) | Format: JPG/PNG | Maksimal 2MB
                        </small>

                        <img id="previewKaprodi" class="img-fluid rounded d-none mt-2" width="200">
                    </div>

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.prodi.index') }}" class="btn btn-secondary">Kembali</a>

        </form>
    </div>

    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

    <script>

        CKEDITOR.replace('editor_kurikulum'); //CKEditor

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
                output.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }


        function addTujuan() {
            let wrapper = document.getElementById('tujuan-wrapper');
            let div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');
            div.innerHTML = `
    <input type="text" name="tujuan[]" class="form-control" placeholder="Tujuan">
    <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">-</button>
    `;
            wrapper.appendChild(div);
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
