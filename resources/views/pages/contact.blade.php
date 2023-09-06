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
                <h2 class="page-title wow fadeInUp delay-0-2s">Contact Us</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb wow fadeInUp delay-0-4s">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Contact</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->


    <!-- Contact Feature Area start -->
    <section class="contact-feature pt-130 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="service-item-two style-two wow fadeInUp delay-0-2s">
                        <div class="icon">
                            <i class="flaticon-technical-support"></i>
                        </div>
                        <div class="content">
                            <h4>Need Our Support</h4>
                            <p>We offer full range of printing and branding services to a wide range of clients operating across different industry sectors all across Nigeria and beyond.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-item-two style-two wow fadeInUp delay-0-2s">
                        <div class="icon">
                            <i class="flaticon-chat"></i>
                        </div>
                        <div class="content">
                            <h4>Become our Customer</h4>
                            <p>We offer full range of printing and branding services to a wide range of clients operating across different industry sectors all across Nigeria and beyond.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Feature Area end -->


    <!-- Contact Info Area start -->
    <section class="contact-info-area mb-130">
        <div class="container">
            <div class="row no-gap">
                <div class="col-lg-6">
                    <div class="contact-info-content wow fadeInLeft delay-0-2s">
                        <div class="section-title mb-25">
                            <span class="sub-title mb-15">Contact Us</span>
                            <h2>We’re Ready to Helps! Feel Free to Contact With Us</h2>
                        </div>
                        <p>Our company is here to ease the stress of printing, with our innovative, idea and team work. Solve all printing problems, providing quality finishing using our cutting – edge printing technology.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-info-wrap wow fadeInRight delay-0-2s">
                        <div class="contact-info-item">
                            <div class="icon"><i class="fal fa-map-marker-alt"></i></div>
                            <div class="content">
                                <h4>Location</h4>
                                <p>Block C32 Alcobre Plaza, Opposite St. Patrick Church, Ojo L.G.A, Lagos state, Nigeria</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="icon"><i class="far fa-envelope-open"></i></div>
                            <div class="content">
                                <h4>Email Us</h4>
                                <a href="mailto:supportinfo@gmail.com">Richconceptunlimited@gmail.com</a>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="icon"><i class="far fa-phone"></i></div>
                            <div class="content">
                                <h4>Phone No</h4>
                                <a href="callto:+0001234567899">081838154993</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Info Area end -->


    <!-- Location Map Area Start -->
    <div class="contact-page-map wow fadeInUp delay-0-2s">
        <div class="our-location">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.513868222306!2d3.1696685757534824!3d6.4563838239380775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b81347065719f%3A0xa76f1fc17cb8dcfb!2sRICH%20CONCEPT%20UNLIMITED!5e0!3m2!1sen!2sng!4v1689613359873!5m2!1sen!2sng" style="border:0; width: 100%;"
                    allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
    <!-- Location Map Area End -->


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
