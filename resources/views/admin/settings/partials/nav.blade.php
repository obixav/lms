<ul class="link-list-menu">
    <li><a class=" {{Route::is('settings')?'active':''}}" href="{{url('settings')}}"><em class="icon ni ni-setting-fill"></em><span>General</span></a></li>
    <li><a class=" {{Route::is('leave_settings')?'active':''}}" href="{{url('leave_settings')}}"><em class="icon ni ni-setting-question-fill"></em><span>Leave Setting</span></a></li>
    <li><a class=" {{Route::is('leave_types')?'active':''}}" href="{{url('leave_types')}}"><em class="icon ni ni-calender-date-fill"></em><span>Leave Types</span></a></li>
    <li><a class=" {{Route::is('holidays')?'active':''}}" href="{{url('holidays')}}"><em class="icon ni ni-calendar-booking-fill"></em><span>Holidays</span></a></li>
    <li><a class=" {{Route::is('grades')?'active':''}}" href="{{url('grades')}}"><em class="icon ni ni-shield-star-fill"></em><span>Grades</span></a></li>
    <li><a class=" {{Route::is('workflows')?'active':''}}" href="{{url('workflows')}}"><em class="icon ni ni-package"></em><span>Workflows</span></a></li>
</ul>
