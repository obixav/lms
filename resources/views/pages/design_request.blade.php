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

                        <form id="requestForm" class="contact-form z-1 rel"  name="contactForm" method="post">
                            @csrf
                            <div class="section-title text-center mb-40">
                               <span class="sub-title">Get In Touch</span>
                               <h2>Send Us Message</h2>
                           </div>
                            <div class="row mt-25">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name"><i class="far fa-user"></i></label>
                                        <input type="text" id="name" name="name" class="form-control" value="" placeholder="Full Name" required data-error="Please enter your name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email"><i class="far fa-envelope"></i></label>
                                        <input type="email" id="email" name="email" class="form-control" value="" placeholder="Email Address" required data-error="Please enter your email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="phone"><i class="far fa-phone"></i></label>
                                        <input type="text" required id="phone" name="phone" class="form-control" value="" placeholder="Phone Number" data-error="Please enter your phone number">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-30">
                                    <div class="form-group">
                                        <label for="subject"><i class="far fa-question-circle"></i></label>
                                        <select id="subject" name="category_id" required data-error="Please select a project type">
                                            <option value="" selected="">Project Type :</option>
                                            @foreach($project_categories as $pc)
                                            <option value="{{$pc->id}}">{{$pc->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="quantity"><i class="far fa-balance-scale"></i></label>
                                        <input type="text" id="quantity" required data-error="Please enter the quantity" name="quantity" class="form-control" value="" placeholder="Quantity">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="budget"><i class="far fa-money-bill"></i></label>
                                        <input type="number" id="budget" name="budget" class="form-control" value="" placeholder="Budget">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">

                                        <div class="dropzone" id="document-dropzone"></div>


                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="message"><i class="far fa-highlighter"></i></label>
                                        <textarea name="message" id="message" class="form-control" rows="4" placeholder="Write your Message" required data-error="Please enter your Message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="tac-wrap mb-30">
                                        <input type="checkbox" id="tac" name="tac" value="tac" required  data-error="Please you have to agree">
                                        <label for="tac">I agree that my data is collected and stored.</label>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-0">
                                        <button type="submit" class="theme-btn">Send Message <i class="fas fa-arrow-right"></i></button>
                                        <div id="msgSubmit" class="hidden"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Form End -->



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
