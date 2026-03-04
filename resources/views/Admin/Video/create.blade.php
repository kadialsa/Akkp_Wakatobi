@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-4">

        <div class="card shadow">

            <div class="card-header">

                Tambah Video

            </div>

            <div class="card-body">

                <form action="{{ route('admin.video.store') }}" method="POST">

                    @csrf

                    <div class="mb-3">

                        <label>Judul Video</label>

                        <input type="text" name="title" class="form-control" required>

                    </div>


                    <div class="mb-3">

                        <label>Link Youtube</label>

                        <input type="text" name="youtube_link" class="form-control"
                            placeholder="https://www.youtube.com/watch?v=xxxxx" required>

                    </div>


                    <div class="mb-3">

                        <label>Status</label>

                        <select name="is_active" class="form-control">

                            <option value="1">
                                Aktif
                            </option>

                            <option value="0">
                                Nonaktif
                            </option>

                        </select>

                    </div>


                    <button class="btn btn-primary">

                        Simpan

                    </button>


                    <a href="{{ route('admin.video.index') }}" class="btn btn-secondary">

                        Kembali

                    </a>

                </form>

            </div>

        </div>

    </div>
@endsection
