@extends('layout.admin')

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
                                   class="form-control"
                                   value="{{ old('name', $about->name) }}"
                                   required>
                        </div>

                        <!-- Jabatan -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Jabatan / Title <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   value="{{ old('title', $about->title) }}"
                                   required>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Sambutan / Deskripsi
                            </label>
                            <textarea name="description"
                                      id="editor"
                                      class="form-control"
                                      rows="8">{{ old('description', $about->description) }}</textarea>
                        </div>

                    </div>

                    <!-- Right Column -->
                    <div class="col-md-4">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Foto Direktur
                            </label>

                            @if ($about->image)
                                <div class="mb-3">
                                    <img src="{{ asset('uploads/about/'.$about->image) }}"
                                         class="img-fluid rounded shadow-sm"
                                         style="object-fit:cover; max-height:300px; width:100%;">
                                </div>
                            @endif

                            <input type="file"
                                   name="image"
                                   class="form-control"
                                   accept="image/jpeg,image/png">

                            <small class="text-muted">
                                Ukuran disarankan: 840 x 1040 px (rasio 4:5)
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
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

<script>
ClassicEditor
    .create(document.querySelector('#editor'), {
        toolbar: [
            'heading',
            '|',
            'bold', 'italic', 'underline', 'strikethrough',
            '|',
            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor',
            '|',
            'alignment',
            '|',
            'bulletedList', 'numberedList',
            '|',
            'outdent', 'indent',
            '|',
            'link', 'blockQuote', 'insertTable',
            '|',
            'undo', 'redo'
        ],
        table: {
            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
        }
    })
    .catch(error => console.error(error));
</script>
@endpush
