@extends('layouts.master')
@section('content')
    <!-- Page Banner Start -->
    <section class="page-banner bgs-cover text-white pt-65 pb-75" style="background-image: url(assets/images/banner.jpg);">
        <div class="container">
            <div class="banner-inner">
                <h2 class="page-title wow fadeInUp delay-0-2s">{{$project->name}}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb wow fadeInUp delay-0-4s">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Project Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->

    <!-- Project Details Area start -->
    <section class="project-details-area pt-130 rpt-120">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="content mb-75 wow fadeInUp delay-0-2s">
                        <div class="section-title"><h2>{{$project->name}}</h2></div>
                        <p>{!! $project->description !!}</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="project-description wow fadeInDown delay-0-2s">
                        <ul>
                            <li>
                                <span>Project Category</span>
                                <h3>{{$project->project_category->name}}</h3>
                            </li>
                            <li>
                                <span>Company Name</span>
                                <h3>{{$project->company}}</h3>
                            </li>
                            <li>
                                <span>Project Date</span>
                                <h3>{{date('F j,Y',strtotime($project->date))}}</h3>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            @php
                $media = $project->getFirstMedia("project_main_image");
                 $mediaItems = $project->getMedia("project_other_images");
            @endphp
            <div class="image mb-40 wow fadeInUp delay-0-2s">
                <img src="{{$media->original_url}}" alt="Project Details">
            </div>
            <div class="content mb-75">
                <div class="section-title mb-20"><h2>The Challenge</h2></div>
                <p>{!! $project->challenge !!}</p>
            </div>
            <div class="row">
                @foreach($mediaItems as $media)
                <div class="col-lg-6">
                    <div class="image mb-30 wow fadeInUp delay-0-2s">
                        <img src="{{$media->original_url}}" alt="Project Middle">
                    </div>
                </div>
                @endforeach

            </div>
            <div class="content mt-10 mb-75 wow fadeInUp delay-0-2s">
                <div class="section-title mb-20"><h2>Project Summary</h2></div>
                <p>{{$project->summary}}</p>
            </div>
        </div>
    </section>
    <!-- Project Details Area End -->


@endsection
