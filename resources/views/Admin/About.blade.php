@extends('layout.Admin')

@section('content')
<div class="container-fluid mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h4 class="fw-bold mb-1">Sambutan Direktur</h4>
            <small class="text-muted">
                Kelola informasi sambutan dan profil direktur AKKP Wakatobi
            </small>
        </div>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if($errors->any())
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

            <form action="{{ route('admin.about.update', $about->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    <!-- Left Column -->
                    <div class="col-md-8">

                        <!-- Nama -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Nama <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $about->name) }}">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <!-- Jabatan -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Jabatan / Title <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $about->title) }}">

                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Sambutan / Deskripsi
                            </label>

                            <textarea name="description"
                                      id="editor"
                                      class="form-control @error('description') is-invalid @enderror"
                                      rows="8">{{ old('description', $about->description) }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    <!-- Right Column -->
                    <div class="col-md-4">

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Foto Direktur
                            </label>

                            {{-- Preview Image --}}
                            <div class="mb-3">
                                <img id="previewImage"
                                     src="{{ $about->image ? asset('uploads/about/'.$about->image) : asset('img/no-image.png') }}"
                                     class="img-fluid rounded shadow-sm"
                                     style="object-fit:cover; max-height:300px; width:100%;">
                            </div>

                            <input type="file"
                                   name="image"
                                   class="form-control @error('image') is-invalid @enderror"
                                   accept="image/jpeg,image/png"
                                   onchange="previewImage(event)">

                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="text-muted">
                                Ukuran Minimal: <b>400 × 500 px</b> <br>
                                Format: JPG / PNG (Max 2MB)
                            </small>

                        </div>

                    </div>

                </div>


                <!-- Button -->
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        Update Data
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

CKEDITOR.replace('editor', {

    height: 400,

    toolbar: [

        { name: 'document', items: ['Source'] },

        { name: 'clipboard', items: ['Cut','Copy','Paste','PasteText','PasteFromWord','Undo','Redo'] },

        { name: 'basicstyles', items: ['Bold','Italic','Underline','Strike','Subscript','Superscript','RemoveFormat'] },

        { name: 'paragraph',
          items: [
            'NumberedList','BulletedList',
            'Outdent','Indent',
            'Blockquote',
            'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'
          ]
        },

        { name: 'insert', items: ['Link','Unlink','Table','HorizontalRule','SpecialChar'] },

        { name: 'styles', items: ['Styles','Format','Font','FontSize'] },

        { name: 'colors', items: ['TextColor','BGColor'] }

    ]

});

/* PREVIEW IMAGE */
function previewImage(event){

    const reader = new FileReader();

    reader.onload = function(){
        const output = document.getElementById('previewImage');
        output.src = reader.result;
    }

    reader.readAsDataURL(event.target.files[0]);
}


/* AUTO HIDE ALERT */
setTimeout(function(){

    let alert = document.querySelector('.alert-success');

    if(alert){
        alert.style.display = 'none';
    }

},4000);

</script>

@endpush
