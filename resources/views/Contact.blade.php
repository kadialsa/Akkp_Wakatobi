@extends('layout.App')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h2 class="display-3 text-white">Contact</h2>
                    <nav>
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item">
                                <a class="text-white" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item text-white active">Contak</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">

            {{-- ALERT SUCCESS --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ERROR VALIDATION --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-4">

                <!-- Info Kontak -->
                <div class="col-lg-4 col-md-6">

                    <h5 class="text-title-dark">Hubungi Kami</h5>

                    <p class="mb-4">
                        Silakan hubungi kami melalui kontak di bawah atau kirim pesan melalui form.
                    </p>

                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary text-white d-flex align-items-center justify-content-center"
                            style="width:50px;height:50px;">
                            <i class="fa fa-map-marker-alt"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Alamat</h5>
                            <p class="mb-0">AKKP Wakatobi, Sulawesi Tenggara</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary text-white d-flex align-items-center justify-content-center"
                            style="width:50px;height:50px;">
                            <i class="fa fa-phone-alt"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Telepon</h5>
                            <p class="mb-0">-</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white d-flex align-items-center justify-content-center"
                            style="width:50px;height:50px;">
                            <i class="fa fa-envelope-open"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Email</h5>
                            <p class="mb-0">akkpwakatobi@kkp.go.id</p>
                        </div>
                    </div>

                </div>


                <!-- Form Kontak -->
                <div class="col-lg-8 col-md-12">

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" placeholder="Nama"
                                        value="{{ old('name') }}">
                                    <label>Nama</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        value="{{ old('email') }}">
                                    <label>Email</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="subject" class="form-control" placeholder="Subjek"
                                        value="{{ old('subject') }}">
                                    <label>Subjek</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea name="message" class="form-control" style="height:150px" placeholder="Pesan">{{ old('message') }}</textarea>
                                    <label>Pesan</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">
                                    Kirim Pesan
                                </button>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
    <!-- Contact End -->
@endsection
