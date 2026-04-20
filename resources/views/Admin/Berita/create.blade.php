@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="fw-bold mb-1">Tambah Berita</h4>
                <small class="text-muted">
                    Tambah berita website AKKP Wakatobi
                </small>
            </div>
        </div>

        {{-- ALERT SUCCESS --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
            </div>
        @endif

        {{-- ALERT ERROR --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <!-- LEFT -->
                        <div class="col-md-8">

                            <!-- Judul -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Judul Berita <span class="text-danger">*</span>
                                </label>

                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">

                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- KATEGORI (DROPDOWN) -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Kategori</label>

                                <select name="category" class="form-control">
                                    <option value="berita" {{ old('category') == 'berita' ? 'selected' : '' }}>
                                        Berita
                                    </option>
                                    <option value="publikasi" {{ old('category') == 'publikasi' ? 'selected' : '' }}>
                                        Publikasi
                                    </option>
                                </select>
                            </div>

                            <!-- ISI BERITA -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Isi Berita <span class="text-danger">*</span>
                                </label>

                                <textarea name="content" id="editor" class="form-control @error('content') is-invalid @enderror" rows="8">{{ old('content') }}</textarea>

                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="col-md-4">

                            <!-- Preview Gambar -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Gambar Utama
                                </label>

                                <div class="mb-3">
                                    <img id="previewImage" src="{{ asset('img/no-image.png') }}"
                                        class="img-fluid rounded shadow-sm"
                                        style="object-fit:cover; max-height:250px; width:100%;">
                                </div>

                                <input type="file" name="image"
                                    class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png"
                                    onchange="previewImage(event)">

                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <small class="text-muted">
                                    Format: JPG / PNG (Max 2MB)
                                </small>
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Status</label>

                                <select name="status" class="form-control">
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>
                                        Draft
                                    </option>
                                    <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>
                                        Publish
                                    </option>
                                </select>
                            </div>

                            <!-- Tanggal -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tanggal Publish</label>

                                <input type="date" name="published_at" class="form-control"
                                    value="{{ old('published_at') }}">
                            </div>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection


@push('scripts')
    <!-- CKEDITOR -->
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>

    <script>
        // CKEDITOR FULL + UPLOAD
        CKEDITOR.replace('editor', {

            height: 400,

            filebrowserUploadUrl: "{{ route('admin.upload.ckeditor') }}?_token={{ csrf_token() }}",
            filebrowserUploadMethod: 'form',

            removeDialogTabs: 'image:advanced;image:Link',

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


        // PREVIEW GAMBAR
        function previewImage(event) {
            const reader = new FileReader();

            reader.onload = function() {
                document.getElementById('previewImage').src = reader.result;
            }

            reader.readAsDataURL(event.target.files[0]);
        }


        // AUTO HIDE ALERT
        setTimeout(function() {
            let alert = document.querySelector('.alert-success');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 4000);
    </script>
@endpush
