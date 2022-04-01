@extends('layouts.manager')

@section('pageTitle')
    {{ __('Posts') }}
@endsection

@section('pageContent')
    <h1 class="mt-4">{{ __('Posts') }}</h1>
    <x-breadcrumbs>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Posts') }}</li>
    </x-breadcrumbs>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <x-status-alert/>
            <div class="card">
                <div class="card-header">{{ __('Posts') }}
                    @can ('create', App\Models\Post::class)
                        <a href="{{ route('manager.posts.create') }}" class="float-end">{{ __('Create a post') }}</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Created at') }}</th>
                                <th>{{ __('Author') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Categories') }}</th>
                                <th>{{ __('Visibility') }}</th>
                                <th>{{ __('Views') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>{{ $post->author->username }}</td>
                                    <td>{{ $post->shortTitle() }}</td>
                                    <td>
                                        @foreach ($post->categories as $category)
                                            <span class="badge bg-secondary">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($post->isPublished())
                                            <span class="badge bg-success">{{ $post->visibility }}</span>
                                        @else
                                            {{ $post->visibility }}
                                        @endif
                                    </td>
                                    <td>
                                        @can ('view', $post)
                                            {{ $post->views }}
                                        @endcan
                                    </td>
                                    <td>
                                        @can ('view', $post)
                                            <a href="{{ route('manager.posts.show', $post->id) }}" class="btn btn-info" data-bs-title="tooltip" title="{{ __('Preview the post') }}"><i class="fas fa-eye"></i></a>
                                        @endcan
                                        @can ('update', $post)
                                            <a href="{{ route('manager.posts.edit', $post->id) }}" class="btn btn-warning" data-bs-title="tooltip" title="{{ __('Edit the post') }}"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can ('delete', App\Models\Post::class)
                                            <button type="button" class="btn btn-danger confirm-delete" data-bs-toggle="modal" data-bs-title="tooltip" title="{{ __('Delete the post') }}" data-bs-target="#confirm-delete-modal" data-url="{{ route('manager.posts.destroy', $post->id) }}"><i class="fas fa-trash"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <ul class="pagination pagination-rounded justify-content-center mt-3 mb-0">
                {{ $posts->links() }}
            </ul>
        </div>
    </div>
    @can ('delete', App\Models\Post::class)
        <x-modals.confirm-delete/>
    @endcan
@endsection

