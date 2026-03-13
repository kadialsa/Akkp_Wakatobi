@extends('layout.admin')

@section('content')
<div class="container-fluid mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h4 class="fw-bold mb-1">Manajemen Kerja Sama</h4>
            <small class="text-muted">
                Kelola logo kerja sama website
            </small>
        </div>

        <a href="{{ route('admin.cooperation.create') }}" class="btn btn-primary">
            + Tambah Logo
        </a>
    </div>

    <!-- Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle table-hover table-bordered text-center">

                    <thead class="table-light">
                        <tr>
                            <th width="100">Logo</th>
                            <th width="120">Urutan</th>
                            <th width="120">Status</th>
                            <th width="170" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($items as $item)
                        <tr>

                            <!-- Logo -->
                            <td>
                                @if($item->image)
                                    <img src="{{ asset('uploads/cooperation/'.$item->image) }}"
                                         style="width:80px;height:55px;object-fit:contain;border-radius:8px;">
                                @else
                                    <div class="text-muted small">
                                        No Image
                                    </div>
                                @endif
                            </td>

                            <!-- Urutan -->
                            <td>
                                <span class="fw-semibold">
                                    {{ $item->position }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td>
                                @if($item->is_active)
                                    <span class="badge bg-success">
                                        Aktif
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="text-center justify-content-center">
                                    <a href="{{ route('admin.cooperation.edit',$item->id) }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.cooperation.destroy',$item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                                            Hapus
                                        </button>
                                    </form>
                            </td>

                        </tr>


                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Belum ada data kerja sama
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
