@extends('layout.Admin')

@section('content')
    <div class="container-fluid">

        <h4 class="mt-4 mb-3">Detail Admin</h4>

        <div class="card p-4">

            <p>
                <b>Nama :</b>
                {{ $admin->name }}
            </p>

            <p>
                <b>Email :</b>
                {{ $admin->email }}
            </p>

            <b>Role :</b>
            {{ $admin->role }}
            </p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </div>

    </div>
@endsection
