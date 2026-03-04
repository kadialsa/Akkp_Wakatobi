@extends('layout.admin')

@section('content')
    <div class="container-fluid mt-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="fw-bold mb-1">Header Website</h4>
                <small class="text-muted">
                    Gambar header digunakan untuk semua halaman website
                </small>
            </div>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <form action="{{ route('admin.header.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <!-- Upload -->
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Upload Gambar Header
                        </label>

                        <input type="file" name="image" accept=".jpg,.jpeg,.png"
                            class="form-control @error('image') is-invalid @enderror" onchange="validateFile(this)">

                        <small class="text-muted">
                            Ukuran disarankan: 800 × 300px | Format: JPG/PNG | Maksimal 2MB
                        </small>

                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <!-- Preview -->
                    @if ($header && $header->image)
                        <div class="mb-4">
                            <div>
                                <img src="{{ asset('uploads/header/' . $header->image) }}"
                                    style="
                                width:100%;
                                max-width:700px;
                                height:200px;
                                object-fit:cover;
                                border-radius:10px;"
                                class="shadow-sm border">
                            </div>
                        </div>
                    @endif


                    <!-- Button -->
                    <div class="d-flex justify-content-end">

                        <button type="submit" class="btn btn-primary px-4">

                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection

<script>
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
