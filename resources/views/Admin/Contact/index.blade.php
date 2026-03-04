@extends('layout.admin')

@section('content')
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Pesan Kontak Masuk</h4>
    </div>

    {{-- Alert --}}
    @if(session('success'))
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
                        <th width="60">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Subjek</th>
                        <th width="150">Tanggal</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($messages as $index => $item)
                    <tr>
                        <td class="text-center">
                            {{ $messages->firstItem() + $index }}
                        </td>

                        <td>{{ $item->name }}</td>

                        <td>{{ $item->email }}</td>

                        <td>
                            {{ $item->subject ?? '-' }}
                        </td>

                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                        </td>

                        <td class="text-center">

                            <div class="d-flex justify-content-center gap-2">

                                {{-- Detail --}}
                                <a href="{{ route('admin.contact.show',$item->id) }}"
                                   class="btn btn-sm btn-info">
                                    View
                                </a>

                                {{-- Hapus --}}
                                <form action="{{ route('admin.contact.delete',$item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus pesan ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>

                                </form>

                            </div>

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
    <div class="mt-3 d-flex justify-content-center">
        {{ $messages->links() }}
    </div>

</div>
@endsection
