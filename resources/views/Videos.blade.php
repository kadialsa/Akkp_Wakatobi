@extends('layout.app')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h2 class="display-5 text-white animated slideInDown">VIDEO TERKAIT</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Viedo Terkait</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <div class="container mt-5">


        <h3 class="fw-bold mb-3 text-title-dark">

            Video Terbaru

        </h3>

        <hr style="height:3px;background:#0d6efd;width:180px">


        <div class="row mt-4">

            @foreach ($videos as $video)
                @php
                    $link = str_replace('watch?v=', 'embed/', $video->youtube_link);
                @endphp

                <div class="col-md-6 mb-4">

                    <div class="card border-0 shadow-sm">

                        <div class="ratio ratio-16x9">

                            <iframe src="{{ $link }}" frameborder="0" allowfullscreen>

                            </iframe>

                        </div>

                        <div class="p-2 text-title-medium">

                            <b>

                                {{ $video->title }}

                            </b>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </div>
@endsection
