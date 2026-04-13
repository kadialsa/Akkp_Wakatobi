@extends('layout.Admin')

@section('content')
<div class="container-fluid mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h4 class="fw-bold mb-1">Tambah Section</h4>
            <small class="text-muted">
                Tambahkan section baru untuk struktur organisasi
            </small>
        </div>
    </div>

    <!-- Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            {{-- Alert Global --}}
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

            <form action="{{ route('admin.section.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Nama Section
                    </label>
                    <input type="text"
                           name="title"
                           value="{{ old('title') }}"
                           class="form-control @error('title') is-invalid @enderror"
                           required>

                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        Simpan Data
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
