@extends('layout.admin')

@section('content')
    <div class="container-fluid mt-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="fw-bold mb-1">Manajemen Slider</h4>
                <small class="text-muted">
                    Kelola slider website AKKP Wakatobi
                </small>
            </div>
        </div>

        <!-- Flash Message -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <!-- Search -->
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <form method="GET" action="{{ route('admin.slides.index') }}" class="d-flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari slider..."
                            class="form-control">

                        <button type="submit" class="btn btn-outline-secondary">
                            Cari
                        </button>
                    </form>

                    <a href="{{ route('admin.slides.create') }}" class="btn btn-primary">
                        + Tambah Slider
                    </a>
                </div>



                <!-- Table -->
                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="60">No</th>
                                <th width="120">Gambar</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th width="110" class="text-center">Status</th>
                                <th width="160" class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($sliders as $slider)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <!-- Gambar -->
                                    <td>
                                        <img src="{{ asset('uploads/sliders/' . $slider->image) }}"
                                            alt="{{ $slider->title }}"
                                            style="width:90px;height:60px;object-fit:cover;border-radius:8px;"
                                            class="shadow-sm border">
                                    </td>

                                    <!-- Judul -->
                                    <td class="fw-semibold">
                                        {{ $slider->title }}
                                    </td>

                                    <!-- Deskripsi -->
                                    <td>
                                        <small class="text-muted">
                                            {{ \Illuminate\Support\Str::limit($slider->description, 70) }}
                                        </small>
                                    </td>

                                    <!-- Status -->
                                    <td class="text-center">
                                        @if ($slider->is_active)
                                            <span class="badge bg-success">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Aksi -->
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center flex-nowrap gap-2">

                                            <a href="{{ route('admin.slides.edit', $slider->id) }}"
                                                class="btn btn-sm btn-warning">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.slides.destroy', $slider->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus slider ini?')"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        Belum ada data slider
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $sliders->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>

    </div>
@endsection
