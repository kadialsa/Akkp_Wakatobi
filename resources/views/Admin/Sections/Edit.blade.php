@extends('layout.Admin')

@section('content')
<div class="container mt-4">
    <h4>Edit Section</h4>

    <form action="{{ route('admin.section.update', $section->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Section</label>
            <input type="text"
                   name="title"
                   value="{{ $section->title }}"
                   class="form-control"
                   required>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
