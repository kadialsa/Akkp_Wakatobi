@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="fw-bold mb-1">Edit Berita</h4>
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
                        <label class="form-label fw-semibold">Judul Berita</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $berita->title) }}"
                            required>
                    </div>

                    <!-- KATEGORI (DROPDOWN) -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>

                        <select name="category" class="form-control">
                            <option value="berita" {{ old('category', $berita->category) == 'berita' ? 'selected' : '' }}>
                                Berita
                            </option>

                            <option value="publikasi"
                                {{ old('category', $berita->category) == 'publikasi' ? 'selected' : '' }}>
                                Publikasi
                            </option>
                        </select>
                    </div>

                    <!-- ISI BERITA -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Isi Berita</label>

                        <textarea name="content" id="editor" class="form-control" rows="7" required>{{ old('content', $berita->content) }}</textarea>
                    </div>

                    <!-- GAMBAR UTAMA -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gambar Utama</label>

                        @if ($berita->image)
                            <div class="mb-2">
                                <img src="{{ asset($berita->image) }}"
                                    style="width:120px;height:80px;object-fit:cover;border-radius:6px;">
                            </div>
                        @endif

                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                            accept="image/jpeg,image/png" onchange="validateFile(this)">

                        <small class="text-muted">
                            Format JPG/PNG (Max 2MB)
                        </small>

                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- TANGGAL -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal Publish</label>
                        <input type="date" name="published_at" class="form-control"
                            value="{{ old('published_at', $berita->published_at) }}">
                    </div>

                    <!-- STATUS -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>

                        <select name="status" class="form-control">
                            <option value="draft" {{ old('status', $berita->status) == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>

                            <option value="publish" {{ old('status', $berita->status) == 'publish' ? 'selected' : '' }}>
                                Publish
                            </option>
                        </select>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>
@endsection


@push('scripts')
    <!-- CKEDITOR FULL -->
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('editor', {

            height: 400,

            // 🔥 Upload gambar langsung
            filebrowserUploadUrl: "{{ route('admin.upload.ckeditor') }}?_token={{ csrf_token() }}",
            filebrowserUploadMethod: 'form',

            // 🔥 Sederhanakan popup image
            removeDialogTabs: 'image:advanced;image:Link',

            // 🔥 Toolbar lengkap
            toolbar: [

                {
                    name: 'document',
                    items: ['Source', 'Preview']
                },

                {
                    name: 'clipboard',
                    items: ['Cut', 'Copy', 'Paste', 'Undo', 'Redo']
                },

                {
                    name: 'editing',
                    items: ['Find', 'Replace']
                },

                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat']
                },

                {
                    name: 'paragraph',
                    items: [
                        'NumberedList', 'BulletedList',
                        'Outdent', 'Indent',
                        'Blockquote',
                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'
                    ]
                },

                {
                    name: 'links',
                    items: ['Link', 'Unlink']
                },

                {
                    name: 'insert',
                    items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']
                },

                {
                    name: 'styles',
                    items: ['Format', 'Font', 'FontSize']
                },

                {
                    name: 'colors',
                    items: ['TextColor', 'BGColor']
                },

                {
                    name: 'tools',
                    items: ['Maximize']
                }

            ]

        });


        // VALIDASI GAMBAR UTAMA
        function validateFile(input) {

            const file = input.files[0];
            if (!file) return;

            const allowedTypes = ['image/jpeg', 'image/png'];
            const maxSize = 2 * 1024 * 1024;

            if (!allowedTypes.includes(file.type)) {
                alert('Hanya JPG/PNG!');
                input.value = '';
                return;
            }

            if (file.size > maxSize) {
                alert('Max 2MB!');
                input.value = '';
                return;
            }
        }
    </script>
@endpush
