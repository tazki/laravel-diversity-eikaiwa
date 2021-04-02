<div class="modal fade" id="studentScheduleFormModal" tabindex="-1" role="dialog" aria-labelledby="studentScheduleFormModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="studentScheduleFormModalLabel" class="modal-title text-center w-100">{{ __('Create Class Booking') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('student_schedule_add') }}" class="auth-form shadow-none p-0">
                    @csrf
                    <div class="form-group">
                        <label for="task-assign">{{ __('Teacher') }} <span class="text-danger">*</span></label>
                        <select name="teacher_id" class="js-task-assign custom-select form-control" id="task-assign">
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
                        <input type="text" name="booking_date" id="jsBookingDate" class="form-control" placeholder="Select Date">
                    </div>
                    <div class="modal-footer px-0">
                        {{-- @if(isset($rows['client']->id))
                            <input type="hidden" name="client_id" value="{{ $rows['client']->id }}" />
                        @endif --}}
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
<script src="{{ secure_asset('vendor/flatpickr/l10n/ja.js') }}"></script>
<script>
    $("#jsBookingDate").flatpickr({
        locale: "ja",
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
