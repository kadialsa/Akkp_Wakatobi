@extends('layout.Admin')

@section('content')
<div class="container-fluid mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h4 class="fw-bold mb-1">Edit Pimpinan</h4>
            <small class="text-muted">
                Perbarui data pimpinan AKKP Wakatobi
            </small>
        </div>
    </div>

    <!-- Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ERROR GLOBAL --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi Kesalahan!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.leader.update', $leader->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- Kolom Kiri -->
                    <div class="col-lg-8">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jabatan</label>
                            <input type="text"
                                   name="position"
                                   value="{{ old('position', $leader->position) }}"
                                   class="form-control @error('position') is-invalid @enderror">

                            @error('position')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $leader->name) }}"
                                   class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Gelar</label>
                            <input type="text"
                                   name="degree"
                                   value="{{ old('degree', $leader->degree) }}"
                                   class="form-control @error('degree') is-invalid @enderror">

                            @error('degree')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-lg-4">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Foto</label>

                            <input type="file"
                                   name="photo"
                                   id="photoInput"
                                   class="form-control @error('photo') is-invalid @enderror">

                            <small class="text-muted d-block mt-1">
                                Format: JPG / PNG <br>
                                Maksimal: 2MB <br>
                                Rekomendasi: <strong>840 x 1040 px (rasio 4:5)</strong>
                            </small>

                            @error('photo')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        @if($leader->photo)
                            <div class="mt-3">
                                <img id="previewImage"
                                     src="{{ asset('uploads/leaders/'.$leader->photo) }}"
                                     class="img-fluid rounded shadow-sm"
                                     style="max-height:320px; object-fit:cover;">
                            </div>
                        @else
                            <img id="previewImage"
                                 class="img-fluid rounded shadow-sm d-none"
                                 style="max-height:320px; object-fit:cover;">
                        @endif

                    </div>

                </div>

                <div class="text-end mt-4">
                    <button class="btn btn-primary px-4">
                        Update Data
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection


@push('scripts')
<script>
document.getElementById('photoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    const img = new Image();
    const reader = new FileReader();

    reader.onload = function(event) {
        img.src = event.target.result;
        img.onload = function() {
            const ratio = img.width / img.height;

            if (Math.abs(ratio - (4/5)) > 0.01) {
                alert("⚠ Rasio gambar harus 4:5 (contoh 840x1040)");
                e.target.value = "";
                return;
            }

            const preview = document.getElementById('previewImage');
            preview.src = event.target.result;
            preview.classList.remove('d-none');
        };
    };

    reader.readAsDataURL(file);
});
</script>
@endpush
