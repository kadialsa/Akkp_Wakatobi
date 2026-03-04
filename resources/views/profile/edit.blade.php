@extends('layout.admin')

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-12">

            {{-- PROFILE INFO --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Profile Information</h5>
                </div>
                <div class="card-body bg-light">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- UPDATE PASSWORD --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Update Password</h5>
                </div>
                <div class="card-body bg-light">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- DELETE ACCOUNT --}}
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Delete Account</h5>
                </div>
                <div class="card-body bg-light">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
