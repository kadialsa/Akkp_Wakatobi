@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-4">

        <div class="card shadow">

            <div class="card-header">

                Edit Video

            </div>

            <div class="card-body">

                <form action="{{ route('admin.video.update', $video->id) }}" method="POST">

                    @csrf

                    <div class="mb-3">

                        <label>Judul Video</label>

                        <input type="text" name="title" class="form-control" value="{{ $video->title }}" required>

                    </div>


                    <div class="mb-3">

                        <label>Link Youtube</label>

                        <input type="text" name="youtube_link" class="form-control" value="{{ $video->youtube_link }}"
                            required>

                    </div>


                    <div class="mb-3">

                        <label>Status</label>

                        <select name="is_active" class="form-control">

                            <option value="1" {{ $video->is_active == 1 ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="0" {{ $video->is_active == 0 ? 'selected' : '' }}>
                                Nonaktif
                            </option>

                        </select>

                    </div>


                    <button class="btn btn-primary">

                        Update

                    </button>


                    <a href="{{ route('admin.video.index') }}" class="btn btn-secondary">

                        Kembali

                    </a>

                </form>

            </div>

        </div>

    </div>
@endsection
