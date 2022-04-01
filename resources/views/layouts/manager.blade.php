@extends('layouts.head', ['bodyClass' => 'sb-nav-fixed'])

@section('title')
    @yield('pageTitle') - Manager
@endsection

@section('styles')
    <link href="{{ asset('css/manager.css') }}" rel="stylesheet">
    @yield('pageStyles')
@endsection

@section('content')
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="{{ route('manager.dashboard') }}">{{ config('app.name', 'KID Simple Blog') }}</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="javascript::void();"><i class="fas fa-bars"></i></button>
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="javascript::void();" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('home') }}">{{ __('Homepage') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('account.show') }}">{{ __('My Account') }}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">{{ __('Navigation') }}</div>
                        <a class="nav-link" href="{{ route('manager.dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            {{ __('Dashboard') }}
                        </a>
                        @can ('viewAny', App\Models\User::class)
                            <a class="nav-link" href="{{ route('manager.users.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                {{ __('Users') }}
                            </a>
                        @endcan
                        @can ('viewAny', App\Models\Post::class)
                            <a class="nav-link" href="{{ route('manager.posts.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                {{ __('Posts') }}
                            </a>
                        @endcan
                        @can ('viewAny', App\Models\Comment::class)
                            <a class="nav-link" href="{{ route('manager.comments.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-comments"></i></div>
                                {{ __('Comments') }}
                            </a>
                        @endcan
                        @can ('viewAny', App\Models\Category::class)
                            <a class="nav-link" href="{{ route('manager.categories.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                                {{ __('Categories') }}
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">{{ __('Logged in as:') }}</div>
                    {{ Auth::user()->username }}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content" class="bg-white">
            <main>
                <div class="container-fluid px-4">
                    @yield('pageContent')
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto manager-footer">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">{{ __('Copyright') }} &copy; {{ date('Y') }} {{ config('app.name', 'KID Simple Blog') }}</div>
                        <div>
                            <a href="{{ route('privacy_policy') }}">{{ __('Privacy policy') }}</a>
                            &middot;
                            <a href="{{ route('terms_of_service') }}">{{ __('Terms of service') }}</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ mix('js/manager.js') }}"></script>
    @yield('pageScripts')
@endsection
