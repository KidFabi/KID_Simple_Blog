@extends('layouts.manager')

@section('pageTitle')
    {{ __('Posts') }} - {{ $post->id }}
@endsection

@section('pageContent')
    <h1 class="mt-4">{{ __('Preview Post') }} - {{ $post->id }}</h1>
    <x-breadcrumbs>
        <li class="breadcrumb-item"><a href="{{ route('manager.posts.index') }}">{{ __('Posts') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Preview Post') }} #{{ $post->id }}</li>
    </x-breadcrumbs>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <x-status-alert/>
                <article>
                    <header class="mb-4">
                        <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
                        <div class="text-muted fst-italic mb-2">{{ __('Created on') }} {{ $post->created_at }} {{ __('by') }} {{ $post->author->username }}</div>
                        @foreach ($post->categories as $category)
                            <span class="badge bg-secondary">{{ $category->name }}</span>
                        @endforeach
                    </header>
                    <figure class="mb-4"><img class="img-fluid rounded" src="{{ $post->cover() }}" alt="{{ __('Post cover') }}"/></figure>
                    <section class="mb-5 mt-5">
                        <p class="fs-5 mb-4">
                            <blockquote>{{ $post->subhead }}</blockquote>
                        </p>
                        <hr>
                        <p class="fs-5 mb-4">
                            {!! $post->content !!}
                        </p>
                    </section>
                </article>
            </div>
            <hr/>
            @can ('publishReject', $post)
                <form method="POST" action="{{ route('manager.posts.publish', $post->id) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success w-100">{{ __('Publish Post') }}</button>
                </form>
                <form method="POST" action="{{ route('manager.posts.reject', $post->id) }}" class="mt-2">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger w-100">{{ __('Reject Post') }}</button>
                </form>
            @endcan
        </div>
    </div>
@endsection
