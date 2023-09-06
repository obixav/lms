@extends('layouts.master')
@section('content')

    <!-- Page Banner Start -->
    <section class="page-banner bgs-cover text-white pt-65 pb-75"
             style="background-image: url(assets/images/banner.jpg);">
        <div class="container">
            <div class="banner-inner">
                <h2 class="page-title wow fadeInUp delay-0-2s">Projects</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb wow fadeInUp delay-0-4s">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Projects</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->

    <!-- Project Area start -->
    <section class="project-page-area rel z-1 pt-120 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-9">
                    <div class="section-title text-center mb-40 wow fadeInUp delay-0-2s">
                        <span class="sub-title mb-10">Our Latest Project</span>
                        <h2>We’ve Done Lot’s Of Project! Have a Look Our Recent Projects!</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="project-filter mb-50 wow fadeInUp delay-0-4s">
                <li data-filter="*" class="current">Show All</li>
                @foreach($project_categories as $project_category)
                <li data-filter=".project{{$project_category->id}}">{{$project_category->name}}</li>
                @endforeach

            </ul>
            <div class="row project-two-active">
                @foreach($projects as $project)
                    @php
                        $media = $project->getFirstMedia("project_main_image");
                    @endphp
                <div class="col-xl-3 col-lg-4 col-sm-6 item project{{$project->project_category->id}}">

                    <div class="project-item-two">
                        <img src="{{$media->original_url}}" alt="Project">
                        <div class="project-content">
                            <div class="left-part">
                                <h5><a href="{{url('projects/'.$project->id)}}">{{$project->name}}</a></h5>
                                <span>{{$project->project_category->name}}</span>
                            </div>
                            <a href="{{$media->original_url}}" class="plus"><i class="fal fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Project Area end -->

@endsection
