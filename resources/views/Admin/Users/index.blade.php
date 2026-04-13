@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="fw-bold mb-1">Manajemen Admin</h4>
                <small class="text-muted">
                    Kelola semua akun administrator website
                </small>
            </div>

            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                + Tambah Admin
            </a>
        </div>

        <!-- Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="60">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th width="180" class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($admins as $key => $admin)
                                <tr>

                                    <!-- No -->
                                    <td>{{ $key + 1 }}</td>

                                    <!-- Nama -->
                                    <td class="fw-semibold">
                                        {{ $admin->name }}
                                    </td>

                                    <!-- Email -->
                                    <td>
                                        <span class="text-muted">
                                            {{ $admin->email }}
                                        </span>
                                    </td>

                                    <!-- Aksi -->
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center flex-nowrap">

                                            <!-- View -->
                                            <a href="{{ route('admin.users.show', $admin->id) }}"
                                                class="btn btn-sm btn-info me-2">
                                                View
                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('admin.users.edit', $admin->id) }}"
                                                class="btn btn-sm btn-warning me-2">
                                                Edit
                                            </a>

                                            <!-- Hapus -->
                                            <form action="{{ route('admin.users.delete', $admin->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus admin ini?')">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        Belum ada data admin
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection
