@extends('layout.admin')

@section('content')
    <div class="container-fluid mt-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold">Edit Admin</h4>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
                Kembali
            </a>
        </div>

        {{-- Alert Error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Card Form --}}
        <div class="card shadow-sm">
            <div class="card-body">

                <form action="{{ route('admin.users.update', $admin->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- Nama --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" name="name" value="{{ old('name', $admin->name) }}"
                                class="form-control" required>
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" value="{{ old('email', $admin->email) }}"
                                class="form-control" required>
                        </div>

                        {{-- Password --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Password Baru</label>
                            <input type="password" name="password" class="form-control">
                            <small class="text-muted">
                                Kosongkan jika tidak ingin mengganti password
                            </small>
                        </div>

                    </div>

                    {{-- Button --}}
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
