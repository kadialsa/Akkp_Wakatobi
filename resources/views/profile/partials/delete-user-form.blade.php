<section>

    <div class="mb-4">
        <h5 class="fw-bold text-danger">
            Delete Account
        </h5>
        <p class="text-muted mb-0">
            Once your account is deleted, all of its resources and data will be permanently deleted.
            Please download any data you wish to retain before proceeding.
        </p>
    </div>

    {{-- Tombol Buka Modal --}}
    <button class="btn btn-danger"
            data-bs-toggle="modal"
            data-bs-target="#deleteAccountModal">
        <i class="fas fa-trash me-1"></i> Delete Account
    </button>

    {{-- Modal --}}
    <div class="modal fade" id="deleteAccountModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        Confirm Account Deletion
                    </h5>
                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                </div>

                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-body">

                        <p class="text-muted">
                            Are you sure you want to permanently delete your account?
                            This action cannot be undone.
                        </p>

                        <div class="mb-3">
                            <label for="delete_password" class="form-label fw-semibold">
                                Enter Password to Confirm
                            </label>
                            <input type="password"
                                   id="delete_password"
                                   name="password"
                                   class="form-control"
                                   required>

                            @if ($errors->userDeletion->get('password'))
                                <small class="text-danger">
                                    {{ $errors->userDeletion->first('password') }}
                                </small>
                            @endif
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>
                            Delete Account
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</section>
