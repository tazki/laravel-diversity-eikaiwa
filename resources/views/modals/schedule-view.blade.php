<div class="modal fade" id="studentScheduleViewModal" tabindex="-1" role="dialog" aria-labelledby="studentScheduleFormModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row w-100">
                    <div class="col-12">
                        <h5 id="studentScheduleFormModalLabel" class="modal-title text-center w-100">{{ __('Create Class Booking') }}</h5>
                    </div>
					<div class="col-12">
                        <h6 class="text-center w-100">{{ __('Please wait for the reservation email from the teacher') }}</h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('student_schedule_add') }}" class="auth-form shadow-none p-0">
                    @csrf
                    <div class="form-group">
                        <label for="task-assign">{{ __('Teacher') }} <span class="text-danger">*</span></label>
                        <select disabled name="teacher_id" id="js-booking-teacher" class="custom-select form-control" id="task-assign">{{-- js-task-assign  --}}
                            <option value=""></option>
                            @if(isset($rows['teachers']))
                                @foreach($rows['teachers'] as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="task-due-date">{{ __('Booking Date') }} <span class="text-danger">*</span></label>
                        <input disabled type="text" name="booking_date" id="js-booking-date" class="js-input-flatpickr form-control" placeholder="Select Date">
                    </div>
                    <div class="form-group">
                        <label for="task-due-date">{{ __('Status') }}</label>
                        <select id="js-booking-status" class="custom-select" readonly="readonly" disabled="disabled">
                            <option value="1">{{ __('Request Class Schedule') }}</option>
                            <option value="2">{{ __('Accept Class Schedule') }}</option>
                            <option value="3">{{ __('Class Done') }}</option>
                            <option value="4">{{ __('Class Cancel By Student') }}</option>
                            <option value="5">{{ __('Class Cancel By Teacher') }}</option>
                        </select>
                    </div>
                    <div class="modal-footer px-0">
                        <a class="js-btn-delete btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-deleteurl="" href="#">Cancel Class</a>
                        <button type="button" class="js-btn-cancel btn btn-primary" data-dismiss="modal">{{ __('Close') }}</button>
                    </div>
                </form>
            </div>
            @include('includes.modal-loader')
        </div>
    </div>
</div>

<script src="{{ secure_asset('vendor/flatpickr/flatpickr.min.js') }}"></script>
<script>
	    $("#js-client-task-due-date").flatpickr({
        disableMobile: "true",
        altInput: true,
        altFormat: "F j, Y H:i",
        dateFormat: "Y-m-d H:i:s",
        minDate: "today",
        enableTime: true,
        time_24hr: true,
        minTime: "8:00",
        maxTime: "22:00",
        minuteIncrement: "60",
        // defaultDate: "13:45" // preloading time
        // disable: ["2021-03-10", "2021-03-11", "2021-03-12", "2021-03-31"], // disable specific date
        // disable: [ //disables Saturdays and Sundays.
        //     function(date) {
        //         // return true to disable
        //         return (date.getDay() === 0 || date.getDay() === 6);

        //     }
        // ],
    });
    $(".js-task-assign").select2({
        width: '100%',
        placeholder: "{{ __('Select') }}",
    });
</script>
