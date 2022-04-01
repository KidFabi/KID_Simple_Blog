@extends('layouts.manager')

@section('pageTitle')
    {{ __('Edit User') }} - {{ $user->id }}
@endsection

@section('pageContent')
    <h1 class="mt-4">{{ __('Edit User') }} - {{ $user->id }}</h1>
    <x-breadcrumbs>
        <li class="breadcrumb-item"><a href="{{ route('manager.users.index') }}">{{ __('Users') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Edit User') }} #{{ $user->id }}</li>
    </x-breadcrumbs>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-status-alert/>
            <div class="card">
                <div class="card-header">{{ __('User Editor') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('manager.users.update', $user->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group mb-4">
                            <label for="username">{{ __('Username') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}" placeholder="{{ __('Username') }}" minlength="3" maxlength="60" required>
                            @error ('username')
                                <x-validation-error :message="$message"/>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="first_name">{{ __('First Name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" placeholder="{{ __('First Name') }}" minlength="2" maxlength="50" required>
                            @error ('first_name')
                                <x-validation-error :message="$message"/>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="last_name">{{ __('Last Name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" placeholder="{{ __('Last Name') }}" minlength="2" maxlength="50" required>
                            @error ('last_name')
                                <x-validation-error :message="$message"/>
                            @enderror
                        </div>
                        @if ($user->avatar !== 'default.png')
                            <div class="form-group mb-4">
                                <a href="{{ $user->avatar() }}" class="text-decoration-none" target="_blank" rel="noopener noreferrer">
                                    <img width="50" height="50" src="{{ $user->avatar() }}" alt="{{ __('Avatar') }}">
                                </a>
                                <br/>
                                <input type="checkbox" class="custom-control-input mt-2" id="delete_avatar" name="delete_avatar" value="1">
                                <label class="custom-control-label" for="delete_avatar">{{ __('Delete current profile picture') }}</label>
                            </div>
                        @endif
                        <div class="form-group mb-4">
                            <label for="role">{{ __('Role') }} <span class="text-danger">*</span></label>
                            <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" required>
                                <option value="1" @if (old ('role', $user->role) === 1) selected @endif>{{ __('Administrator') }}</option>
                                <option value="2" @if (old ('role', $user->role) === 2) selected @endif>{{ __('Editor') }}</option>
                                <option value="3" @if (old ('role', $user->role) === 3) selected @endif>{{ __('Author') }}</option>
                                <option value="4" @if (old ('role', $user->role) === 4) selected @endif>{{ __('User') }}</option>
                            </select>
                            @error ('role')
                                <x-validation-error :message="$message"/>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-3">{{ __('Update User') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection