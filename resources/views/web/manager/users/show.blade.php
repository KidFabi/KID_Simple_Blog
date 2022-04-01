@extends('layouts.manager')

@section('pageTitle')
   {{ $user->username }}
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
                                <div class="mt-3 text-center">
                                    <h3>{{ __('Account of ') }} <b>{{ $user->username }}</b></h3>
                                </div>
                                <x-status-alert/>
                                <ul class="nav nav-tabs mt-4">
                                    <li class="nav-item"><a href="#account" data-bs-toggle="tab" class="active nav-link">{{ __('Account') }}</a></li>
                                    <li class="nav-item"><a href="#comments" data-bs-toggle="tab" class="nav-link">{{ __('Comments') }}</a></li>
                                    <li class="nav-item"><a href="#posts" data-bs-toggle="tab" class="nav-link">{{ __('Posts') }}</a></li>
                                </ul>
                                <div class="tab-content pt-3">
                                    <div class="tab-pane active" id="account">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-2 text-center"><b>{{ __('Account summary ') }}</b></div>
                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <h5>{{ __('Username') }}</h5>
                                                        <span>{{ $user->username }}</span>
                                                    </div>
                                                    <div class="col">
                                                        <h5>{{ __('Joined At') }}</h5>
                                                        <span>{{ $user->created_at }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <h5>{{ __('Role') }}</h5>
                                                        <span><x-user-role :role="$user->role"/></span>
                                                    </div>
                                                    <div class="col">
                                                        <h5>{{ __('Avatar') }}</h5>
                                                        <a href="{{ $user->avatar() }}" target="_blank" rel="noopener noreferrer">
                                                            <img width="50" height="50" src="{{ $user->avatar() }}" alt="{{ __('Avatar') }}">
                                                        </a>
                                                    </div>
                                                </div>
                                                @can ('viewSensitiveData', $user)
                                                    <div class="row mt-4">
                                                        <div class="col">
                                                            <h5>{{ __('First Name') }}</h5>
                                                            <span>{{ $user->first_name }}</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5>{{ __('Last Name') }}</h5>
                                                            <span>{{ $user->last_name }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col">
                                                            <h5>{{ __('E-Mail Address') }}</h5>
                                                            <span>{{ $user->email }}</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5>{{ __('Date Of Birth') }}</h5>
                                                            <span>{{ $user->birth_date }}</span>
                                                        </div>
                                                    </div>
                                                @endcan
                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <h5>{{ __('Notifications') }}</h5>
                                                        @if ($user->notifications)
                                                            <span class="badge bg-success">{{ __('Enabled') }}</span>
                                                        @else
                                                            <span class="badge bg-danger">{{ __('Disabled') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col">
                                                        <h5>{{ __('Posting Comments') }}</h5>
                                                        @if ($user->post_comments)
                                                            <span class="badge bg-success">{{ __('Enabled') }}</span>
                                                        @else
                                                            <span class="badge bg-danger">{{ __('Disabled') }}</span>
                                                        @endif
                                                        @can ('disableEnableComments', App\Models\User::class)
                                                            <form action="{{ route('manager.users.post_comments', $user->id) }}" method="POST" class="mt-2">
                                                                @csrf
                                                                @method('PATCH')
                                                                @if ($user->post_comments)
                                                                    <button type="submit" class="btn btn-sm btn-warning">{{ __('Disable') }}</button>
                                                                @else
                                                                    <button type="submit" class="btn btn-sm btn-info">{{ __('Enable') }}</button>
                                                                @endif
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </div>
                                                @can ('update', $user)
                                                    <div class="row mt-4">
                                                        <div class="col d-flex justify-content-center">
                                                            <a href="{{ route('manager.users.edit', $user->id) }}" class="btn btn-primary">{{ __('Edit User') }}</a>
                                                        </div>
                                                    </div>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                    @can ('viewAny', App\Models\Comment::class)
                                        <div class="tab-pane" id="comments">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-2 text-center"><b>{{ __('Comments') }}</b></div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>{{ __('Commented At') }}</th>
                                                                        <th>{{ __('Post') }}</th>
                                                                        <th>{{ __('Comment') }}</th>
                                                                        <th>{{ __('Action') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($user->comments as $comment)
                                                                        <tr>
                                                                            <td>{{ $comment->created_at }}</td>
                                                                            <td><a href="{{ route('manager.posts.show', $comment->post_id) }}" target="_blank" rel="noopener noreferrer">{{ $comment->post_id }}</a></td>
                                                                            <td>{{ $comment->comment }}</td>
                                                                            <td>
                                                                                @can ('hideShow', App\Models\Comment::class)
                                                                                    <form action="{{ route('manager.comments.visibility', $comment->id) }}" method="POST">
                                                                                        @csrf
                                                                                        @method('PATCH')
                                                                                        @if ($comment->is_hidden)
                                                                                            <button type="submit" class="btn btn-success" data-bs-title="tooltip" title="{{ __('Show comment') }}"><i class="fas fa-eye"></i></button>
                                                                                        @else
                                                                                            <button type="submit" class="btn btn-danger" data-bs-title="tooltip" title="{{ __('Hide comment') }}"><i class="fas fa-eye-slash"></i></button>
                                                                                        @endif
                                                                                    </form>
                                                                                @endcan
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
                                    @can ('viewAny', App\Models\Post::class)
                                        <div class="tab-pane" id="posts">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-2 text-center"><b>{{ __('Posts') }}</b></div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>{{ __('Created At') }}</th>
                                                                        <th>{{ __('Short Title') }}</th>
                                                                        <th>{{ __('Visibility') }}</th>
                                                                        <th>{{ __('Action') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($user->posts as $post)
                                                                        <tr>
                                                                            <td>{{ $post->created_at }}</td>
                                                                            <td>{{ $post->shortTitle() }}</td>
                                                                            <td>{{ $post->visibility }}</td>
                                                                            <td>
                                                                                @can ('view', $post)
                                                                                    <a href="{{ route('manager.posts.show', $post->id) }}" class="btn btn-info" data-bs-title="tooltip" title="{{ __('Show post') }}"><i class="fas fa-eye"></i></a>
                                                                                @endcan
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
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
