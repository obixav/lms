@extends('admin.layouts.master')
@section('stylesheets')
@endsection
@section('content')
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Design Request Details</h3>
                                <div class="nk-block-des text-soft">
                                    <p>View Design Request Details</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="html/product-list.html" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                <a href="html/product-list.html" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card">
                            <div class="card-inner">
                                <div class="row pb-5">
                                    <div class="col-lg-6">
                                        @php
                                            $mediaItems = $design_request->getMedia("request_images");
                                        @endphp
                                        @if(count($mediaItems)>0)
                                        <div class="product-gallery me-xl-1 me-xxl-5">
                                            <div class="slider-init" id="sliderFor" data-slick='{"arrows": false, "fade": true, "asNavFor":"#sliderNav", "slidesToShow": 1, "slidesToScroll": 1}'>
                                               @foreach($mediaItems as $media)
                                                <div class="slider-item rounded">
                                                    <img src="{{$media->original_url}}" class="rounded w-100" alt="">
                                                </div>
                                                @endforeach

                                            </div><!-- .slider-init -->
                                            <div class="slider-init slider-nav" id="sliderNav" data-slick='{"arrows": false, "slidesToShow": 5, "slidesToScroll": 1, "asNavFor":"#sliderFor", "centerMode":true, "focusOnSelect": true,
                                "responsive":[ {"breakpoint": 1539,"settings":{"slidesToShow": 4}}, {"breakpoint": 768,"settings":{"slidesToShow": 3}}, {"breakpoint": 420,"settings":{"slidesToShow": 2}} ]
                            }'>
                                                @foreach($mediaItems as $media)
                                                <div class="slider-item">
                                                    <div class="thumb">
                                                        <img src="{{$media->preview_url}}" class="rounded" alt="">
                                                    </div>
                                                </div>
                                                @endforeach

                                            </div><!-- .slider-nav -->
                                        </div><!-- .product-gallery -->
                                        @endif
                                    </div><!-- .col -->
                                    <div class="col-lg-6">
                                        <div class="product-info mt-5 me-xxl-5">
                                            <h4 class="product-price text-primary">&#8358;{{$design_request->budget}} <small class="text-muted fs-14px">Budget</small></h4>
                                            <h2 class="product-title">{{$design_request->project_category?$design_request->project_category->name:''}} Request</h2>

                                            <div class="product-excrept text-soft">
                                                <p class="lead">{{$design_request->message}}</p>
                                            </div>
                                            <div class="product-meta">
                                                <ul class="d-flex g-3 gx-5">
                                                    <li>

                                                        <div class="fs-16px fw-bold text-secondary">Customer Name</div>
                                                        <div class="fs-16px fw-bold text-secondary">Customer Email</div>
                                                        <div class="fs-16px fw-bold text-secondary">Customer Phone Number</div>
                                                        <div class="fs-16px fw-bold text-secondary">Request Date</div>
                                                        <div class="fs-16px fw-bold text-secondary">Budget</div>
                                                        <div class="fs-16px fw-bold text-secondary">Quantity</div>
                                                    </li>
                                                    <li>

                                                        <div class="fs-16px fw-bold text-secondary">{{$design_request->customer?$design_request->customer->name:''}}</div>
                                                        <div class="fs-16px fw-bold text-secondary">{{$design_request->customer?$design_request->customer->email:''}}</div>
                                                        <div class="fs-16px fw-bold text-secondary">{{$design_request->customer?$design_request->customer->phone:''}}</div>
                                                        <div class="fs-16px fw-bold text-secondary">{{date('F j, Y',strtotime($design_request->created_at))}}</div>
                                                        <div class="fs-16px fw-bold text-secondary">&#8358;{{$design_request->budget}}</div>
                                                        <div class="fs-16px fw-bold text-secondary">{{$design_request->quantity}}</div>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div><!-- .product-info -->
                                    </div><!-- .col -->
                                </div><!-- .row -->
                                <hr class="hr border-light">
                                <div class="row pb-5">
                                    <div class="col-lg-6">
                                        <h2>Response</h2>
                                        <form  id="editProductForm" class="gy-3 form-settings">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$design_request->id}}">

                                            <div class="row g-3 align-center">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="category">Can Preview request</label>
                                                        <div class="form-control-wrap">
                                                            <select name="can_preview_request" required class="form-control" id="">
                                                                <option value="">Select If Customer can preview request</option>
                                                                <option {{$design_request->available==1?'selected':''}} value="1">yes</option>
                                                                <option {{$design_request->available==0?'selected':''}} value="0">No</option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="document">Response Images</label>
                                                        <div class="needsclick dropzone" id="document-dropzone">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="category">Response</label>
                                                        <div class="form-control-wrap">
                                                            <textarea name="response" required class="form-control" cols="30" rows="10">{{$design_request->response}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row g-3">
                                                <div class="col-lg-7 offset-lg-5">
                                                    <div class="form-group mt-2">
                                                        <button type="submit"
                                                                class="btn btn-lg btn-primary">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div><!-- .col -->
                                    <div class="col-lg-6">
                                        @php
                                            $mediaItems = $design_request->getMedia("reponse_images");
                                        @endphp
                                        @if(count($mediaItems)>0)
                                        <div class="product-gallery me-xl-1 me-xxl-5">
                                            <div class="slider-init" id="sliderFor" data-slick='{"arrows": false, "fade": true, "asNavFor":"#sliderNav", "slidesToShow": 1, "slidesToScroll": 1}'>
                                                @foreach($mediaItems as $media)
                                                    <div class="slider-item rounded">
                                                        <img src="{{$media->original_url}}" class="rounded w-100" alt="">
                                                    </div>
                                                @endforeach

                                            </div><!-- .slider-init -->
                                            <div class="slider-init slider-nav" id="sliderNav" data-slick='{"arrows": false, "slidesToShow": 5, "slidesToScroll": 1, "asNavFor":"#sliderFor", "centerMode":true, "focusOnSelect": true,
                                "responsive":[ {"breakpoint": 1539,"settings":{"slidesToShow": 4}}, {"breakpoint": 768,"settings":{"slidesToShow": 3}}, {"breakpoint": 420,"settings":{"slidesToShow": 2}} ]
                            }'>
                                                @foreach($mediaItems as $media)
                                                    <div class="slider-item">
                                                        <div class="thumb">
                                                            <img src="{{$media->preview_url}}" class="rounded" alt="">
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div><!-- .slider-nav -->
                                        </div><!-- .product-gallery -->
                                        @endif
                                    </div><!-- .col -->
                                </div><!-- .row -->
                            </div>
                        </div>
                    </div><!-- .nk-block -->

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('media.store') }}',
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
                $('#editProductForm').append('<input type="hidden" name="response_images[]" value="' + response.name + '">')
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
                $('#editProductForm').find('input[name="response_images[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($design_request) && $design_request->getMedia("response_images"))
                var files = {!! json_encode($design_request->getMedia("response_images")) !!}

                for (var i in files) {

                    var file = files[i]
                    this.options.addedfile.call(this, file);
                    this.options.thumbnail(file,file.preview_url);

                    file.previewElement.classList.add('dz-complete');
                    $('#editProductForm').append('<input type="hidden" name="response_images[]" value="' + file.file_name + '">')
                }
                @endif
            }
        }

        $('#editProductForm').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to Save changes?!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Save it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    submitForm('editProductForm', '{{route('admin.design_requests.store')}}', false)
                    // .then(() => {
                    //     location.reload();
                    // })
                }
            })
        });
    </script>
@endsection
