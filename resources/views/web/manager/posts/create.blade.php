@extends('layouts.manager')

@section('pageTitle')
    {{ __('Create Post') }}
@endsection

@section('pageContent')
    <h1 class="mt-4">{{ __('Create a post') }}</h1>
    <x-breadcrumbs>
        <li class="breadcrumb-item"><a href="{{ route('manager.posts.index') }}">{{ __('Posts') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Create a post') }}</li>
    </x-breadcrumbs>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-status-alert/>
            <div class="card">
                <div class="card-header">{{ __('Post Creator') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('manager.posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <x-forms.post :categories="$categories"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pageScripts')
    <x-tinymce-config/>
@endsection
