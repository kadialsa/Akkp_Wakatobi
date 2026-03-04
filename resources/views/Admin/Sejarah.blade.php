@extends('layout.admin')

@section('content')
    <div class="container-fluid mt-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="fw-bold mb-1">
                    Update Sejarah AKKP Wakatobi
                </h4>
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

                <form action="{{ route('admin.sejarah.update', $sejarah->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')


                    <!-- Sejarah -->
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Sejarah Singkat
                        </label>

                        <textarea name="sejarah" rows="6" class="form-control @error('sejarah') is-invalid @enderror"
                            placeholder="Masukkan sejarah singkat...">{{ old('sejarah', $sejarah->sejarah) }}</textarea>

                        @error('sejarah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>



                    <!-- Upload Foto -->
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Upload Foto Baru
                        </label>

                        <input type="file" name="foto" id="fotoInput"
                            class="form-control @error('foto') is-invalid @enderror">

                        @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>



                    <!-- Foto Lama -->
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Foto Saat Ini
                        </label>

                        <div>

                            @if ($sejarah->foto)
                                <img id="previewFoto" src="{{ asset('uploads/sejarah/' . $sejarah->foto) }}"
                                    style="width:250px;height:160px;object-fit:cover;border-radius:10px;"
                                    class="shadow-sm border">
                            @else
                                <div class="text-muted">
                                    Belum ada gambar
                                </div>
                            @endif

                        </div>

                    </div>



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



@push('scripts')
    <script>
        document.getElementById('fotoInput')
            .addEventListener('change', function(e) {

                const file = e.target.files[0];

                if (file) {

                    document.getElementById('previewFoto').src =
                        URL.createObjectURL(file);

                }

            });
    </script>
@endpush
