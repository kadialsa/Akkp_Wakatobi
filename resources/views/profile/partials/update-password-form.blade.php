<section>

    <div class="mb-4">
        <h5 class="fw-bold text-info">
            Update Password
        </h5>
        <p class="text-muted mb-0">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </div>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Current Password</label>
            <div class="input-group">
                <input type="password"
                       id="current_password"
                       name="current_password"
                       class="form-control"
                       autocomplete="current-password">

                <button class="btn btn-outline-secondary toggle-password"
                        type="button"
                        data-target="current_password">
                    <i class="fas fa-eye"></i>
                </button>
            </div>

            @if ($errors->updatePassword->get('current_password'))
                <small class="text-danger">
                    {{ $errors->updatePassword->first('current_password') }}
                </small>
            @endif
        </div>

        {{-- New Password --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">New Password</label>
            <div class="input-group">
                <input type="password"
                       id="password"
                       name="password"
                       class="form-control"
                       autocomplete="new-password">

                <button class="btn btn-outline-secondary toggle-password"
                        type="button"
                        data-target="password">
                    <i class="fas fa-eye"></i>
                </button>
            </div>

            @if ($errors->updatePassword->get('password'))
                <small class="text-danger">
                    {{ $errors->updatePassword->first('password') }}
                </small>
            @endif
        </div>

        {{-- Confirm Password --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Confirm Password</label>
            <div class="input-group">
                <input type="password"
                       id="password_confirmation"
                       name="password_confirmation"
                       class="form-control"
                       autocomplete="new-password">

                <button class="btn btn-outline-secondary toggle-password"
                        type="button"
                        data-target="password_confirmation">
                    <i class="fas fa-eye"></i>
                </button>
            </div>

            @if ($errors->updatePassword->get('password_confirmation'))
                <small class="text-danger">
                    {{ $errors->updatePassword->first('password_confirmation') }}
                </small>
            @endif
        </div>

        {{-- Button --}}
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-info text-white">
                <i class="fas fa-key me-1"></i> Update Password
            </button>

            @if (session('status') === 'password-updated')
                <div class="alert alert-success py-1 px-3 mb-0">
                    Password berhasil diperbarui.
                </div>
            @endif
        </div>

    </form>

</section>
