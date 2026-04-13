@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold">Pesan Kontak Masuk</h4>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tabel --}}
        <div class="card shadow-sm">
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light text-center">
                        <tr>
                            <th style="width:60px;">NO</th>
                            <th style="width:190px;">NAMA</th>
                            <th style="width:200px;">EMAIL</th>
                            <th style="width:300px;">SUBJEK</th>
                            <th style="width:150px;">TANGGAL</th>
                            <th style="width:120px;" class="text-center">AKSI</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($messages as $index => $item)
                            <tr class="{{ !$item->is_read ? 'table-secondary' : '' }}">

                                <td class="text-center">
                                    {{ $messages->firstItem() + $index }}
                                </td>

                                <td>
                                    {{ $item->name }}
                                </td>

                                <td>
                                    {{ $item->email }}
                                </td>

                                <td>
                                    {{ $item->subject ?? '-' }}
                                </td>

                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                </td>

                                <td class="text-center" style="white-space: nowrap; width:120px;">

                                    <a href="{{ route('admin.contact.show', $item->id) }}"
                                        class="btn btn-info btn-sm px-2 py-1" style="margin-right:4px;">
                                        View
                                    </a>

                                    <form action="{{ route('admin.contact.delete', $item->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm px-2 py-1"
                                            onclick="return confirm('Yakin hapus?')">
                                            Hapus
                                        </button>
                                    </form>

                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Belum ada pesan masuk
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-4 d-flex justify-content-center">
            {{ $messages->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
