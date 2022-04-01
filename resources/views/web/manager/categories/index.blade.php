@extends('layouts.manager')

@section('pageTitle')
    {{ __('Categories') }}
@endsection

@section('pageContent')
    <h1 class="mt-4">{{ __('Categories') }}</h1>
    <x-breadcrumbs>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Categories') }}</li>
    </x-breadcrumbs>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-status-alert/>
            <div class="card">
                <div class="card-header">{{ __('Categories') }}
                    @can ('create', App\Models\Category::class)
                        <a href="{{ route('manager.categories.create') }}" class="float-end">{{ __('Create a category') }}</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Number of posts') }}</th>
                                <th>{{ __('Created at') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->posts_count }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>
                                        @can ('update', App\Models\Category::class)
                                            <a href="{{ route('manager.categories.edit', $category->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can ('delete', App\Models\Category::class)
                                            <button type="button" class="btn btn-danger confirm-delete" data-bs-toggle="modal" data-bs-target="#confirm-delete-modal" data-url="{{ route('manager.categories.destroy', $category->id) }}"><i class="fas fa-trash-alt"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <ul class="pagination pagination-rounded justify-content-center mt-3 mb-0">
                {{ $categories->links() }}
            </ul>
        </div>
    </div>
    @can ('delete', App\Models\Category::class)
        <x-modals.confirm-delete/>
    @endcan
@endsection

