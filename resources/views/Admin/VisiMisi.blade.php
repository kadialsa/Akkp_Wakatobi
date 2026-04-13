@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="fw-bold mb-1">Manajemen Visi & Misi</h4>
                <small class="text-muted">
                    Perbarui visi dan misi AKKP Wakatobi
                </small>
            </div>

        </div>

        <!-- Alert -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <form action="{{ route('admin.visimisi.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Visi -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Visi</label>
                        <textarea name="visi" class="form-control @error('visi') is-invalid @enderror" rows="3"
                            placeholder="Masukkan visi...">{{ old('visi', $visimisi->visi) }}</textarea>

                        @error('visi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Misi -->
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Misi
                        </label>

                        <div id="misiWrapper">

                            @php
                                $misiList = old('misi', $visimisi->misi ?? []);
                                if (!is_array($misiList)) {
                                    $misiList = explode("\n", $misiList);
                                }
                            @endphp

                            @foreach ($misiList as $index => $misi)
                                <div class="input-group mb-2">

                                    <span class="input-group-text">
                                        {{ $index + 1 }}
                                    </span>

                                    <input type="text" name="misi[]" value="{{ $misi }}" class="form-control"
                                        placeholder="Masukkan misi">

                                    <button type="button" class="btn btn-danger" onclick="hapusMisi(this)">
                                        Hapus
                                    </button>

                                </div>
                            @endforeach

                        </div>


                        <button type="button" class="btn btn-primary btn-sm mt-2" onclick="tambahMisi()">

                            + Tambah Misi

                        </button>

                    </div>

                    <!-- Button -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        function tambahMisi() {
            let wrapper = document.getElementById('misiWrapper');
            let jumlah = wrapper.children.length + 1;

            let html = `
    <div class="input-group mb-2">

        <span class="input-group-text">
            ${jumlah}
        </span>

        <input type="text"
               name="misi[]"
               class="form-control"
               placeholder="Masukkan misi">

        <button type="button"
                class="btn btn-danger"
                onclick="hapusMisi(this)">
            Hapus
        </button>

    </div>
    `;

            wrapper.insertAdjacentHTML('beforeend', html);
        }



        function hapusMisi(btn) {
            btn.parentElement.remove();
            updateNomor();
        }



        function updateNomor() {
            let items = document.querySelectorAll('#misiWrapper .input-group-text');

            items.forEach((item, index) => {
                item.innerText = index + 1;
            });
        }
    </script>
@endpush
