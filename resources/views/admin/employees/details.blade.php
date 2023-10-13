@extends('admin.layouts.master')
@section('content')
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Employees / <strong class="text-primary small">{{$employee->name}}</strong></h3>
                                <div class="nk-block-des text-soft">
                                    <ul class="list-inline">
                                        <li>Staff ID: <span class="text-base">{{$employee->staff_id}}</span></li>
                                        <li>Last Login: <span class="text-base"></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{url()->previous()}}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                <a href="{{url()->previous()}}" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card">
                            <div class="card-aside-wrap">
                                <div class="card-content">
                                    <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#"><em class="icon ni ni-user-circle"></em><span>Personal</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"><em class="icon ni ni-calender-date-fill"></em><span>Leave History</span></a>
                                        </li>

                                        <li class="nav-item nav-item-trigger d-xxl-none">
                                            <a href="#" class="toggle btn btn-icon btn-trigger" data-target="userAside"><em class="icon ni ni-user-list-fill"></em></a>
                                        </li>
                                    </ul><!-- .nav-tabs -->
                                    <div class="card-inner">
                                        <div class="nk-block">
                                            <div class="nk-block-head">

                                                <h5 class="title">Personal Information </h5>
                                                <p>Basic info, like your name and address, that you use on the Platform.</p>
                                            </div><!-- .nk-block-head -->
                                            <div class="profile-ud-list">
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">First Name</span>
                                                        <span class="profile-ud-value">{{$employee->first_name}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Last Name</span>
                                                        <span class="profile-ud-value">{{$employee->last_name}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Date of Birth</span>
                                                        <span class="profile-ud-value">{{date('F j, Y',strtotime($employee->dob))}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Email Address</span>
                                                        <span class="profile-ud-value">{{$employee->email}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Mobile Number</span>
                                                        <span class="profile-ud-value">{{$employee->phone}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label"> Address</span>
                                                        <span class="profile-ud-value">{{$employee->address}}</span>
                                                    </div>
                                                </div>
                                            </div><!-- .profile-ud-list -->
                                        </div><!-- .nk-block -->
                                        <div class="nk-block">
                                            <div class="nk-block-head nk-block-head-line">
                                                <h6 class="title overline-title text-base">Additional Information</h6>
                                            </div><!-- .nk-block-head -->
                                            <div class="profile-ud-list">
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Joining Date</span>
                                                        <span class="profile-ud-value">{{date('F j, Y',strtotime($employee->hiredate))}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Grade</span>
                                                        <span class="profile-ud-value">{{$employee->grade?$employee->grade->name:''}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Role</span>
                                                        <span class="profile-ud-value">{{$employee->role}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Gender</span>
                                                        <span class="profile-ud-value">{{ucfirst($employee->gender)}}</span>
                                                    </div>
                                                </div>
                                            </div><!-- .profile-ud-list -->
                                        </div><!-- .nk-block -->
                                        <div class="nk-divider divider md"></div>

                                    </div><!-- .card-inner -->
                                </div><!-- .card-content -->
                                <div class="card-aside card-aside-right user-aside toggle-slide toggle-slide-right toggle-break-xxl" data-content="userAside" data-toggle-screen="xxl" data-toggle-overlay="true" data-toggle-body="true">
                                    <div class="card-inner-group" data-simplebar>
                                        <div class="card-inner">
                                            <div class="user-card user-card-s2">
                                                <div class="user-avatar lg bg-primary">
                                                    <span>{{generateInitials($employee->name)}}</span>
                                                </div>
                                                <div class="user-info">
                                                    <div class="badge bg-outline-light rounded-pill ucap">{{ucfirst($employee->role)}}</div>
                                                    <h5>{{$employee->name}}</h5>
                                                    <span class="sub-text">{{$employee->email}}</span>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="card-inner card-inner-sm">
                                            <ul class="btn-toolbar justify-center gx-1">
                                                <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-shield-off"></em></a></li>
                                                <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-mail"></em></a></li>
                                                <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-download-cloud"></em></a></li>
                                                <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-bookmark"></em></a></li>
                                                <li><a href="#" class="btn btn-trigger btn-icon text-danger"><em class="icon ni ni-na"></em></a></li>
                                            </ul>
                                        </div><!-- .card-inner -->

                                        <div class="card-inner">
                                            <div class="row text-center">
                                                <div class="col-4">
                                                    <div class="profile-stats">
                                                        <span class="amount">23</span>
                                                        <span class="sub-text">Total Order</span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="profile-stats">
                                                        <span class="amount">20</span>
                                                        <span class="sub-text">Complete</span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="profile-stats">
                                                        <span class="amount">3</span>
                                                        <span class="sub-text">Progress</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->

                                    </div><!-- .card-inner -->
                                </div><!-- .card-aside -->
                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
@endsection
