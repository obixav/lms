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
                                <h3 class="nk-block-title page-title">Calendar</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <a class="btn btn-primary" data-bs-toggle="modal" href="#addEventPopup"><em class="icon ni ni-plus"></em><span>Add Event</span></a>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card">
                            <div class="card-inner">
                                <div id="calendar" class="nk-calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
@endsection
@section('scripts')
    <script src="{{asset('admin_assets/js/bundle.js?ver=3.2.0')}}"></script>
    <script src="{{asset('admin_assets/js/scripts.js?ver=3.2.0')}}"></script>
    <script src="{{asset('admin_assets/js/libs/fullcalendar.js?ver=3.2.0')}}"></script>
{{--    <script src="{{asset('admin_assets/js/apps/calendar.js?ver=3.2.0')}}"></script>--}}
{{--    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>--}}
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                timeZone: 'UTC+1',
                themeSystem: 'bootstrap5',
                headerToolbar: {
                    left: 'title prev,next',
                    center: null,
                    right: 'today dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                height: 800,
                contentHeight: 780,
                aspectRatio: 3,
                editable: true,
                droppable: true,
                views: {
                    dayGridMonth: {
                        dayMaxEventRows: 2
                    }
                },
                direction: NioApp.State.isRTL ? "rtl" : "ltr",
                nowIndicator: true,
            });
            calendar.render();
        });

    </script>
@endsection
