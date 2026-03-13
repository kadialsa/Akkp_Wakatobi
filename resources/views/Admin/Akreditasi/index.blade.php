@extends('layout.admin')

@section('content')
    <div class="container-fluid mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Manajemen Akreditasi</h3>
            <a href="{{ route('admin.akreditasi.create') }}" class="btn btn-primary">
                + Tambah Akreditasi
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th>Gambar</th>
                                <th>Title</th>
                                <th>Badge</th>
                                <th>File</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($akreditas as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>

                                    {{-- Gambar --}}
                                    <td>
                                        @if ($item->image)
                                            <img src="{{ asset($item->image) }}"
                                                style="width:80px;height:60px;object-fit:cover;border-radius:6px;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>

                                    <td>{{ $item->title }}</td>

                                    {{-- Badge --}}
                                    <td>
                                        @if ($item->badge)
                                            <span class="badge bg-{{ $item->badge_color }}">
                                                {{ $item->badge }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    {{-- File --}}
                                    <td class="text-center">
                                        @if ($item->file)
                                            <a href="{{ asset($item->file) }}" target="_blank"
                                                class="text-decoration-none text-primary">
                                                <i class="bi bi-file-earmark-pdf" style="font-size: 35px;"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td>
                                        <a href="{{ route('admin.akreditasi.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.akreditasi.destroy', $item->id) }}" method="POST"
                                            style="display:inline;">
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
                                    <td colspan="6" class="text-center text-muted">
                                        Belum ada data akreditasi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- pagination --}}
                <div class="mt-4 d-flex justify-content-center">
                       {{ $akreditas->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

    </div>
@endsection
