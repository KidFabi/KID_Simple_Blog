<div class="modal fade delete-account" id="delete-account-modal" tabindex="-1" role="dialog" aria-labelledby="DeleteAccountLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="DeleteAccountLabel">{{ __('Confirm Deletion') }}</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('account.destroy') }}">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          {{ __('Are u sure, you want to delete your account? The action cannot be reverted.') }}
          <div class="my-3">
            <label for="current_password">{{ __('As a confirmation, type in your current password') }}</label>
            <input class="form-control @error('current_password') is-invalid @enderror" type="password" id="current_password" name="current_password" placeholder="{{ __('Your current password') }}" required>
            @error('current_password')
              <x-validation-error :message="$message"/>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
          <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
        </div>
      </form>
    </div>
  </div>
</div>