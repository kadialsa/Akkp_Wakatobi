@extends('layout.Admin')

@section('content')
<div class="container-fluid mt-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Edit Slider</h4>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.slides.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" name="title" id="title" class="form-control"
                           value="{{ old('title', $slider->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $slider->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label><br>
                    @if($slider->image)
                        <img src="{{ asset('uploads/sliders/' . $slider->image) }}" width="200" class="mb-2 rounded">
                    @else
                        <p>Tidak ada gambar saat ini</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Ganti Gambar (opsional)</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="is_active" class="form-label">Status</label>
                    <select name="is_active" id="is_active" class="form-control">
                        <option value="1" {{ $slider->is_active ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ !$slider->is_active ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="position" class="form-label">Posisi</label>
                    <input type="number" name="position" id="position" class="form-control"
                           value="{{ old('position', $slider->position) }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

</div>
@endsection
