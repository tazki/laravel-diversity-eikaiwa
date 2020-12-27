<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">{{ __('Confirm Delete') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('Are you sure you want to delete?') }}
            </div>
            <div class="modal-footer">
                <form id="deleteModalForm" method="POST">
                    {{ method_field('DELETE') }}
                    @csrf
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function () {
    $('body').on( "click", ".js-btn-delete", function() {
        $('#deleteModalForm').attr('action', $(this).data('deleteurl'));
    });
});
</script>
