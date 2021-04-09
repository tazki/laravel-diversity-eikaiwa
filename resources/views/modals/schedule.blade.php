<div class="modal fade" id="studentScheduleFormModal" role="dialog" aria-labelledby="studentScheduleFormModalLabel"
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
                        <select name="teacher_id" class="js-teacher-assign custom-select form-control" id="task-assign">
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

@if(isset($rows['teachers_availability']) && is_array($rows['teachers_availability']))
    @foreach($rows['teachers_availability'] as $teacherId => $item)
        <span id="teacher_{{ $teacherId }}">
            <span id="notAvailableDay_{{ $teacherId }}" data-notavailableday="{{ $item['notAvailableDay'] }}"></span>
            @if(isset($item['availableDay']))
                @foreach($item['availableDay'] as $item2)
                    <span id="day_{{ $teacherId }}_{{ $item2['day'] }}" data-start="{{ $item2['start_time'] }}" data-end="{{ $item2['end_time'] }}"></span>
                @endforeach
            @endif
        </span>
    @endforeach
@endif

<script src="{{ secure_asset('vendor/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ secure_asset('vendor/flatpickr/l10n/ja.js') }}"></script>
<script>
    $(".js-teacher-assign").select2({
        width: '100%',
        placeholder: "{{ __('Select') }}",
    });

    $("body").on( "change", ".js-teacher-assign", function() {
        var teacherId = $(this).children('option:selected').val();
        var notAvailableDay = $('#notAvailableDay_'+teacherId).data('notavailableday');
        console.log('teacherId:'+teacherId);
        console.log(notAvailableDay);
        let jsBookingDate = $("#jsBookingDate").flatpickr({
            // locale: "ja",
            disableMobile: "true",
            altInput: true,
            altFormat: "F j, Y H:i",
            dateFormat: "Y-m-d H:i:s",
            minDate: "today",
            enableTime: true,
            time_24hr: true,
            // minTime: "8:00",
            // maxTime: "22:00",
            minuteIncrement: "60",
            // defaultDate: "13:45" // preloading time
            // disable: ["2021-03-10", "2021-03-11", "2021-03-12", "2021-03-31"], // disable specific date
            disable: [ //disables Saturdays and Sundays.
                function(date) {
                    if(notAvailableDay != undefined) {
                        var test = '';
                        $.each(notAvailableDay, function(index, valNotAvailableDay) {
                            if(test != '') {
                                test += ' || ';
                            }
                            test += '(' + date.getDay() +'=='+ valNotAvailableDay + ')';
                        });

                        return eval(test);
                    }
                    // return true to disable
                    // return (date.getDay() === 0 || date.getDay() === 6);

                }
            ],
            // enable: ["2021-04-04", "2021-04-05"]
            // To Fix Maximum call stack size exceeded. just need to remove tabindex="-1" on your modal div. the problem will gone
            onChange: function (selectedDates, dateStr, instance) {
                var date = new Date(Date.parse(dateStr));
                var startTime = $('#day_'+teacherId+'_'+date.getDay()).data('start');
                var endTime = $('#day_'+teacherId+'_'+date.getDay()).data('end');
                // date.setMinutes(date.getMinutes() + 1);
                // newDate = Date.parse(date.toString());
                // let selectedDate = date.getDate();
                // end_date.set("minDate", newDate);
                // end_date.setDate(newDate, true);
                // let today = new Date().getDate();
                // if (selectedDate == today){
                //     start_date.set("minTime", "13:00");
                // }
                // else{
                    console.log(startTime);
                    console.log(endTime);
                    console.log(date.getDay());
                    jsBookingDate.set("defaultHour", startTime);
                    jsBookingDate.set("minTime", startTime);
                    jsBookingDate.set("maxTime", endTime);
                // }
            }
        });
    });
</script>
