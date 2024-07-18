@extends('landingpage.index')
@section('content')
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       
        @isset($category)
        <title>{{ $category->name }}</title>
        <meta name="title" content="{{ $category->name }}">
        <meta name="description" content="{{ $category->meta_desc }}">
        <meta name="keywords" content="{{ $category->keywords }}">
        @endisset

        @isset($tag)
        <title>{{ $tag->name }}</title>
        <meta name="title" content="{{ $tag->name }}">
        <meta name="description" content="{{ $tag->meta_desc }}">
        <meta name="keywords" content="{{ $tag->keywords }}">
        @endisset

        @if (!isset($tag) && !isset($category))
        <title>Kegiatan</title>
        @endif
    </head>
    <body>
         <!-- Blog Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Blog list Start -->
                <div class="col-lg-8">
                    <div class="row g-5">
                
                    @foreach ($posts as $row)
                    <div class="col-md-6 wow slideInUp" data-wow-delay="0.1s">
                    <div class="blog-item bg-light rounded overflow-hidden">
                    <div class="blog-img position-relative overflow-hidden">
                        <img src="{{ url($row->cover)}}" class="card-img-top" style="height: 50%;" alt="...">
                        <div class="card-body">
                            <a href="{{ route('show', $row->slug) }}" class="text-dark">
                            <h4 class="mb-3">{{ $row->title }}</h4>
                            <p>{{ Str::limit( strip_tags( $row->desc ), 60 ) }}</p>
                                    <a class="text-uppercase" href="{{ route('show', $row->slug) }}">Read More <i class="bi bi-arrow-right"></i></a>
                            </a>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex mx-auto">
                                @foreach ($row->tags as $tags)
                                <a href="{{ route('tag', $tags->slug) }}" class="badge badge-secondary mr-1">
                                #{{ $tags->name }}</a>
                                @endforeach
                                <small class="text-muted ml-auto">{{ Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</small>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                @endforeach
                    </div>      
                </div>
                <!-- Blog list End -->

                <!-- Sidebar Start -->
                <div class="col-lg-4">
    
                    <!-- Category Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-titlee section-titlee-sm position-relative pb-3 mb-4"></br>
                            <h6 class="mb-0">Categories</h6>
                        </div>
                        @foreach ($categories as $cat)
                        <div class="link-animated d-flex flex-column justify-content-start">
                                <a href="{{ route('category', $cat->slug) }}" class="bi bi-arrow-right me-2">
                                {{ $cat->name }}</a>   
                        </div>
                       @endforeach
                    </div>
                    <!-- Category End -->
    
                    <!-- Recent Post Start -->
                    <!--div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-titlee section-titlee-sm position-relative pb-3 mb-4"></br>
                            <h6 class="mb-0">Recent Post</h6>
                        </div>
                        
                        @foreach($posts as $row)
                        <div class="d-flex rounded overflow-hidden mb-3">
                            <img class="img-fluid" src="{{ url('/storage/'.$row->cover)}}" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                            <a href="{{ route('show', $row->slug) }}" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">
                            {{ $row->title }}
                        </a>
                        </div>
                        @endforeach
                    </div-->
                    <!-- Recent Post End -->
    
                    <!-- Tags Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-titlee section-titlee-sm position-relative pb-3 mb-4"></br>
                            <h6 class="mb-0">Tag Cloud</h6>
                        </div>
                        <div class="d-flex flex-wrap m-n1">
                       
                        @foreach ($tagar as $item)
                                <a href="{{ route('tag', $item->slug) }}" class="btn btn-light m-1">
                                    {{ $item->name }}</a>
                                    
                                @endforeach
        
                        </div>
                    </div>
                    <!-- Tags End -->
                </div>
                   <!-- Sidebar Start -->
            </div>
        </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        
    </body>
</html>
@endsection