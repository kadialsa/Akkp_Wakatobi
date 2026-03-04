@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-4">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3>Manajemen Video</h3>

            <a href="{{ route('admin.video.create') }}" class="btn btn-primary">

                Tambah Video

            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <thead class="bg-light">

                            <tr>

                                <th width="50">No</th>

                                <th width="250">Preview</th>

                                <th>Judul</th>

                                <th width="120">Status</th>

                                <th width="180">Tanggal</th>

                                <th width="150">Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($videos as $key => $video)
                                @php
                                    $link = str_replace('watch?v=', 'embed/', $video->youtube_link);
                                @endphp

                                <tr>

                                    <td>
                                        {{ $key + 1 }}
                                    </td>

                                    <td>

                                        <div class="ratio ratio-16x9">

                                            <iframe src="{{ $link }}" frameborder="0" allowfullscreen>
                                            </iframe>

                                        </div>

                                    </td>

                                    <td>

                                        {{ $video->title }}

                                    </td>

                                    <td>

                                        @if ($video->is_active)
                                            <span class="badge badge-success">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                Nonaktif
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        {{ $video->created_at->format('d M Y') }}

                                    </td>

                                    <td>

                                        <a href="{{ route('admin.video.edit', $video->id) }}" class="btn btn-warning btn-sm">

                                            Edit

                                        </a>


                                        <form action="{{ route('admin.video.delete', $video->id) }}" method="POST"
                                            style="display:inline">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm">

                                                Hapus

                                            </button>

                                        </form>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
@endsection
