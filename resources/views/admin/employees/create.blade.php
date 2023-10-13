@extends('admin.layouts.master')
@section('content')
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Add Employee</h3>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <form action="{{url('employees')}}" method="POST">
                            @csrf
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="row gy-4">
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="first-name">First Name</label>
                                            <input type="text" class="form-control" name="first_name" id="first-name" placeholder="First Name" required value="{{old('first_name')}}">
                                            @error('first_name')<span id="fv-full-name-error" class="invalid">First Name is required.</span>@enderror
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="last-name">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" id="last-name" placeholder="Last Name" value="{{old('last_name')}}">
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="last-name">Staff ID</label>
                                            <input type="text" class="form-control" name="staff_id" id="staff-id" value="{{old('staff_id')}}" placeholder="Staff ID">
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Gender</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select js-select2" required name="gender">
                                                    <option value=" ">Select</option>
                                                    @foreach($genders as $gender)
                                                    <option value="{{$gender->value}}" {{old('gender')==strval($gender->value)?'selected':''}}>{{$gender->label()}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Date of Birth</label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-calendar"></em>
                                                </div>
                                                <input required name="dob" type="text" class="form-control date-picker" data-date-default-view-date="{{old('dob')==''?date('Y-m-d',strtotime("-18 years")):old('dob')}}" data-date-end-date="-18y" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                                            </div>
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="phone-no">Phone</label>
                                            <input type="text" name="phone" class="form-control" value="{{old('phone')}}" id="phone-no" placeholder="Phone no" required>
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" name="email" class="form-control" value="{{old('email')}}" id="email" placeholder="Email" required>
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Address</label>
                                            <input type="text" name="address" value="{{old('address')}}" class="form-control" id="address" placeholder="Address">
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="photo">Upload Photo</label>
                                            <div class="form-control-wrap">
                                                <div class="custom-file">
                                                    <input type="file" multiple class="form-control" id="customFile">
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Role</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select js-select2" name="role" required>
                                                    <option value="default_option">Select</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{$role}}">{{$role}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Grade</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select js-select2" name="grade_id" required>
                                                    <option value="default_option">Select</option>
                                                    @foreach($grades as $grade)
                                                        <option value="{{$grade->id}}" {{old('grade_id')==$grade->id?'selected':''}}>{{ucfirst($grade->name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="manager_id">Manager</label>
                                            <select id="manager_id" class="form-select js-select2" data-search="on" name="manager_id" required>
                                                <option value="default_option">Select</option>
                                                @foreach($managers as $manager)
                                                    <option value="{{$manager->id}}" {{old('manager_id')==$manager->id?'selected':''}}>{{$manager->fullname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Joining Date</label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-calendar"></em>
                                                </div>
                                                <input name="hiredate" type="text" class="form-control date-picker" data-date-default-view-date="{{old('hiredate')==''?'today':old('hiredate')}}" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" required>
                                            </div>
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select js-select2" name="status" required>
                                                    <option value="0" {{old('status')==0?'selected':''}}>Probation</option>
                                                    <option value="1" {{old('status')==1?'selected':''}}>Confirmed</option>
                                                    <option value="2" {{old('status')==2?'selected':''}}>Disengaged</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div><!--col-->

                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Save Employee Details</button>
                                        </div>
                                    </div><!--col-->
                                </div><!--row-->
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                        </form>
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
@endsection
