@if ($role === 1)
    <span class="badge bg-danger">{{ __('Administrator') }}</span>
@elseif ($role === 2)
    <span class="badge bg-warning">{{ __('Editor') }}</span>
@elseif ($role === 3)
    <span class="badge bg-info">{{ __('Author') }}</span>
@else
    <span class="badge bg-secondary">{{ __('User') }}</span>
@endif