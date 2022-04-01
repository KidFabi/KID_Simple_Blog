@extends('layouts.blog')

@section('pageTitle')
    {{ __('Home') }}
@endsection

@section('pageStyles')
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet"/>
@endsection

@section('pageContent')
    <header class="bg-secondary py-5">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="my-5 text-center text-xl-start">
                        <h1 class="display-5 fw-bolder text-white mb-2">{{ __('Just another simple blog') }}</h1>
                        <p class="lead fw-normal text-white-50 mb-4">{{ __('Keep your expectations low! You will not find anything fancy here.') }}</p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                            @guest
                                <a class="btn btn-primary btn-lg px-4 me-sm-3" href="{{ route('login') }}">{{ __('Log in') }}</a>
                                <a class="btn btn-outline-light btn-lg px-4" href="{{ route('register') }}">{{ __('Register an account') }}</a>
                            @endguest
                            @auth
                                <a class="btn btn-primary btn-lg px-4 me-sm-3" href="{{ route('account.show') }}">{{ __('Go to my profile') }}</a>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                    <img class="img-fluid rounded-3 my-5" src="{{ asset('images/blog.jpg') }}" alt="Blog image">
                </div>
            </div>
        </div>
    </header>
    <section class="py-5" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5 mb-lg-0"><h2 class="fw-bolder mb-0">{{ __('Simplicity is the ultimate sophistication.') }}</h2></div>
                <div class="col-lg-8">
                    <div class="row gx-5 row-cols-1 row-cols-md-2">
                        <div class="col mb-5 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-chat-fill"></i></div>
                            <h2 class="h5">Never</h2>
                            <p class="mb-0">{{ __('I wish I had an idea to put something creative here.') }}</p>
                        </div>
                        <div class="col mb-5 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-clock-fill"></i></div>
                            <h2 class="h5">Gonna</h2>
                            <p class="mb-0">{{ __('However, it is 7am and my creativity is quite low now.') }}</p>
                        </div>
                        <div class="col mb-5 mb-md-0 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-book-half"></i></div>
                            <h2 class="h5">Give You</h2>
                            <p class="mb-0">{{ __('Also, since this is only a demo project, I do not bother to think of something else.') }}</p>
                        </div>
                        <div class="col h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-emoji-sunglasses-fill"></i></div>
                            <h2 class="h5">Up</h2>
                            <p class="mb-0">{{ __('Now you probably realised, you got rick rolled.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="py-5 bg-light">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-10 col-xl-7">
                    <div class="text-center">
                        <div class="fs-4 mb-4 fst-italic">"{{ __('This is one of my firsts laravel projects created a few years ago. I decided to give it some love and have slightly updated the code.') }}"</div>
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="fw-bold">
                                Kid Fabi
                                <span class="fw-bold text-primary mx-1">/</span>
                                Developer
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="text-center">
                        <h2 class="fw-bolder">{{ __('From the blog') }}</h2>
                        <p class="lead fw-normal text-muted mb-5">{{ __('Recent posts') }}</p>
                    </div>
                </div>
            </div>
            <div class="row gx-5">
                @forelse ($posts as $post)
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top" src="{{ $post->cover() }}" alt="{{ __('Post cover') }}"/>
                            <div class="card-body p-4">
                                @foreach ($post->categories as $category)
                                    <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{ $category->name }}</div>
                                @endforeach
                                <a class="text-decoration-none link-dark stretched-link" href="{{ route('posts.show', $post->slug) }}"><h5 class="card-title mb-3">{{ $post->shortTitle() }}</h5></a>
                                <p class="card-text mb-0">{{ $post->shortSubhead() }}</p>
                            </div>
                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                <div class="d-flex align-items-end justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle me-3" height="40" width="40" src="{{ $post->author->avatar() }}" alt="{{ $post->author->username }}'s Avatar"/>
                                        <div class="small">
                                            <div class="fw-bold">{{ $post->author->username }}</div>
                                            <div class="text-muted">{{ $post->published_at }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h5 class="text-center">{{ __('No posts have been posted yet.') }}</h5>
                @endforelse
            </div>
        </div>
    </section>
@endsection

