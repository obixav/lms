@extends('admin.layouts.master')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            @if(auth()->user()->role=='admin')
           @include('admin.dashboard_partials.admin_dashboard')
            @elseif(auth()->user()->role=='manager')
            @include('admin.dashboard_partials.manager_dashboard')
            @elseif(auth()->user()->role=='employee')
            @include('admin.dashboard_partials.employee_dashboard')
            @endif
        </div>
    </div>
</div>
@endsection
