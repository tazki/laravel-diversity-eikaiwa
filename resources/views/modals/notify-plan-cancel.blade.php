<div class="modal fade" id="planCancelModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Plan Cancellation') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('Are you sure you want to cancel your subscription?') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('Cancel') }}
                </button>
                <a href="{{ route('student_cancel_subscription') }}" class="btn btn-danger">{{ __('Cancel Subscription') }}</a>
            </div>
        </div>
    </div>
</div>
