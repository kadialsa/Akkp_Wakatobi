@extends('layout.Admin')

@section('content')
<div class="container-fluid py-4">

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-md-5">

            <h4 class="fw-bold mb-4">
                {{ isset($cooperation) ? 'Edit Kerja Sama' : 'Tambah Kerja Sama' }}
            </h4>

            <form method="POST"
                  enctype="multipart/form-data"
                  action="{{ isset($cooperation)
                    ? route('admin.cooperation.update',$cooperation->id)
                    : route('admin.cooperation.store') }}">

                @csrf
                @isset($cooperation)
                    @method('PUT')
                @endisset

                <!-- Logo -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Logo Kerja Sama
                    </label>

                    @isset($cooperation)
                        <div class="mb-3">
                            <img src="{{ asset('uploads/cooperation/'.$cooperation->image) }}"
                                 class="img-fluid rounded border p-2 bg-light"
                                 style="max-height:100px;">
                        </div>
                    @endisset

                    <input type="file"
                           name="image"
                           class="form-control"
                           {{ isset($cooperation) ? '' : 'required' }}>

                    <small class="text-muted">
                        Rekomendasi ukuran: 400 × 200 px
                    </small>
                </div>

                <!-- Position -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Urutan
                    </label>
                    <input type="number"
                           name="position"
                           class="form-control"
                           value="{{ $cooperation->position ?? 0 }}">
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Status
                    </label>
                    <select name="is_active" class="form-select">
                        <option value="1"
                            {{ isset($cooperation) && $cooperation->is_active == 1 ? 'selected' : '' }}>
                            Aktif
                        </option>
                        <option value="0"
                            {{ isset($cooperation) && $cooperation->is_active == 0 ? 'selected' : '' }}>
                            Nonaktif
                        </option>
                    </select>
                </div>

                <!-- Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4 rounded-3">
                        {{ isset($cooperation) ? 'Update' : 'Simpan' }}
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
