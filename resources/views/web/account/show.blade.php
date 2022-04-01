@extends('layouts.blog')

@section('pageTitle')
    {{ __('My Account') }}
@endsection

@section('pageStyles')
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet"/>
@endsection

@section('pageContent')
<div class="container py-5">
    <div class="row flex-lg-nowrap justify-content-center">
        <div class="col-lg-8">
            <div class="row">
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="e-profile">
                                <div class="row">
                                    <div class="col-12 col-sm-auto mb-3">
                                        <div class="mx-auto" style="width: 140px;">
                                            <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                                                <img width="140" height="140" src="{{ $user->avatar() }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                        <div class="text-center text-sm-left mb-2 mb-sm-0">
                                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ $user->first_name }} {{ $user->last_name }}</h4>
                                            <p class="mb-0">{{ $user->username }}</p>
                                        </div>
                                        <div class="text-center text-sm-right">
                                            <x-user-role :role="$user->role"/>
                                            <div class="text-muted"><small>{{ __('Joined') }} {{ $user->created_at }}</small></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <x-status-alert/>
                                </div>
                                <ul class="nav nav-tabs mt-3">
                                    <li class="nav-item"><a href="#profile" data-bs-toggle="tab" class="active nav-link">{{ __('Profile') }}</a></li>
                                    <li class="nav-item"><a href="#notifications" data-bs-toggle="tab" class="nav-link">{{ __('Notifications') }}</a></li>
                                    <li class="nav-item"><a href="#password" data-bs-toggle="tab" class="nav-link">{{ __('Password') }}</a></li>
                                    <li class="nav-item"><a href="#data" data-bs-toggle="tab" class="nav-link">{{ __('Data') }}</a></li>
                                </ul>
                                <div class="tab-content pt-3">
                                    <div class="tab-pane active" id="profile">
                                        <form method="POST" action="{{ route('account.update') }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-2 text-center"><b>{{ __('Edit your profile') }}</b></div>
                                                    <div class="row mt-3">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="username">{{ __('Username') }}</label>
                                                                <input class="form-control @error('username') is-invalid @enderror" id="username" name="username" type="text" value="{{ old('username', $user->username) }}" placeholder="{{ __('Your username') }}" minlength="3" maxlength="60" required>
                                                                @error('username')
                                                                    <x-validation-error :message="$message"/>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="first_name">{{ __('First Name') }}</label>
                                                                <input class="form-control  @error('first_name') is-invalid @enderror text-capitalize" type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" placeholder="{{ __('Your first name') }}" minlength="2" maxlength="50" required>
                                                                @error('first_name')
                                                                    <x-validation-error :message="$message"/>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="last_name">{{ __('Last Name') }}</label>
                                                                <input class="form-control @error('last_name') is-invalid @enderror text-capitalize" type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" placeholder="{{ __('Your last name') }}" minlength="2" maxlength="50" required>
                                                                @error('last_name')
                                                                <x-validation-error :message="$message"/>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="email">{{ __('E-Mail Address') }}</label>
                                                                <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="{{ __('Your email address') }}" maxlength="190" required>
                                                                @error('email')
                                                                    <x-validation-error :message="$message"/>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="birth_date">{{ __('Date Of Birth') }}</label>
                                                                <input class="form-control @error('birth_date') is-invalid @enderror" type="date" id="birth_date" name="birth_date" max="2015-12-31" value="{{ old('birth_date', $user->birth_date) }}" required>
                                                                @error('birth_date')
                                                                    <x-validation-error :message="$message"/>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="avatar" class="form-label">{{ __('Profile Picture') }}</label>
                                                                <input class="form-control @error('avatar') is-invalid @enderror" type="file" name="avatar" id="avatar">
                                                                @error('avatar')
                                                                    <x-validation-error :message="$message"/>
                                                                @enderror
                                                                <x-image-requirements size="140x140"/>
                                                            </div>
                                                            <input type="checkbox" class="custom-control-input mt-2" id="delete_avatar" name="delete_avatar" value="1">
                                                            <label class="custom-control-label" for="delete_avatar">{{ __('Delete current profile picture') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col d-flex justify-content-end">
                                                    <button class="btn btn-primary" type="submit">{{ __('Save Changes') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="notifications">
                                        <form method="POST" action="{{ route('account.update') }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-2 text-center"><b>{{ __('Notifications') }}</b></div>
                                                    <div class="row mt-3">
                                                        <div class="col">
                                                            <div class="custom-controls-stacked px-2">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="hidden" name="notifications" value="0">
                                                                    <input type="checkbox" class="custom-control-input @error('notifications') is-invalid @enderror" id="notifications" name="notifications" value="1" {{ old('notifications', $user->notifications) > 0 ? 'checked' : '' }}>
                                                                    <label class="custom-control-label" for="notifications">{{ __('New blog posts') }}</label>
                                                                    @error('notifications')
                                                                        <x-validation-error :message="$message"/>
                                                                    @enderror
                                                                    <p><small class="text-muted">{{ __('Send me an email whenever a new post gets published.') }}</small></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col d-flex justify-content-end">
                                                    <button class="btn btn-primary" type="submit">{{ __('Save Changes') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="password">
                                        <form method="POST" action="{{ route('account.update') }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-2 text-center"><b>{{ __('Change Password') }}</b></div>
                                                    <div class="row mt-3">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="current_password">{{ __('Current Password') }}</label>
                                                                <input class="form-control @error('current_password') is-invalid @enderror" type="password" id="current_password" name="current_password" placeholder="{{ __('Your current password') }}" required>
                                                                @error('current_password')
                                                                    <x-validation-error :message="$message"/>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="password">{{ __('New Password') }}</label>
                                                                <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" placeholder="{{ __('Your new password') }}" required>
                                                                @error('password')
                                                                    <x-validation-error :message="$message"/>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                                                                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="{{ __('Confirm new password') }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col d-flex justify-content-end">
                                                    <button class="btn btn-primary" type="submit">{{ __('Save Changes') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="data">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-2 text-center"><b>{{ __('Your data & account deletion') }}</b></div>
                                                <div class="row mt-3 text-center">
                                                    <div class="col">
                                                        <a class="btn btn-warning" href="{{ route('account.data') }}">{{ __('Download a copy of your data') }}</a>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-account-modal">{{ __('Delete your account') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-modals.delete-account/>
@endsection
