@extends('layouts.manager')

@section('pageTitle')
    {{ __('Dashboard') }}
@endsection

@section('pageContent')
    <h1 class="mt-4">{{ __('Dashboard') }}</h1>
    <x-breadcrumbs/>
    @can ('see-dashboard-statistics')
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{ $statistics['totalPosts'] }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <span class="small text-white">{{ __('Published Posts') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">{{ $statistics['totalViews'] }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <span class="small text-white">{{ __('Posts Views') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">{{ $statistics['totalComments'] }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <span class="small text-white">{{ __('Comments') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">{{ $statistics['totalUsers'] }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <span class="small text-white">{{ __('Registered Users') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        {{ __('Most viewed posts') }}
                    </div>
                    <div class="card-body">
                        <div class="row gx-5 justify-content-center">
                            @foreach ($statistics['topPosts'] as $post)
                                <div class="col-lg-4">
                                    <div class="card mb-5 mb-xl-0">
                                        <div class="card-body p-4">
                                            <a class="text-decoration-none link-dark stretched-link" href="{{ route('posts.show', $post->slug) }}" target="_blank" rel="noopener noreferrer"><h5 class="card-title mb-3">{{ $post->shortTitle() }}</h5></a>
                                            <p class="card-text mb-0">{{ $post->shortSubhead() }}</p>
                                            <h5 class="text-center">
                                                <div class="badge bg-primary bg-gradient rounded-pill mt-4">
                                                    {{ $post->views }} {{ __('Views') }}
                                                </div>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        {{ __('Top Authors') }}
                    </div>
                    <div class="card-body">
                        <div class="row gx-5 justify-content-center">
                            @foreach ($statistics['topUsers'] as $user)
                                <div class="col-lg-4">
                                    <div class="card mb-5 mb-xl-0">
                                        <div class="card-body p-5">
                                            <div class="mb-3 text-center">
                                                <span class="display-6 fw-bold">
                                                    @if ($loop->first)
                                                        <i class="fas fa-star" style="color:#FFD700"></i>1
                                                    @elseif ($loop->iteration === 2)
                                                        <span class="display-6 fw-bold"><i class="fas fa-star" style="color:#C0C0C0"></i>2
                                                    @elseif ($loop->last)
                                                        <i class="fas fa-star" style="color:#B08D57"></i>3
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="text-center">
                                                <h3>{{ $user->username }}</h3>
                                                <h5><b>{{ $user->posts_count }}</b> {{ __('Posts') }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-book me-1"></i>
                        {{ __('Latest published posts') }}
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Short Title') }}</th>
                                <th scope="col">{{ __('Posted By') }}</th>
                                <th scope="col">{{ __('Posted At') }}</th>
                                <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statistics['latestPosts'] as $post)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $post->shortTitle() }}</td>
                                        <td>{{ $post->author->username }}</td>
                                        <td>{{ $post->published_at }}</td>
                                        <td><a href="{{ route('posts.show', $post->slug) }}" class="btn btn-info" data-bs-title="tooltip" title="{{ __('Check the post') }}" target="_blank" rel="noopener noreferrer"><i class="fas fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-users me-1"></i>
                        {{ __('Recently joined users') }}
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Username') }}</th>
                                <th scope="col">{{ __('Joined at') }}</th>
                                <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statistics['latestUsers'] as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td><a href="{{ route('manager.users.show', $user->id) }}" class="btn btn-info" data-bs-title="tooltip" title="{{ __('Show the user') }}" target="_blank" rel="noopener noreferrer"><i class="fas fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
                    <div class="m-4 m-lg-5">
                        <h1 class="display-5 fw-bold">{{ __('Welcome') }} {{ Auth::user()->username }}!</h1>
                        <p class="fs-4">{{ __('Since you are an author, you have access to the post manager, where you can review all of your blog posts as well as create new ones.') }}</p>
                        <a class="btn btn-primary btn-lg" href="{{ route('manager.posts.index') }}">{{ __('Go to posts') }}</a>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
