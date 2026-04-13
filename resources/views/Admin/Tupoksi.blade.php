@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="fw-bold mb-1">Manajemen Tugas Pokok & Fungsi</h4>
                <small class="text-muted">
                    Perbarui informasi tugas pokok dan fungsi AKKP Wakatobi
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

                <form action="{{ route('admin.tupoksi.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Tugas Pokok -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Tugas Pokok</label>
                        <textarea name="tugas_pokok" class="form-control @error('tugas_pokok') is-invalid @enderror" rows="4"
                            placeholder="Masukkan tugas pokok...">{{ old('tugas_pokok', $tupoksi->tugas_pokok) }}</textarea>

                        @error('tugas_pokok')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Fungsi</label>

                        <div id="fungsiWrapper">
                            @php
                                $fungsiList = old('fungsi', $tupoksi->fungsi ?? []);
                                if (!is_array($fungsiList)) {
                                    $fungsiList = explode("\n", $fungsiList);
                                }
                            @endphp

                            @foreach ($fungsiList as $index => $fungsi)
                                <div class="input-group mb-2">
                                    <span class="input-group-text">{{ $index + 1 }}</span>
                                    <input type="text" name="fungsi[]" value="{{ $fungsi }}" class="form-control"
                                        placeholder="Masukkan fungsi">

                                    <button type="button" class="btn btn-danger" onclick="hapusFungsi(this)">
                                        Hapus
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-primary btn-sm mt-2" onclick="tambahFungsi()">
                            + Tambah Fungsi
                        </button>

                        <small class="text-muted d-block mt-1">
                            Gunakan tombol tambah untuk menambah poin baru
                        </small>

                        @error('fungsi')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
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
        function tambahFungsi() {
            const wrapper = document.getElementById('fungsiWrapper');
            const index = wrapper.children.length + 1;

            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');

            div.innerHTML = `
            <span class="input-group-text">${index}</span>
            <input type="text" name="fungsi[]" class="form-control" placeholder="Masukkan fungsi">
            <button type="button" class="btn btn-danger" onclick="hapusFungsi(this)">Hapus</button>
        `;

            wrapper.appendChild(div);
        }

        function hapusFungsi(button) {
            const wrapper = document.getElementById('fungsiWrapper');
            button.parentElement.remove();

            // Reindex angka di depan input
            Array.from(wrapper.children).forEach((div, i) => {
                div.querySelector('.input-group-text').textContent = i + 1;
            });
        }
    </script>
@endpush
