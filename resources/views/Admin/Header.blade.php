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

                        <input type="file" name="image" class="form-control">

                        <small class="text-muted">
                            Ukuran disarankan: 1920 × 450 px
                        </small>

                    </div>

                    <!-- Preview -->
                    @if ($header && $header->image)
                        <div class="mb-4">

                            {{-- <label class="form-label fw-semibold">
                                Header Saat Ini
                            </label> --}}

                            <div >

                                <img src="{{ asset('uploads/header/' . $header->image) }}"
                                    style="
                                width:100%;
                                max-width:700px;
                                height:200px;
                                object-fit:cover;
                                border-radius:10px;
                             "
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
