@extends('layouts.blog')

@section('pageTitle')
    {{ __('Register') }}
@endsection

@section('pageContent')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" maxlength="190" value="{{ old('email') }}" required autofocus>
                                    @error('email')
                                        <x-validation-error :message="$message"/>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" minlength="8" required>
                                    @error('password')
                                        <x-validation-error :message="$message"/>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" minlength="3" maxlength="60" value="{{ old('username') }}" required>
                                    @error('username')
                                        <x-validation-error :message="$message"/>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control text-capitalize @error('first_name') is-invalid @enderror" name="first_name" minlength="2" maxlength="190" value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                        <x-validation-error :message="$message"/>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control text-capitalize @error('last_name') is-invalid @enderror" name="last_name" minlength="2" maxlength="190" value="{{ old('last_name') }}" required>
                                    @error('last_name')
                                        <x-validation-error :message="$message"/>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="birth_date" class="col-md-4 col-form-label text-md-right">{{ __('Date Of Birth') }}</label>
                                <div class="col-md-6">
                                    <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" max="2015-12-31" value="{{ old('birth_date') }}" required>
                                    @error('birth_date')
                                        <x-validation-error :message="$message"/>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
