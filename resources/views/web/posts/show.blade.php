@extends('layouts.blog')

@section('pageTitle')
    {{ $post->title }}
@endsection

@section('pageContent')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <x-status-alert/>
                <article>
                    <header class="mb-4">
                        <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
                        <div class="text-muted fst-italic mb-2">{{ __('Posted at') }} {{ $post->published_at }} {{ __('by') }} {{ $post->author->username }}</div>
                        @foreach ($post->categories as $category)
                            <span class="badge bg-secondary">{{ $category->name }}</span>
                        @endforeach
                    </header>
                    <figure class="mb-4"><img class="img-fluid rounded" src="{{ $post->cover() }}" alt="{{ __('Post cover') }}" /></figure>
                    <section class="mb-5">
                        <p class="fs-5 mb-4">
                            <blockquote><h5>{{ $post->subhead }}</h5></blockquote>
                        </p>
                        <hr/>
                        <p class="fs-5">
                            {!! $post->content !!}
                        </p>
                    </section>
                </article>
                <section class="mb-5">
                    <div class="card bg-light">
                        <div class="card-body">
                            @auth
                                <form class="mb-4 justify-content-end" method="POST" action="{{ route('comments.store', $post->id) }}">
                                    @csrf
                                    <textarea class="form-control @error('comment') is-invalid @enderror" rows="3" name="comment" placeholder="{{ __('Join the discussion and leave a comment!') }}" minlength="10" maxlength="2000" required>{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <x-validation-error :message="$message"/>
                                    @enderror
                                    <button type="submit" class="btn btn-primary btn-sm w-100 mt-2">{{ __('Submit') }}</button>
                                </form>
                            @endauth
                            @foreach ($post->comments as $comment)
                                <div class="row">
                                    <div class="d-flex mb-4">
                                        <div class="flex-shrink-0"><img class="rounded-circle" width="50" height="50" src="{{ $comment->user->avatar() }}" alt="{{ __('User avatar') }}"/></div>
                                        <div class="ms-3">
                                            <div class="fw-bold">{{ $comment->user->username }}
                                                <span class="text-muted p-2"><small>{{ $comment->created_at }}</small></span>
                                                @can ('update', $comment)
                                                    <a href="{{ route('comments.edit', $comment->id) }}" class="link-warning p-1">{{ __('Edit') }}</a>
                                                @endcan
                                                @can ('delete', $comment)
                                                    <a href="javascript:;" class="link-danger p-1 confirm-delete" data-bs-toggle="modal" data-bs-target="#confirm-delete-modal" data-url="{{ route('comments.destroy', $comment->id) }}">{{ __('Delete') }}</a>
                                                @endcan
                                            </div>
                                            {{ $comment->comment }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    @can ('delete', $comment)
        <x-modals.confirm-delete/>
    @endcan
@endsection
