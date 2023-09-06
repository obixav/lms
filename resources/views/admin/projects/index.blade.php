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
                            <h3 class="nk-block-title page-title">Projects</h3>

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
                                                    <option value="0">Select Project Category</option>
                                                    @foreach ($projectCategories as $category)
                                                    <option value="{{$category->id}}" {{request()->category==$category->id?'selected':''}}>{{$category->name}}</option>
                                                    @endforeach
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
                                            <a href="#" data-target="addProject" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                            <a href="#" data-target="addProject" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Project</span></a>
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
                                        <div class="nk-tb-col tb-col-sm"><span>Title</span></div>
                                        <div class="nk-tb-col"><span>Category</span></div>
                                        <div class="nk-tb-col tb-col-md"><span>Company Name</span></div>
                                        <div class="nk-tb-col"><span>Project Date</span></div>
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

                                    @foreach ($projects as $project )
                                    @php
                                        $mediaItems = $project->getMedia("project_main_image");
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
                                                <span class="title">{{$project->name}}</span>

                                            </span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub">{{$project->project_category->name}}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-lead"> {{$project->company}}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub">{{date('F j, Y',strtotime($project->date))}}</span>
                                        </div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="me-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="{{url('admin/edit_project/'.$project->id)}}"><em class="icon ni ni-edit"></em><span>Edit Project</span></a></li>
                                                                <li><a onclick="deleteProject({{$project->id}})"><em class="icon ni ni-trash"></em><span>Remove Project</span></a></li>
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
                <div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProject" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title">New Project</h5>
                            <div class="nk-block-des">
                                <p>Add information and add new Project.</p>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <form id="addProjectForm">
                        @csrf
                    <div class="nk-block">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="product-title">Project Title</label>
                                    <div class="form-control-wrap">
                                        <input type="text" required class="form-control" name="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="regular-price">Date</label>
                                    <div class="form-control-wrap">
                                        <input type="text" required class="form-control date-picker-alt" name="date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="sale-price">Company Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" required class="form-control" name="company">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="category">Category</label>
                                    <div class="form-control-wrap">
                                      <select name="project_category_id" required class="form-control" id="">
                                        @foreach ($projectCategories as $category)
                                        <option value="{{$category->id}}" >{{$category->name}}</option>
                                        @endforeach
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
                                    <label class="form-label" for="information">Challenge</label>
                                    <div class="form-control-wrap">
                                      <textarea name="challenge" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="information">Summary</label>
                                    <div class="form-control-wrap">
                                        <textarea name="summary" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">

                                <div class="form-group">
                                    <label class="form-label" for="document">Project Main Image</label>
                                    <div class="needsclick dropzone" id="document-dropzone">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="other-images-dropzone">Other Images</label>
                                    <div class="needsclick dropzone" id="other-images-dropzone">

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
      $('#addProjectForm').append('<input type="hidden" name="project_images[]" value="' + response.name + '">')
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
      $('#addProjectForm').find('input[name="project_images[]"][value="' + name + '"]').remove()
    },
    init: function () {
      @if(isset($project) && $project->getMedia())
        var files =
          {!! json_encode($project->getMedia()) !!}
        for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          file.previewElement.classList.add('dz-complete')
          $('#addProjectForm').append('<input type="hidden" name="project_images[]" value="' + file.file_name + '">')
        }
      @endif
    }
  }
  Dropzone.options.otherImagesDropzone = {
            url: '{{ route('media.store') }}',
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
                $('#addProjectForm').append('<input type="hidden" name="other_images[]" value="' + response.name + '">')
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
                $('#addProjectForm').find('input[name="other_images[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($project) && $project->getMedia())
                var files =
                    {!! json_encode($project->getMedia()) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('#addProjectForm').append('<input type="hidden" name="other_images[]" value="' + file.file_name + '">')
                }
                @endif
            }
        }
  $('#addProjectForm').submit(function(e) {
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
            submitForm('addProjectForm', '{{url('admin/projects')}}', false)
            // .then(() => {
            //     location.reload();
            // })
        }
    })
});
function deleteProject(project_id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this project information?!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.get('{{url('admin/delete_project')}}/'+project_id, function (data) {
                if (data.success == true) {
                    location.reload();
                }
            })
        }
    })


}
</script>
@endsection
