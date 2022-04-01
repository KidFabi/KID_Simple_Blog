@extends('layouts.head')

@section('title')
    @yield('pageTitle')
@endsection

@section('styles')
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
    @yield('pageStyles')
@endsection

@section('content')
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'KID Simple Blog') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('Homepage') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('posts.index') }}">{{ __('Posts') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index') }}">{{ __('Categories') }}</a>
                        </li>
                        &nbsp;&nbsp;&nbsp;
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            &nbsp;&nbsp;&nbsp;
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-outline-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('account.show') }}">{{ __('My Account') }}</a>
                                    <a class="dropdown-item" href="{{ route('manager.dashboard') }}">{{ __('Manager Dashboard') }}</a>
                                    <a class="dropdown-item text-danger" id="logout-button" href="{{ route('logout') }}">{{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            @yield('pageContent')
        </main>
    </div>
    <footer class="bg-dark py-4 mt-auto mb-0 footer">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto"><div class="small m-0 text-white">{{ __('Copyright') }} &copy; {{ date('Y') }} {{ config('app.name', 'KID Simple Blog') }}</div></div>
                <div class="col-auto">
                    <a class="link-light small" href="{{ route('privacy_policy') }}">{{ __('Privacy policy') }}</a>
                    <span class="text-white mx-1">&middot;</span>
                    <a class="link-light small" href="{{ route('terms_of_service') }}">{{ __('Terms of service') }}</a>
                </div>
            </div>
        </div>
    </footer>
    @yield('pageScripts')
@endsection
