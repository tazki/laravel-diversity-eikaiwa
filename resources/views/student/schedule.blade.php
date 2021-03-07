@extends('layouts.app')

@section('content')
<div class="page schedule has-sidebar has-sidebar-fixed has-sidebar-expand-xl">
    {{-- <div class="page-inner page-inner-fill"> --}}
        <div class="board">
        <div class="card">
                <div id="js-schedule-calendar-client"></div>
            </div>
        </div>
    {{-- </div> --}}
    {{-- <div class="page-sidebar page-sidebar-fixed">
        <div class="sidebar-section-fill p-3">
            <h5> Task </h5>
            <div class="mb-1">
                <span class="badge badge-primary task-schedule-overdue">Overdue</span>
            </div>
            <div class="mb-1">
                <span class="badge badge-primary task-schedule-week-ago">Week ago</span>
            </div>
            <div class="mb-1">
                <span class="badge badge-primary task-schedule-progress">Progress</span>
            </div>
            <div class="mb-1">
                <span class="badge badge-primary task-schedule-done">Done</span>
            </div>
        </div>
    </div> --}}

    <a href="#" class="js-btn-add fab btn btn-primary btn-floated"
        data-tooltip="tooltip"
        data-title="{{ __('Create Booking') }}"
        data-create="{{ route('student_schedule_add') }}"
        data-toggle="modal"
        data-target="#studentScheduleFormModal">
            <span class="fa fa-plus"></span>
    </a>
    {{-- <a href="" class="js-btn-add btn btn-primary btn-floated"
        title="{{ __('Create Booking') }}">
        <span class="fa fa-plus"></span> --}}
    {{-- </a> --}}
</div>

@include('modals.schedule')
<link rel="stylesheet" href="{{ secure_asset('vendor/fullcalendar/fullcalendar.min.css') }}">
<script src="{{ secure_asset('vendor/moment/min/moment.min.js') }}"></script>
<script src="{{ secure_asset('vendor/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    $('#js-calendar-client').select2({
        width: '100%',
    });

    $(document).ready(function () {
        var fcTheme = FullCalendar.Theme;
        var LooperCalendarTheme = function (fcTheme) {
            function LooperCalendarTheme() {
                fcTheme.apply(this, arguments);
            }

            if (fcTheme) LooperCalendarTheme.__proto__ = fcTheme;
            LooperCalendarTheme.prototype = Object.create(fcTheme && fcTheme.prototype);
            LooperCalendarTheme.prototype.constructor = LooperCalendarTheme;
            return LooperCalendarTheme;
        }(fcTheme);

        LooperCalendarTheme.prototype.classes = {
            widget: 'fc-bootstrap4',
            tableGrid: 'table-bordered',
            tableList: 'table',
            tableListHeading: 'bg-light',
            buttonGroup: 'btn-group',
            button: 'btn btn-secondary',
            stateActive: 'active',
            stateDisabled: 'disabled',
            today: 'highlight',
            popover: 'popover',
            popoverHeader: 'popover-header',
            popoverContent: 'popover-body',
            headerRow: 'table-bordered',
            dayRow: 'table-bordered',
            listView: 'card card-reflow'
        };
        LooperCalendarTheme.prototype.iconClasses = {
            close: 'fa-times',
            prev: 'fa-chevron-left',
            next: 'fa-chevron-right',
            prevYear: 'fa-angle-double-left',
            nextYear: 'fa-angle-double-right'
        };
        LooperCalendarTheme.prototype.baseIconClass = 'fa';
        LooperCalendarTheme.prototype.iconOverrideOption = 'fontAwesome';
        LooperCalendarTheme.prototype.iconOverrideCustomButtonOption = 'fontAwesome';
        LooperCalendarTheme.prototype.iconOverridePrefix = 'fa-';
        FullCalendar.defineThemeSystem('looper', LooperCalendarTheme);
        loadCalendar("{{ route('student_schedule_calendar') }}", '');
        $('#js-calendar-client').on('change', function () {
            let view = $('#js-schedule-calendar').fullCalendar('getView');
            console.log(view);
            var clientId = $(this).val();
            $('#js-schedule-calendar-client').fullCalendar('destroy');
            loadCalendar("{{ url('client/schedule/calendar') }}", clientId, view.name);
        });
    });

    function loadCalendar(ajaxUrl, clientId, viewName="month") {
        $('#js-schedule-calendar-client').fullCalendar({
            themeSystem: 'looper',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month'
            },
            defaultView: viewName,
            height: 'auto',
            nowIndicator: true,
            weekNumbers: false,
            navLinks: true,
            editable: false,
            eventLimit: true,
            events: {
                url: ajaxUrl,
                type: 'POST',
                data: {
                    client_id: clientId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                error: function () {
                    alert('There was an error while fetching tasks!');
                }
            },
            eventClick: function (calEvent, jsEvent, view) {
                // console.log(calEvent);
                // console.log(jsEvent);
                // console.log(view);
                $('#scheduleTaskModal .js-log-divider').html(calEvent.chat_url);
                $('#scheduleTaskModal #js-task-title').text(calEvent.title);
                $('#scheduleTaskModal #js-task-description').text(calEvent.description);
                $('#scheduleTaskModal #js-task-share').text(calEvent.to_who);
                $('#scheduleTaskModal #js-task-due-date').text(calEvent.start._i);
                $('#scheduleTaskModal #js-task-status').text(calEvent.status);
                $('#scheduleTaskModal #js-task-link').attr('href', calEvent.url);
                $('#scheduleTaskModal').modal('show');
            },
        });
    }
</script>
@endsection