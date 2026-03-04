@extends('layout.Admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Profile Settings</h1>

    <div class="row">
        <div class="col-lg-8">

            <div class="card shadow mb-4">
                <div class="card-header font-weight-bold">
                    Profile Information
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form', ['user' => Auth::user()])
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header font-weight-bold">
                    Update Password
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header font-weight-bold text-danger">
                    Delete Account
                </div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
