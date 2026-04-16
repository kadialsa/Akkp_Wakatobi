@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Manajemen Program Studi</h3>
            <a href="{{ route('admin.prodi.create') }}" class="btn btn-primary">
                + Tambah Prodi
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
                    <table class="table table-bordered table-striped text-center">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th>Thumbnail</th>
                                <th>Nama Prodi</th>
                                <th>Slug</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($prodis as $key => $prodi)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    {{-- Thumbnail --}}
                                    <td>
                                        @if ($prodi->thumbnail)
                                            <img src="{{ asset('uploads/prodi/thumbnail/' . $prodi->thumbnail) }}"
                                                style="width:80px;height:60px;object-fit:cover;border-radius:6px;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>

                                    <td>{{ $prodi->name }}</td>
                                    <td>{{ $prodi->slug }}</td>
                                    <td>
                                        <a href="{{ route('admin.prodi.edit', $prodi->id) }}"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.prodi.destroy', $prodi->id) }}" method="POST"
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
                                    <td colspan="4" class="text-center text-muted">
                                        Belum ada data prodi
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
