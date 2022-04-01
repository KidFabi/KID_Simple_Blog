@extends('layouts.manager')

@section('pageTitle')
    {{ __('Edit Post') }} - {{ $post->id }}
@endsection

@section('pageContent')
    <h1 class="mt-4">{{ __('Edit Post') }} - {{ $post->id }}</h1>
    <x-breadcrumbs>
        <li class="breadcrumb-item"><a href="{{ route('manager.posts.index') }}">{{ __('Posts') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Post') }} #{{ $post->id }}</li>
    </x-breadcrumbs>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-status-alert/>
            <div class="card">
                <div class="card-header">{{ __('Post Editor') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('manager.posts.update', $post->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <x-forms.post :post="$post" :categories="$categories"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pageScripts')
    <x-tinymce-config/>
@endsection
