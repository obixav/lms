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
                            <h3 class="nk-block-title page-title">Edit Team Member</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner">

                            <form  id="editTeamMemberForm" class="gy-3 form-settings">
                                @csrf
                                <input type="hidden" name="id" value="{{$team_member->id}}">
                                <div class="row g-3 align-center">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="name">Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" value="{{$team_member->name}}" required class="form-control" name="name">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="name">Role</label>
                                            <div class="form-control-wrap">
                                                <input type="text" value="{{$team_member->role}}" required class="form-control" name="role">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="name">Facebook</label>
                                            <div class="form-control-wrap">
                                                <input type="text" value="{{$team_member->facebook}}" required class="form-control" name="facebook">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="name">Twitter</label>
                                            <div class="form-control-wrap">
                                                <input type="text" value="{{$team_member->twitter}}" required class="form-control" name="twitter">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="document">Team Member Image</label>
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
            $('#editTeamMemberForm').append('<input type="hidden" name="team_member_images[]" value="' + response.name + '">')
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
            $('#editTeamMemberForm').find('input[name="team_member_images[]"][value="' + name + '"]').remove()
        },
        init: function () {
            @if(isset($team_member) && $team_member->getMedia("*"))
            var files = {!! json_encode($team_member->getMedia("*")) !!}

                for (var i in files) {

                var file = files[i]
                this.options.addedfile.call(this, file);
                this.options.thumbnail(file,file.preview_url);

                file.previewElement.classList.add('dz-complete');
                $('#editTeamMemberForm').append('<input type="hidden" name="team_member_images[]" value="' + file.file_name + '">')
            }
            @endif
        }
    }

$('#editTeamMemberForm').submit(function(e) {
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
            submitForm('editTeamMemberForm', '{{url('admin/update_team_members')}}', false)
            // .then(() => {
            //     location.reload();
            // })
        }
    })
});

</script>
@endsection
