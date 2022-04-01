@extends('layouts.manager')

@section('pageTitle')
    {{ __('Create Category') }}
@endsection

@section('pageContent')
    <h1 class="mt-4">{{ __('Create a category') }}</h1>
    <x-breadcrumbs>
        <li class="breadcrumb-item"><a href="{{ route('manager.categories.index') }}">{{ __('Categories') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Create a category') }}</li>
    </x-breadcrumbs>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-status-alert/>
            <div class="card">
                <div class="card-header">{{ __('Category Creator') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('manager.categories.store') }}">
                        @csrf
                        <x-forms.category/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
