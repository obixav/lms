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
                            <h3 class="nk-block-title page-title">Team Members</h3>

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
                                                <input type="text" value="{{request()->q}}" name="q" class="form-control" id="default-04" placeholder="Quick search by name ">
                                            </div>
                                        </li>



                                        <li>
                                            <div class="form-control-wrap">

                                                <button type="submit" class="btn btn-info d-none d-md-inline-flex">Filter</button>
                                            </div>
                                        </li>

                                    </form>
                                        <li class="nk-block-tools-opt">
                                            <a href="#" data-target="addTeamMember" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                            <a href="#" data-target="addTeamMember" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Team Member</span></a>
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
                                        <div class="nk-tb-col tb-col-sm"><span>Role</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Facebook</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Twitter</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="me-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .nk-tb-item -->

                                    @foreach ($team_members as $team_member )
                                    @php
                                        $mediaItems = $team_member->getMedia("avatar");
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
                                                <img src="{{$team_member->getFirstMedia("avatar")?$team_member->getFirstMedia("avatar")->preview_url:''}}" alt="" class="thumb">
                                                <span class="title">{{$team_member->name}}</span>

                                            </span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub">{{$team_member->role}}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub">{{$team_member->facebook}}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub">{{$team_member->twitter}}</span>
                                        </div>

                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="me-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="{{url('admin/edit_team_member/'.$team_member->id)}}"><em class="icon ni ni-edit"></em><span>Edit Team Member</span></a></li>
                                                                <li><a onclick="deleteTeamMember({{$team_member->id}})"><em class="icon ni ni-trash"></em><span>Remove Team Member</span></a></li>
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
                <div class="nk-add-product toggle-slide toggle-slide-right" data-content="addTeamMember" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title">New Team Member</h5>
                            <div class="nk-block-des">
                                <p>Add information and add new Member.</p>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <form id="addTeamMemberForm">
                        @csrf
                    <div class="nk-block">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="product-title">Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" required class="form-control" name="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="product-title">Role</label>
                                    <div class="form-control-wrap">
                                        <input type="text" required class="form-control" name="role">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="product-title">Facebook</label>
                                    <div class="form-control-wrap">
                                        <input type="text" required class="form-control" name="facebook">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="product-title">Twitter</label>
                                    <div class="form-control-wrap">
                                        <input type="text" required class="form-control" name="twitter">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">

                                <div class="form-group">
                                    <label class="form-label" for="document">Team Member  Image</label>
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

var uploadedDocumentMap = {}
  Dropzone.options.documentDropzone = {
    url: '{{ route('media.store') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
      $('#addTeamMemberForm').append('<input type="hidden" name="team_member_images[]" value="' + response.name + '">')
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
      $('#addTeamMemberForm').find('input[name="team_member_images[]"][value="' + name + '"]').remove()
    },
    init: function () {

    }
  }

  $('#addTeamMemberForm').submit(function(e) {
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
            submitForm('addTeamMemberForm', '{{url('admin/team_members')}}', false)
            // .then(() => {
            //     location.reload();
            // })
        }
    })
});
function deleteTeamMember(team_member_id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this team member information?!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.get('{{url('admin/delete_team_member')}}/'+team_member_id, function (data) {
                if (data.success == true) {
                    location.reload();
                }
            })
        }
    })


}
</script>
@endsection
