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
                            <h3 class="nk-block-title page-title">Edit Service</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner">

                            <form  id="editServiceForm" class="gy-3 form-settings">
                                @csrf
                                <input type="hidden" name="id" value="{{$service->id}}">
                                <div class="row g-3 align-center">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="name">Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" value="{{$service->name}}" required class="form-control" name="name">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row g-3 align-center">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="category">Description</label>
                                            <div class="form-control-wrap">
                                                <textarea name="details" required class="form-control" cols="30" rows="10">{{$service->details}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="document">Service Images</label>
                                            <div class="needsclick dropzone" id="document-dropzone">

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
            $('#editServiceForm').append('<input type="hidden" name="service_images[]" value="' + response.name + '">')
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
            $('#editServiceForm').find('input[name="service_images[]"][value="' + name + '"]').remove()
        },
        init: function () {
            @if(isset($service) && $service->getMedia("*"))
            var files = {!! json_encode($service->getMedia("*")) !!}

                for (var i in files) {

                var file = files[i]
                this.options.addedfile.call(this, file);
                this.options.thumbnail(file,file.preview_url);

                file.previewElement.classList.add('dz-complete');
                $('#editServiceForm').append('<input type="hidden" name="service_images[]" value="' + file.file_name + '">')
            }
            @endif
        }
    }

$('#editServiceForm').submit(function(e) {
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
            submitForm('editServiceForm', '{{url('admin/update_services')}}', false)
            .then(() => {
                location.reload();
            })
        }
    })
});

</script>
@endsection
