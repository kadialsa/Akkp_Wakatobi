@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-4">

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="fw-bold mb-1">Struktur Organisasi</h4>
                <small class="text-muted">
                    Kelola section dan anggota organisasi
                </small>
            </div>

            <a href="{{ route('admin.section.create') }}" class="btn btn-primary">
                + Tambah Section
            </a>
        </div>

        {{-- Section Loop --}}
        @forelse ($sections as $section)
            <div class="card border-0 shadow-sm mb-4">

                {{-- Card Header --}}
                <div
                    class="card-header bg-white py-3
           border-bottom
           d-flex justify-content-between align-items-center flex-wrap">

                    <h5 class="mb-0">
                        <strong>{{ $section->title }}</strong>
                    </h5>

                    <div class="d-flex align-items-center flex-wrap">

                        <a href="{{ route('admin.section.edit', $section->id) }}" class="btn btn-sm btn-warning mr-1 mb-2">
                            Edit
                        </a>

                        <form action="{{ route('admin.section.destroy', $section->id) }}" method="POST"
                            class="d-inline mr-1 mb-2" onsubmit="return confirm('Yakin ingin menghapus section ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Hapus
                            </button>
                        </form>

                        <a href="{{ route('admin.leader.create', $section->id) }}" class="btn btn-sm btn-success mb-2">
                            + Tambah Anggota
                        </a>

                    </div>
                </div>

                {{-- Card Body --}}
                <div class="card-body">

                    @if ($section->leaders->count())
                        <div class="row">

                            @foreach ($section->leaders as $leader)
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                                    <div class="card border-0 shadow-sm h-100 text-center">

                                        @if ($leader->photo)
                                            <img src="{{ asset('uploads/leaders/' . $leader->photo) }}" class="card-img-top"
                                                style="height:220px; object-fit:cover;">
                                        @endif

                                        <div class="card-body">

                                            <h6 style="font-weight:700;">
                                                {{ $leader->position }}
                                            </h6>

                                            <p class="mb-1">
                                                {{ $leader->name }}, @if ($leader->degree)
                                                    <small class="text-muted">
                                                        {{ $leader->degree }}
                                                    </small>
                                                @endif
                                            </p>

                                            <div class="mt-3 d-flex justify-content-center">

                                                <a href="{{ route('admin.leader.edit', $leader->id) }}"
                                                    class="btn btn-sm btn-warning mr-1">
                                                    Edit
                                                </a>

                                                <form action="{{ route('admin.leader.destroy', $leader->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        Hapus
                                                    </button>
                                                </form>

                                            </div>


                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            Belum ada anggota pada section ini.
                        </div>
                    @endif

                </div>

            </div>

        @empty
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center text-muted py-5">
                    Belum ada section yang dibuat.
                </div>
            </div>
        @endforelse

    </div>
@endsection
