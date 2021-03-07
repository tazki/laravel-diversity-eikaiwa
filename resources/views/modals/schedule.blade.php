<div class="modal fade" id="studentScheduleFormModal" tabindex="-1" role="dialog" aria-labelledby="studentScheduleFormModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="studentScheduleFormModalLabel" class="modal-title text-center w-100">{{ __('Create Task') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('student_schedule_add') }}" class="auth-form shadow-none p-0">
                    @csrf
                    <div class="form-group">
                        <label for="task-assign">{{ __('Teacher') }}</label>
                        <select name="teacher_id" class="js-task-assign custom-select form-control" id="task-assign">
                            <option value=""></option>
                            {{-- @if(isset($rows['client_rows']))
                                @foreach($rows['client_rows'] as $client)
                                    <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                                @endforeach
                            @endif --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="task-due-date">{{ __('Booking Date') }}</label>
                        <input type="text" name="booking_date" id="js-client-task-due-date" class="js-input-flatpickr form-control" placeholder="Select Date">
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
<script>
	    $("#js-client-task-due-date").flatpickr({
        disableMobile: "true",
        altInput: true,
        altFormat: "F j, Y",
				dateFormat: "Y-m-d",
				minDate: "today"
    });
    $(".js-task-assign").select2({
        width: '100%',
        placeholder: "{{ __('Select') }}",
    });
</script>
