@extends('layouts.blog')

@section('pageTitle')
    {{ __('Posts') }}
@endsection

@section('pageContent')
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">{{ __('Welcome to the Blog!') }}</h1>
                <p class="lead mb-0">{{ __('Here you can find all published blog posts.') }}</p>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="mb-5">
                    <x-search-widget/>
                </div>
                @foreach ($posts as $post)
                    <div class="card mb-5">
                        <a href="{{ route('posts.show', $post->slug) }}">
                            <img class="card-img-top" src="{{ $post->cover() }}" alt="{{ __('Post cover') }}"/>
                        </a>
                        <div class="card-body">
                            <div class="small text-muted">{{ $post->published_at }}</div>
                            <h2 class="card-title">{{ $post->title }}</h2>
                            <p class="card-text">{{ $post->subhead }}</p>
                            <a class="btn btn-primary" href="{{ route('posts.show', $post->slug) }}">{{ __('Read more') }} →</a>
                        </div>
                    </div>
                @endforeach
                <nav aria-label="Pagination">
                    <hr class="my-0" />
                    <ul class="pagination justify-content-center my-4">
                        {{ $posts->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
