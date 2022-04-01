@extends('layouts.manager')

@section('pageTitle')
    {{ __('Edit Category')  }} - {{ $category->id }}
@endsection

@section('pageContent')
    <h1 class="mt-4">{{ __('Edit Category')  }} - {{ $category->id }}</h1>
    <x-breadcrumbs>
        <li class="breadcrumb-item"><a href="{{ route('manager.categories.index') }}">{{ __('Categories') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Category')  }} #{{ $category->id }}</li>
    </x-breadcrumbs>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-status-alert/>
            <div class="card">
                <div class="card-header">{{ __('Category Editor') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('manager.categories.update', $category->id) }}">
                        @csrf
                        @method('PATCH')
                        <x-forms.category :category="$category"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
