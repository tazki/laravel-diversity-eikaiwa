<div class="modal fade" id="teacherScheduleFormModal" tabindex="-1" role="dialog" aria-labelledby="teacherScheduleFormModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="teacherScheduleFormModalLabel" class="modal-title text-center w-100">{{ __('Class Booking') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('teacher_schedule_update') }}" class="auth-form shadow-none p-0">
                    @csrf
                    <div class="form-group">
                        <label for="task-assign">{{ __('Student') }}</label>
                        <input type="text" id="js-booking-student" class="form-control input" readonly="readonly" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="task-due-date">{{ __('Booking Date') }}</label>
                        <input type="text" id="js-booking-date" class="form-control" readonly="readonly" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="task-due-date">{{ __('Status') }} <span class="text-danger">*</span></label>
                        <select name="status" id="js-booking-status" class="custom-select">
                            <option value="1">{{ __('Request Class Schedule') }}</option>
                            <option value="2">{{ __('Accept Class Schedule') }}</option>
                            <option value="3">{{ __('Class Done') }}</option>
                        </select>
                    </div>
                    <div class="modal-footer px-0">
                        <input type="hidden" name="id" id="js-booking-id" />
                        <input type="hidden" name="confirm_first" class="js-input-confirm" value="1" />
                        <button type="button" class="js-btn-cancel btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="button" class="js-btn-confirm btn btn-primary" onClick="ajaxForm(this); return false;">{{ __('Next') }}</button>
                        <button type="button" class="js-btn-back btn btn-secondary d-none">{{ __('Back') }}</button>
                        <button type="button" class="js-btn-submit btn btn-primary d-none" onClick="ajaxForm(this); return false;">{{ __('Save') }}</button>
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
