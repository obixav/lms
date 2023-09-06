@extends('admin.layouts.master')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Settings</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner">
                            <h5 class="card-title">Web Store Setting</h5>
                            <p>Here is your basic store setting of your website.</p>
                            <form  id="settingForm" class="gy-3 form-settings">
                                @csrf
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="site-name">Store Name</label>
                                            <span class="form-note">Specify the name of your
                                                website.</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="site-name" name="store_name"
                                                    value="{{$setting->store_name}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="email">Site
                                                Email</label>
                                            <span class="form-note">Specify the email address of your
                                                website.</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="email" name="email"
                                                    value="{{$setting->email}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="copyright">Site
                                                Copyright</label>
                                            <span class="form-note">Copyright information of your
                                                website.</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    id="copyright" name="copyright"
                                                    value="{{$setting->copyright}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="address">Office Address</label>
                                            <span class="form-note">Head Office.</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    id="address" name="address"
                                                    value="{{$setting->address}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="phone">Phone Number</label>
                                            <span class="form-note">Phone Number</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    id="phone" name="phone"
                                                    value="{{$setting->phone}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="facebook">Facebook</label>
                                            <span class="form-note">Facebook</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    id="facebook" name="facebook"
                                                    value="{{$setting->facebook}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="instagram">Instagram</label>
                                            <span class="form-note">Instagram</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    id="instagram" name="instagram"
                                                    value="{{$setting->instagram}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="instagram">Tax rate</label>
                                            <span class="form-note">Tax Rate</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                       id="tax_rate" name="tax_rate"
                                                       value="{{$setting->tax_rate}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="instagram">Discount Announcement</label>
                                            <span class="form-note">This is displayed at the top of all pages e.g 20% Off</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                       id="discount_announcement" name="discount_announcement"
                                                       value="{{$setting->discount_announcement}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="instagram">Small Announcement</label>
                                            <span class="form-note">This is displayed at the top of all pages beside discount announcement</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                       id="small_announcement" name="small_announcement"
                                                       value="{{$setting->small_announcement}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="instagram">Big Announcement</label>
                                            <span class="form-note">This is displayed on the home page</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <textarea class="form-control"
                                                         id="big_announcement" name="big_announcement">{{$setting->big_announcement}}</textarea>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="maintenance_mode">Maintanance
                                                Mode</label>
                                            <span class="form-note">Enable to make website make
                                                offline.</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">

                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="maintenance_mode" {{$setting->maintenance_mode==1?'checked':''}}  id="customSwitch2">
                                                <label class="custom-control-label" for="customSwitch2">Offline</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-lg-7 offset-lg-5">
                                        <div class="form-group mt-2">
                                            <button type="submit"
                                                class="btn btn-lg btn-primary">Update</button>
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
$('#settingForm').submit(function(e) {
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
            submitForm('settingForm', '{{url('admin/settings')}}', false)
            // .then(() => {
            //     location.reload();
            // })
        }
    })
});
</script>
@endsection
