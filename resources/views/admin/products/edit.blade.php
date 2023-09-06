@extends('admin.layouts.master')
@section('stylesheets')
@endsection
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edit Product</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner">

                            <form  id="editProductForm" class="gy-3 form-settings">
                                @csrf
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <div class="row g-3 align-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="name">Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" value="{{$product->name}}" required class="form-control" name="name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="sale-price">Category</label>
                                            <div class="form-control-wrap">
                                                <select name="product_category_id" required class="form-control" id="">
                                                    @foreach ($productCategories as $category)
                                                        <option value="{{$category->id}}" {{$product->product_catgory_id==$category?'selected':''}} >{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="price">Price</label>
                                            <div class="form-control-wrap">
                                                <input type="number" value="{{$product->price}}" required class="form-control" name="price">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="sale-price">Discount</label>
                                            <div class="form-control-wrap">
                                                <input type="number" value="{{$product->discount}}" required class="form-control" name="discount">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="category">Availability</label>
                                            <div class="form-control-wrap">
                                                <select name="available" required class="form-control" id="">
                                                    <option value="">Select Availability</option>
                                                    <option {{$product->available==1?'selected':''}} value="1">Available</option>
                                                    <option {{$product->available==0?'selected':''}} value="0">Out of Stock</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="category">Featured</label>
                                            <div class="form-control-wrap">
                                                <select name="is_featured" required class="form-control" id="">
                                                    <option value="">Select Featured</option>
                                                    <option  {{$product->is_featured==1?'selected':''}} value="1">Featured</option>
                                                    <option  {{$product->is_featured==0?'selected':''}} value="0">Not Featured</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="tags">Tags</label>
                                            <div class="form-control-wrap">
                                                <select name="tags[]" class="form-control tags" multiple >
                                                    @foreach($product->tags as $tag)
                                                    <option selected value="{{$tag->name}}">{{$tag->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="document">Product Images</label>
                                            <div class="needsclick dropzone" id="document-dropzone">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="category">Description</label>
                                            <div class="form-control-wrap">
                                                <textarea name="description" required class="form-control" cols="30" rows="10">{{$product->description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="category">Information</label>
                                            <div class="form-control-wrap">
                                                <textarea name="information" class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">

                                </div>
                                <div class="row g-3 align-center">

                                </div>
                                <div class="row g-3 align-center">

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
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
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
            $('#editProductForm').append('<input type="hidden" name="product_images[]" value="' + response.name + '">')
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
            $('#editProductForm').find('input[name="product_images[]"][value="' + name + '"]').remove()
        },
        init: function () {
            @if(isset($product) && $product->getMedia("*"))
            var files = {!! json_encode($product->getMedia("*")) !!}

                for (var i in files) {

                var file = files[i]
                this.options.addedfile.call(this, file);
                this.options.thumbnail(file,file.preview_url);

                file.previewElement.classList.add('dz-complete');
                $('#editProductForm').append('<input type="hidden" name="product_images[]" value="' + file.file_name + '">')
            }
            @endif
        }
    }
    $('.tags').select2({
        multiple:true,

        ajax: {
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            url: function (params) {
                return '{{url('admin/tag_search')}}';
            }
        },

        tags: true
    });
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
            submitForm('editProductForm', '{{url('admin/update_products')}}', false)
            // .then(() => {
            //     location.reload();
            // })
        }
    })
});
</script>
@endsection
