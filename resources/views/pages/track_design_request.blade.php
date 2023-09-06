@extends('layouts.master')
@section('stylesheets')
    <link
        rel="stylesheet"
        href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
        type="text/css"
    />
@endsection
@section('content')
        <!-- Page Banner Start -->
        <section class="page-banner bgs-cover text-white pt-65 pb-75" style="background-image: url(assets/images/banner.jpg);">
            <div class="container">
                <div class="banner-inner">
                    <h2 class="page-title wow fadeInUp delay-0-2s">Design Request</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb wow fadeInUp delay-0-4s">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">Design Request</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
        <!-- Page Banner End -->



         <!-- Contact Form Start -->
        <section class="contact-form-area mt-110 mb-130 wow fadeInUp delay-0-2s">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="widget widget-search wow fadeInUp delay-0-2s">
                            <form action="#" class="default-search-form">
                                <input type="text" placeholder="Enter Tracking Code" value="{{request()->tracking_id}}" name="tracking_id" required>
                                <button type="submit" class="searchbutton far fa-search"></button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Form End -->
        @if(isset($design_request) && $design_request->can_preview_request==1)
        <!-- Project Area start -->
        <section class="project-page-area rel z-1 pt-120 pb-100">
            <div class="container">
                <div class="row justify-content-center mb-0">
                    <div class="col-xl-8 col-lg-9">
                        <div class="section-title text-center mb-40 wow fadeInUp delay-0-2s">
                            <span class="sub-title mb-10">Hello, {{$design_request->customer?$design_request->customer->name:''}}, Your Designs are ready</span>
                            <h2>We’ve Kindly Let us Know if you love them</h2>
                        </div>
                    </div>
                </div>
                <h4>Your Designs</h4>
                <div class="row project-two-active">


                        @php
                            $mediaItems = $design_request->getMedia("request_images");
                        @endphp
                    @foreach($mediaItems as $media)
                    <div class="col-xl-6 col-lg-6 col-sm-6 item logoo 3dprint">
                        <div class="project-item-two">
                            <img src="{{$media->original_url}}" alt="Project">
                            <div class="project-content">
                                <div class="left-part">


                                </div>
                                <a href="{{$media->original_url}}" class="plus"><i class="fal fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <h4>Our Output</h4>
                <div class="row project-two-active">


                    @php
                        $mediaItems = $design_request->getMedia("response_images");
                    @endphp
                    @foreach($mediaItems as $media)
                        <div class="col-xl-6 col-lg-6 col-sm-6 item logoo 3dprint">
                            <div class="project-item-two">
                                <img src="{{$media->original_url}}" alt="Project">
                                <div class="project-content">
                                    <div class="left-part">


                                    </div>
                                    <a href="{{$media->original_url}}" class="plus"><i class="fal fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>




        </section>
        <!-- Project Area end -->
        @elseif(isset($design_request))
            <section class="project-page-area rel z-1 pt-120 pb-100">
                <div class="container">
                    <div class="row justify-content-center mb-0">
                        <div class="col-xl-8 col-lg-9">
                            <div class="section-title text-center mb-40 wow fadeInUp delay-0-2s">
                                <span class="sub-title mb-10">Hello, {{$design_request->customer?$design_request->customer->name:''}}, We are still working on your design</span>
                                <h2>We will Kindly notify you when it is ready</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif



@endsection
@section('scripts')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>

        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('media.store.public') }}',
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
                $('#requestForm').append('<input type="hidden" name="request_images[]" value="' + response.name + '">')
                uploadedDocumentMap[file.name] = response.name
            },
            removedfile: function (file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('#requestForm').find('input[name="request_images[]"][value="' + name + '"]').remove()
            },
            init: function () {

            }
        }

        $('#requestForm').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to Submit this request?!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Submit it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    submitForm('requestForm', '{{url('design_requests')}}', false)
                    .then(() => {
                        location.reload();
                    })
                }
            })
        });
    </script>
@endsection
