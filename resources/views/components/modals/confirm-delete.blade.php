<div class="modal fade confirm-delete" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteLabel">{{ __('Confirm Deletion') }}</h5>
        <button type="button" class="close remove-data-from-delete-form" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ __('Are u sure, you want to remove this item? The action cannot be reverted.') }}
      </div>
      <div class="modal-footer">
        <form method="POST" action="" class="confirm-delete-modal-form">
          @csrf
          @method('DELETE')
          <button type="button" class="btn btn-secondary remove-data-from-delete-form" data-bs-dismiss="modal">{{ __('Close') }}</button>
          <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
        </form>
      </div>
    </div>
  </div>
</div>