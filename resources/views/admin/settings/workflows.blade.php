@extends('admin.layouts.master')
@section('content')
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-aside-wrap">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head nk-block-head-lg">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h5 class="title fw-medium">Workflow settings</h5>
                                                <span>These settings helps you modify workflow settings.</span>
                                            </div><!-- .nk-block-head-content -->
                                            <div class="nk-block-head-content ">
                                                <button  data-bs-toggle="modal"
                                                   data-bs-target="#CreateWorkflowModal" class="btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Workflow</span></button>
                                            </div>
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="card">
                                        <div class="card-inner">
                                            <h5 class="card-title">Workflows</h5>
                                       <table class="table">
                                           <thead>
                                           <tr>
                                               <th>Name</th>
                                               <th>No of Stages</th>
                                               <th>Action</th>
                                           </tr>
                                           </thead>
                                           <tbody>
                                           @foreach($workflows as $workflow)
                                           <tr>
                                               <td>{{$workflow->name}}</td>
                                               <td>{{$workflow->stages?$workflow->stages()->count():''}}</td>
                                               <td></td>
                                           </tr>
                                           @endforeach
                                           </tbody>
                                       </table>
                                        </div>
                                        </div>

                                    </div><!-- .nk-block-head -->
                                </div><!-- .card-inner -->
                                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                    <div class="card-inner-group" data-simplebar>
                                        <div class="card-inner">
                                            <h3 class="nk-block-title page-title">Settings</h3>
                                            <div class="nk-block-des text-soft">
                                                <p>Here you can change and edit your needs</p>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="card-inner p-0">
                                            @include('admin.settings.partials.nav')
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- card-aside -->
                            </div><!-- card-aside-wrap -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
    @include('admin.settings.modals.createWorkflow')
@endsection
@section('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function () {
        $('.users').select2();
        $('#stgcont').sortable();

        var stgcont = $('#stgcont');
        var i = $('#stgcont li').length + 1;

        $('#addStage').on('click', function() {
            //console.log('working');
            $(' <li><div class="form-cont" > <div class="form-group"> <label for="">Name</label> <input type="text" class="form-control" name="stagename[]" id="" placeholder="" required> </div><div class="form-group type"> <label for="">Type</label> <select class="form-control select-type " name="type[]" >  <option value="1">User</option> <option value="2">Role</option><option value="3">Manager</option> </select> </div> <div class="form-group users-div"> <label for="">Users</label> <select class="form-control users" name="user_id[]" > @forelse ($users as $user) <option value="{{$user->id}}">{{$user->name}}</option> @empty <option value="">No Users Created</option> @endforelse </select> </div> <div class="form-group roles-div"> <label for="">Roles</label> <select class="form-control roles" name="role[]" >   @forelse ($roles as $role) <option value="{{$role}}">{{$role}}</option> @empty <option value="">No Roles Created</option> @endforelse </select> </div> <div class="form-group"> <button type="button" class="btn btn-primary " id="remStage">Remove Stage</button> </div> </div> </li>').appendTo(stgcont);
            //console.log('working'+i);
            $('#stgcont li').last().find('.roles-div').hide();
            $('#stgcont li').last().find('.roles-div').find('.roles').attr("disabled",true);
            i++;
            return false;
        });

        $(document).on('click',"#remStage",function() {
            //console.log('working'+i);
            if( i > 1 ) {
                console.log('working'+i);
                $(this).parents('li').remove();
                i--;
            }
            return false;
        });
        $(document).on('change',".select-type",function() {


            if (this.value==3)
            {
                $(this).parents('li').find('.users-div').find('.users').attr("disabled",true);
                $(this).parents('li').find('.users-div').hide();
                $(this).parents('li').find('.roles-div').find('.roles').attr("disabled",true);
                $(this).parents('li').find('.roles-div').hide();


            }


            if (this.value==2)
            {
                $(this).parents('li').find('.users-div').find('.users').attr("disabled",true);
                $(this).parents('li').find('.users-div').hide();
                $(this).parents('li').find('.roles-div').find('.roles').removeAttr("disabled");
                $(this).parents('li').find('.roles-div').show();


            }
            if (this.value==1)
            {
                $(this).parents('li').find('.roles-div').find('.roles').attr("disabled",true);

                $(this).parents('li').find('.users-div').find('.users').removeAttr("disabled");
                $(this).parents('li').find('.users-div').show();
                $(this).parents('li').find('.roles-div').hide();


            }


        });

        $('#CreateWorkflowForm').submit(function(e) {
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
                    submitForm('CreateWorkflowForm', '{{url('workflows')}}', '{{url('workflows')}}');
                    // .then(() => {
                    //     location.reload();
                    // })
                }
            })
        });

    });
</script>
@endsection
