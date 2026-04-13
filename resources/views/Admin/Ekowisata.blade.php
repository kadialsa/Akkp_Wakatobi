@extends('layout.Admin')

@section('content')
    <div class="container py-4">

        <h3 class="mb-4 fw-bold">Manajemen Prodi Ekowisata</h3>

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- ================= PROFIL ================= --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">Profil & Sejarah</div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.ekowisata.profile.update') }}" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- JUDUL --}}
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="title" class="form-control"
                            value="{{ old('title', $profile->title ?? '') }}" required>
                    </div>

                    {{-- SEJARAH --}}
                    <div class="mb-3">
                        <label class="form-label">Sejarah</label>
                        <textarea name="history" class="form-control" rows="5" required>{{ old('history', $profile->history ?? '') }}</textarea>
                    </div>

                    {{-- GAMBAR --}}
                    <div class="mb-3">
                        <label class="form-label">Gambar (Opsional)</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    {{-- PREVIEW GAMBAR --}}
                    @if (!empty($profile?->image))
                        <div class="mb-3">
                            <img src="{{ asset('uploads/ekowisata/' . $profile->image) }}" class="img-fluid rounded"
                                style="max-height: 200px;">
                        </div>
                    @endif

                    <button class="btn btn-primary">
                        Update Profil
                    </button>
                </form>
            </div>
        </div>


        {{-- ================= KAPRODI ================= --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">Ketua Program Studi</div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.ekowisata.kaprodi.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- FOTO KAPRODI --}}
                    @if (!empty($kaprodi->photo))
                        <div class="mb-3">
                            <img src="{{ asset($kaprodi->photo) }}" alt="Foto Kaprodi" class="img-thumbnail" width="150">
                        </div>
                    @endif

                    <div class="mb-2">
                        <label class="form-label">Nama Kaprodi</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $kaprodi->name ?? '') }}" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">NIP</label>
                        <input type="text" name="nip" class="form-control"
                            value="{{ old('nip', $kaprodi->nip ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NIDN</label>
                        <input type="text" name="nidn" class="form-control"
                            value="{{ old('nidn', $kaprodi->nidn ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Kaprodi</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                        <small class="text-muted">
                            Format: JPG, JPEG, PNG. Maks 2MB.
                        </small>
                    </div>

                    <button class="btn btn-primary">
                        Update Kaprodi
                    </button>
                </form>
            </div>
        </div>

        {{-- ================= VISI & MISI ================= --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">Visi & Misi</div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.ekowisata.visimisi.update') }}">
                    @csrf
                    @method('PUT')

                    {{-- ===== VISI ===== --}}
                    <div class="mb-4">
                        <label class="fw-semibold">Visi</label>
                        <textarea name="visi" class="form-control" rows="3" required>{{ $visi->content ?? '' }}</textarea>
                    </div>

                    {{-- ===== MISI ===== --}}
                    <div class="mb-3">
                        <label class="fw-semibold">Misi</label>

                        @forelse ($misi as $item)
                            <input type="hidden" name="misi[{{ $item->id }}][id]" value="{{ $item->id }}">

                            <input type="text" name="misi[{{ $item->id }}][content]" class="form-control mb-2"
                                value="{{ $item->content }}" required>
                        @empty
                            <p class="text-muted">Misi belum tersedia</p>
                        @endforelse
                    </div>

                    <button class="btn btn-primary">
                        Update Visi & Misi
                    </button>
                </form>
            </div>
        </div>


        {{-- ================= TUJUAN ================= --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">Tujuan</div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.ekowisata.tujuan.update') }}">
                    @csrf
                    @method('PUT')

                    @foreach ($tujuans as $item)
                        <input type="text" name="tujuan[]" class="form-control mb-2" value="{{ $item->content }}">
                    @endforeach

                    <button class="btn btn-primary">Update Tujuan</button>
                </form>
            </div>
        </div>

        {{-- ================= STRATEGIS ================= --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">Sasaran Strategis</div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.ekowisata.strategis.update') }}">
                    @csrf
                    @method('PUT')

                    <textarea name="content" class="form-control mb-3" rows="3">{{ $strategis->content }}</textarea>

                    <button class="btn btn-primary">Update Strategis</button>
                </form>
            </div>
        </div>

        {{-- ================= KURIKULUM ================= --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">Kurikulum</div>
            <div class="card-body">

                <form method="POST" action="{{ route('admin.ekowisata.kurikulum.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Kurikulum</label>
                        <input type="text" name="title" class="form-control" placeholder="Judul Kurikulum"
                            value="{{ $kurikulum->title ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Isi Kurikulum</label>
                        <textarea id="kurikulum-editor" name="content" class="form-control" rows="10" required>
                    {{ $kurikulum->content ?? '' }}
                </textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Kurikulum</button>
                </form>

            </div>
        </div>

        <!-- CKEditor 5 Classic Gratis -->
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#kurikulum-editor'))
                .catch(error => {
                    console.error(error);
                });
        </script>

        </script>
    @endsection
