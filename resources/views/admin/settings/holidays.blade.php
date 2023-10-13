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
                                                <h5 class="title fw-medium">Holiday settings</h5>
                                                <span>These settings helps you modify Holiday settings.</span>
                                            </div><!-- .nk-block-head-content -->
                                            <div class="nk-block-head-content ">
                                            </div>
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">

                                        <div class="card card-bordered">




                                            <div class="card-inner-group">
                                                <div class="card-inner">
                                                    <div class="card-title-group">
                                                        <div class="card-title">
                                                            <h5 class="title"> Holiday </h5>
                                                        </div>

                                                        <div class="card-tools">
                                                            <button  data-bs-toggle="modal"
                                                                     data-bs-target="#CreateHolidayModal" class="btn btn-primary right"><em class="icon ni ni-plus"></em><span>Add  Holiday </span></button>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-inner">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($holidays as $holiday)
                                                            <tr>
                                                                <td>{{$holiday->name}}</td>
                                                                <td>{{date('F j, Y',strtotime($holiday->date))}}</td>
                                                                <td></td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
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
    @include('admin.settings.modals.createHoliday')
@endsection
@section('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function () {

            $('#date ').datepicker({
                format: 'yyyy-mm-dd',
                multidate: true,
                todayHighlight: true, daysOfWeekDisabled: [@if($leave_setting->includes_weekend==0)0, 6 @endif],
                clearBtn: true,
            })
            $('#CreateHolidayForm').submit(function(e) {
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
                        submitForm('CreateHolidayForm', '{{url('holidays')}}', '{{url('holidays')}}');
                        // .then(() => {
                        //     location.reload();
                        // })
                    }
                })
            });

        });
    </script>
@endsection
