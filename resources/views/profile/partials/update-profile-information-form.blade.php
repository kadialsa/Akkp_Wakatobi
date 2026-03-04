<section>

    <div class="mb-4">
        <h5 class="fw-bold text-primary">
            Profile Information
        </h5>
        <p class="text-muted mb-0">
            Update your account's profile information and email address.
        </p>
    </div>

    {{-- Form Kirim Ulang Verifikasi --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Form Update Profile --}}
    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        {{-- Nama --}}
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Name</label>
            <input type="text"
                   id="name"
                   name="name"
                   class="form-control"
                   value="{{ old('name', $user->name) }}"
                   required
                   autofocus>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email"
                   id="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email', $user->email) }}"
                   required>

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            {{-- Jika Email Belum Terverifikasi --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <div class="alert alert-warning py-2">
                        Email address belum diverifikasi.
                        <button form="send-verification"
                                class="btn btn-link p-0 ms-2 align-baseline">
                            Kirim ulang verifikasi
                        </button>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success py-2">
                            Link verifikasi baru sudah dikirim ke email Anda.
                        </div>
                    @endif
                </div>
            @endif
        </div>

        {{-- Tombol --}}
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Save Changes
            </button>

            @if (session('status') === 'profile-updated')
                <div class="alert alert-success py-1 px-3 mb-0">
                    Saved successfully.
                </div>
            @endif
        </div>

    </form>

</section>
