@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold">Detail Pesan</h4>
        </div>

        <div class="card shadow-sm">

            <div class="card-body">

                <div class="mb-3">
                    <strong>Nama :</strong>
                    <p>{{ $message->name }}</p>
                </div>

                <div class="mb-3">
                    <strong>Email :</strong>
                    <p>{{ $message->email }}</p>
                </div>

                <div class="mb-3">
                    <strong>Subject :</strong>
                    <p>{{ $message->subject ?? '-' }}</p>
                </div>

                <div class="mb-3">
                    <strong>Pesan :</strong>
                    <div class="border rounded p-3 bg-light">
                        {{ $message->message }}
                    </div>
                </div>

                <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </div>
        </div>

    </div>
@endsection
