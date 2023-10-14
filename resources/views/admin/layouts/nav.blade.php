<div class="nk-sidebar nk-sidebar-fixed is-theme " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head" style="background: #ffffff">
        <div class="nk-sidebar-brand">
            <a href="{{url('dashboard')}}" class="logo-link nk-sidebar-logo">


                <img class="logo-light logo-img" src="{{asset('admin_assets/images/logo.png')}}" srcset="{{asset('admin_assets/images/logo.png')}} 2x" alt="logo">
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-item">
                        <a href="{{url('dashboard')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    @if(auth()->user()->role=='admin')
                    <li class="nk-menu-item">
                        <a href="{{url('employees')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                            <span class="nk-menu-text">Employees</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    @endif
                    @if(auth()->user()->role=='admin' || auth()->user()->role=='manager')
                    <li class="nk-menu-item">
                        <a href="{{url('leave_approvals')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-calendar-check-fill"></em></span>
                            <span class="nk-menu-text">Leave Approvals</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                        <li class="nk-menu-item">
                            <a href="{{url('leave_cancellation_approvals')}}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-calendar-check-fill"></em></span>
                                <span class="nk-menu-text">Leave Cancellation Approvals</span>
                            </a>
                        </li><!-- .nk-menu-item -->
                    @endif
{{--                    layers-fill--}}
                    <li class="nk-menu-item">
                        <a href="{{url('settings')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-user-switch-fill"></em></span>
                            <span class="nk-menu-text">Replacement Requests</span>
                        </a>
                    </li><!-- .nk-menu-item -->

                    <li class="nk-menu-item">
                        <a href="{{url('my_leave_requests/')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-calendar-booking-fill"></em></span>
                            <span class="nk-menu-text">My Leave Requests</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    @if(auth()->user()->role=='admin')
                    <li class="nk-menu-item">
                        <a href="{{url('settings')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-setting-fill"></em></span>
                            <span class="nk-menu-text">Settings</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    @endif


                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
