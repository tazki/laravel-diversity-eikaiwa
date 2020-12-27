<div class="modal fade is-confirm-modal" id="deleteModalAjax" tabindex="-1" role="dialog" aria-labelledby="deleteModalAjaxLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalAjaxLabel">{{ __('Confirm Delete') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('Are you sure you want to delete?') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    {{ __('Cancel') }}
                </button>
                <button type="submit" class="js-btn-delete-submit btn btn-danger" data-dismiss="modal" onClick="ajaxDelete(this); return false;">{{ __('Delete') }}</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function () {
    $('body').on( "click", ".js-btn-delete", function() {
        $('.js-btn-delete-submit').attr('data-deleteurl', $(this).data('deleteurl'));

        if($(this).data('ajaxtemplatetarget') != undefined) {
            $('.js-btn-delete-submit').attr('data-target', $(this).data('ajaxtemplatetarget'));
            $('.js-btn-delete-submit').attr('data-url', $(this).data('ajaxtemplateurl'));
        }
    });
});
</script>
