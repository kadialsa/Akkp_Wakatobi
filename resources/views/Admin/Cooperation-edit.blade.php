@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

            <div>
                <h4 class="fw-bold mb-1">
                    Edit Kerjasama
                </h4>

                <small class="text-muted">
                    Update data kerjasama website AKKP Wakatobi
                </small>
            </div>

            <a href="{{ route('admin.cooperation.index') }}" class="btn btn-secondary">

                ← Kembali

            </a>

        </div>


        <!-- Card -->
        <div class="card border-0 shadow-sm">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-body">

                <form action="{{ route('admin.cooperation.update', $cooperation->id) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')


                    <div class="row">

                        <!-- Gambar -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                Gambar Kerjasama
                            </label>

                            <input type="file" name="image" class="form-control">

                            <small class="text-muted">
                                Ukuran disarankan 400 × 200 px
                            </small>

                            @error('image')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror


                            <div class="mt-3">

                                <img id="preview" src="{{ asset('uploads/cooperation/' . $cooperation->image) }}"
                                    style="width:250px;border-radius:8px;">

                            </div>

                        </div>



                        <!-- Urutan -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                Urutan
                            </label>

                            <input type="number" name="position" class="form-control"
                                value="{{ old('position', $cooperation->position) }}">

                            <small class="text-muted">
                                Angka kecil tampil lebih dulu
                            </small>

                        </div>



                        <!-- Status -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                Status
                            </label>

                            <select name="is_active" class="form-select">

                                <option value="1"
                                    {{ old('is_active', $cooperation->is_active) == 1 ? 'selected' : '' }}>
                                    Aktif
                                </option>

                                <option value="0"
                                    {{ old('is_active', $cooperation->is_active) == 0 ? 'selected' : '' }}>
                                    Nonaktif
                                </option>

                            </select>

                        </div>


                    </div>



                    <!-- Button -->
                    <div class="mt-3">

                        <button class="btn btn-primary px-4">

                            Update Kerjasama

                        </button>

                    </div>


                </form>

            </div>

        </div>

    </div>
@endsection



@push('scripts')
    <script>
        document.querySelector('input[name=image]')
            .addEventListener('change', function(e) {

                const file = e.target.files[0];

                if (file) {

                    document.getElementById('preview').src = URL.createObjectURL(file);

                }

            });
    </script>
@endpush
