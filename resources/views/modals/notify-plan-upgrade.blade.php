<div class="modal fade" id="planUpgradeModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Plan Upgrade') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('Are you sure you want to upgrade plan?') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('Cancel') }}
                </button>
                <a href="{{ route('student_plan_upgrade', ['service_id' => 4]) }}" class="btn btn-primary">{{ __('Summer plan') }}</a>
                {{-- <a href="{{ route('student_plan_upgrade', ['service_id' => 2]) }}" class="btn btn-primary">{{ __('Plan A') }}</a> --}}
                <a href="{{ route('student_plan_upgrade', ['service_id' => 3]) }}" class="btn btn-primary">{{ __('Plan B') }}</a>
            </div>
        </div>
    </div>
</div>
