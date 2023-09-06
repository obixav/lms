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
                            <h3 class="nk-block-title page-title">Edit Project</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner">

                            <form  id="editProjectForm" class="gy-3 form-settings">
                                @csrf
                                <input type="hidden" name="id" value="{{$project->id}}">
                                <div class="row g-3 align-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="name">Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" value="{{$project->name}}" required class="form-control" name="name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="sale-price">Category</label>
                                            <div class="form-control-wrap">
                                                <select name="project_category_id" required class="form-control" id="">
                                                    @foreach ($projectCategories as $category)
                                                        <option value="{{$category->id}}" {{$project->project_catgory_id==$category?'selected':''}} >{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="datePicker">Date</label>
                                            <div class="form-control-wrap">
                                                <input type="text" id="datePicker" required class="form-control " name="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="sale-price">Company Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" value="{{$project->company}}" required class="form-control" name="company">
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
                                                    @foreach($project->tags as $tag)
                                                    <option selected value="{{$tag->name}}">{{$tag->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="document">Main Image</label>
                                            <div class="needsclick dropzone" id="document-dropzone">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="document">Other Images</label>
                                            <div class="needsclick dropzone" id="other-images-dropzone">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="category">Description</label>
                                            <div class="form-control-wrap">
                                                <textarea name="description" required class="form-control" cols="30" rows="10">{{$project->description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="category">Challenge</label>
                                            <div class="form-control-wrap">
                                                <textarea name="challenge" class="form-control" cols="30" rows="10">{{$project->challenge}}</textarea>
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
        maxFiles:1,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('#editProjectForm').append('<input type="hidden" name="project_images[]" value="' + response.name + '">')
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
            $('#editProjectForm').find('input[name="project_images[]"][value="' + name + '"]').remove()
        },
        init: function () {
            @if(isset($project) && $project->getMedia("project_main_image"))
            var files = {!! json_encode($project->getMedia("project_main_image")) !!}

                for (var i in files) {

                var file = files[i]
                this.options.addedfile.call(this, file);
                this.options.thumbnail(file,file.preview_url);

                file.previewElement.classList.add('dz-complete');
                $('#editProjectForm').append('<input type="hidden" name="project_images[]" value="' + file.file_name + '">')
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
            $('#editProjectForm').append('<input type="hidden" name="other_images[]" value="' + response.name + '">')
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
            $('#editProjectForm').find('input[name="project_images[]"][value="' + name + '"]').remove()
        },
        init: function () {
            @if(isset($project) && $project->getMedia("project_other_images"))
            var files = {!! json_encode($project->getMedia("project_other_images")) !!}

            for (var i in files) {

                var file = files[i]
                this.options.addedfile.call(this, file);
                this.options.thumbnail(file,file.preview_url);

                file.previewElement.classList.add('dz-complete');
                $('#editProjectForm').append('<input type="hidden" name="other_images[]" value="' + file.file_name + '">')
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
$('#editProjectForm').submit(function(e) {
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
            submitForm('editProjectForm', '{{url('admin/update_projects')}}', false)
            // .then(() => {
            //     location.reload();
            // })
        }
    })
});

    $( '#datePicker' ).datepicker( 'setDate', '{{date('m-d-Y',strtotime($project->date))}}' );
</script>
@endsection
