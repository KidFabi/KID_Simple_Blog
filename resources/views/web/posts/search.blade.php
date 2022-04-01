@extends('layouts.blog')

@section('pageTitle')
    {{ __('Search Posts') }}
@endsection

@section('pageContent')
    <section class="py-5">
        <div class="container px-5">
            <h1 class="fw-bolder fs-5 mb-4">{{ __('Search results for: ') }} {{ $term ?? '' }}</h1>
            @foreach ($posts as $post)
                <div class="card border-0 mb-5 shadow rounded-3 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="row gx-0">
                            <div class="col-lg-6 col-xl-5 py-lg-5">
                                <div class="p-4 p-md-5">
                                    <div class="h2 fw-bolder">{{ $post->title }}</div>
                                    <p>{{ $post->subhead }}</p>
                                    <a class="text-decoration-none" href="{{ route('posts.show', $post->slug) }}">
                                        {{ __('Read more') }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-7">
                                <div class="bg-featured-blog">
                                    <img src="{{ $post->cover() }}" alt="{{ __('Post cover') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <nav aria-label="Pagination">
            <hr class="my-0" />
            <ul class="pagination justify-content-center my-3">
                {{ $posts->links() }}
            </ul>
        </nav>
    </section>
@endsection
