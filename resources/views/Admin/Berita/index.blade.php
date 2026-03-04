    @extends('layout.admin')

    @section('content')
        <div class="container-fluid mt-4">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <div>
                    <h4 class="fw-bold mb-1">Manajemen Berita</h4>
                    <small class="text-muted">
                        Kelola semua berita website AKKP Wakatobi
                    </small>
                </div>

                <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
                    + Tambah Berita
                </a>
            </div>

            <!-- Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table align-middle table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="90">Gambar</th>
                                    <th>Judul</th>
                                    <th width="130">Kategori</th>
                                    <th width="140">Tanggal</th>
                                    <th width="110">Status</th>
                                    <th width="170" class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($beritas as $item)
                                    <tr>

                                        <!-- Gambar -->
                                        <td>
                                            @if ($item->image)
                                                <img src="{{ asset($item->image) }}"
                                                    style="width:80px;height:55px;object-fit:cover;border-radius:8px;">
                                            @else
                                                <div class="text-muted small">
                                                    No Image
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Judul -->
                                        <td>
                                            <div class="fw-semibold mb-1">
                                                {{ $item->title }}
                                            </div>
                                            <small class="text-muted">
                                                {{ \Illuminate\Support\Str::limit($item->excerpt, 70) }}
                                            </small>
                                        </td>

                                        <!-- Kategori -->
                                        <td>
                                            <span class="badge bg-info text-dark">
                                                {{ $item->category ?? 'Umum' }}
                                            </span>
                                        </td>

                                        <!-- Tanggal -->
                                        <td>
                                            {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d M Y') : '-' }}
                                        </td>

                                        <!-- Status -->
                                        <td>
                                            @if ($item->status == 'publish')
                                                <span class="badge bg-success">
                                                    Publish
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    Draft
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Aksi -->
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center flex-nowrap">

                                                <!-- View -->
                                                <a href="{{ route('admin.berita.show', $item->id) }}"
                                                    class="btn btn-sm btn-info me-2">
                                                    View
                                                </a>

                                                <!-- Edit -->
                                                <a href="{{ route('admin.berita.edit', $item->id) }}"
                                                    class="btn btn-sm btn-warning me-2">
                                                    Edit
                                                </a>

                                                <!-- Hapus -->
                                                <form action="{{ route('admin.berita.delete', $item->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus berita ini?')">
                                                        Hapus
                                                    </button>
                                                </form>

                                            </div>
                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            Belum ada data berita
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
