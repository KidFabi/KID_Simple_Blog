@extends('layouts.manager')

@section('pageTitle')
    {{ __('Comments') }}
@endsection

@section('pageContent')
    <h1 class="mt-4">{{ __('Comments') }}</h1>
    <x-breadcrumbs>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Comments') }}</li>
    </x-breadcrumbs>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <x-status-alert/>
            <div class="card">
                <div class="card-header">{{ __('Comments') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Post') }}</th>
                                <th>{{ __('Comment') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>{{ $comment->created_at }}</td>
                                    <td>{{ $comment->user->username }}</td>
                                    <td><a href="{{ route('manager.posts.show', $comment->post_id) }}" target="_blank" rel="noopener noreferrer">{{ $comment->post_id }}</a></td>
                                    <td>{{ $comment->comment }}</td>
                                    <td>
                                        @can ('delete', $comment)
                                            <a href="javascript:;" class="btn btn-danger confirm-delete" data-bs-toggle="modal" data-bs-target="#confirm-delete-modal" data-url="{{ route('comments.destroy', $comment->id) }}">{{ __('Delete') }}</a>
                                            <x-modals.confirm-delete/>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <ul class="pagination pagination-rounded justify-content-center mt-3 mb-0">
                {{ $comments->links() }}
            </ul>
        </div>
    </div>
@endsection

