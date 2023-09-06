@extends('admin.layouts.master')
@section('stylesheets')
<style>
.dropzone .dz-preview .dz-error-message {
    top: 150px!important;
  }
    </style>
@endsection
@section('content')
 <!-- content @s -->
 <div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Products</h3>

                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <form action="">
                                        <li>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-search"></em>
                                                </div>
                                                <input type="text" name="q" class="form-control" id="default-04" placeholder="Quick search by name or SKU">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-control-wrap">

                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-link-group"></em>
                                                </div>
                                                <select name="category" class="form-control" id="">
                                                    <option value="0">Select Product Category</option>
                                                    @foreach ($productCategories as $category)
                                                    <option value="{{$category->id}}" {{request()->category==$category->id?'selected':''}}>{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-control-wrap">

                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-
                                                    check-round-cut"></em>
                                                </div>
                                                <select name="availability" class="form-control" id="">
                                                    <option value="">Availability</option>
                                                    <option value="1">Available</option>
                                                    <option value="0">Out of Stock</option>
                                                </select>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-control-wrap">

                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-star-fill
                                                    check-round-cut"></em>
                                                </div>
                                                <select name="featured" class="form-control" id="">
                                                    <option value="">Featured</option>
                                                    <option value="1">Featured</option>
                                                    <option value="0">Not Featured</option>
                                                </select>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-control-wrap">

                                                <button type="submit" class="btn btn-info d-none d-md-inline-flex">Filter</button>
                                            </div>
                                        </li>

                                    </form>
                                        <li class="nk-block-tools-opt">
                                            <a href="#" data-target="addProduct" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                            <a href="#" data-target="addProduct" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Product</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                <div class="nk-tb-list">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="pid">
                                                <label class="custom-control-label" for="pid"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm"><span>Name</span></div>
                                        <div class="nk-tb-col"><span>SKU</span></div>
                                        <div class="nk-tb-col"><span>Price</span></div>
                                        <div class="nk-tb-col"><span>Available</span></div>
                                        <div class="nk-tb-col tb-col-md"><span>Category</span></div>
                                        <div class="nk-tb-col tb-col-md"><em class="tb-asterisk icon ni ni-star-round"></em></div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="me-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#"><em class="icon ni ni-edit"></em><span>Edit Selected</span></a></li>
                                                                <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Selected</span></a></li>
                                                                <li><a href="#"><em class="icon ni ni-bar-c"></em><span>Update Stock</span></a></li>
                                                                <li><a href="#"><em class="icon ni ni-invest"></em><span>Update Price</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .nk-tb-item -->

                                    @foreach ($products as $product )
                                    @php
                                        $mediaItems = $product->getMedia("*");
                                    @endphp
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="pid4">
                                                <label class="custom-control-label" for="pid4"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                <img src="{{count($mediaItems)>1?$mediaItems[0]->getAvailableUrl(['preview']):''}}" alt="" class="thumb">
                                                <span class="title">{{$product->name}}</span>

                                            </span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub">{{$product->sku}}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-lead">$ {{$product->price}}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub">{{$product->available==1?'Available':'Out of Stock'}}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span class="tb-sub">{{$product->product_category->name}}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <div class="asterisk tb-asterisk">
                                                <a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="me-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="{{url('admin/edit_product/'.$product->id)}}"><em class="icon ni ni-edit"></em><span>Edit Product</span></a></li>
                                                                <li><a href="#"><em class="icon ni ni-eye"></em><span>View Product</span></a></li>
                                                                <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Product Orders</span></a></li>
                                                                <li><a onclick="deleteProduct({{$product->id}})"><em class="icon ni ni-trash"></em><span>Remove Product</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                    @endforeach


                                </div><!-- .nk-tb-list -->
                            </div>
                            <div class="card-inner">
                                <div class="nk-block-between-md g-3">
                                    <div class="g">


                                    </div>

                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
                <div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title">New Product</h5>
                            <div class="nk-block-des">
                                <p>Add information and add new product.</p>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <form id="addProductForm">
                        @csrf
                    <div class="nk-block">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="product-title">Product Title</label>
                                    <div class="form-control-wrap">
                                        <input type="text" required class="form-control" name="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="regular-price">Price</label>
                                    <div class="form-control-wrap">
                                        <input type="number" required class="form-control" name="price">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="sale-price">Discount</label>
                                    <div class="form-control-wrap">
                                        <input type="number" required class="form-control" name="discount">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="category">Category</label>
                                    <div class="form-control-wrap">
                                      <select name="product_category_id" required class="form-control" id="">
                                        @foreach ($productCategories as $category)
                                        <option value="{{$category->id}}" >{{$category->name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="category">Availability</label>
                                    <div class="form-control-wrap">
                                      <select name="available" required class="form-control" id="">
                                        <option value="">Select Availability</option>
                                        <option value="1">Available</option>
                                        <option value="0">Out of Stock</option>
                                    </select>
                                      </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="category">Featured</label>
                                    <div class="form-control-wrap">
                                      <select name="is_featured" required class="form-control" id="">
                                        <option value="">Featured</option>
                                        <option value="1">Featured</option>
                                        <option value="0">Not Featured</option>
                                    </select>
                                      </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="tags">Tags</label>
                                    <div class="form-control-wrap">
                                        <select name="tags[]" class="form-control tags" multiple ></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="description">Description</label>
                                    <div class="form-control-wrap">
                                      <textarea name="description" required class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="information">Information</label>
                                    <div class="form-control-wrap">
                                      <textarea name="information" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                {{-- <div class="upload-zone small bg-lighter my-2">
                                    <div class="dz-message">
                                        <span class="dz-message-text">Drag and drop file</span>
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <label class="form-label" for="document">Product Images</label>
                                    <div class="needsclick dropzone" id="document-dropzone">

                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>
                            </div>
                        </div>
                    </div>
                    </form>
                    <!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content @e -->
@endsection
@section('scripts')

<script>
        $('.tags').select2({
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

var uploadedDocumentMap = {}
  Dropzone.options.documentDropzone = {
    url: '{{ route('media.store') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
      $('#addProductForm').append('<input type="hidden" name="product_images[]" value="' + response.name + '">')
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
      $('#addProductForm').find('input[name="product_images[]"][value="' + name + '"]').remove()
    },
    init: function () {
      @if(isset($product) && $product->getMedia())
        var files =
          {!! json_encode($product->getMedia()) !!}
        for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          file.previewElement.classList.add('dz-complete')
          $('#addProductForm').append('<input type="hidden" name="product_images[]" value="' + file.file_name + '">')
        }
      @endif
    }
  }
  $('#addProductForm').submit(function(e) {
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
            submitForm('addProductForm', '{{url('admin/products')}}', false)
            // .then(() => {
            //     location.reload();
            // })
        }
    })
});
function deleteProduct(product_id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this product?!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.get('{{url('admin/delete_product')}}/'+product_id, function (data) {
                if (data.success == true) {
                    location.reload();
                }
            })
        }
    })


}
</script>
@endsection
