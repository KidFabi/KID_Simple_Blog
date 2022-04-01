@extends('layouts.blog')

@section('pageTitle')
    {{ __('Categories') }}
@endsection

@section('pageContent')
<section class="py-5">
    <div class="container px-5 my-5">
        <div class="text-center mb-5">
            <h1 class="fw-bolder">{{ __('Categories') }}</h1>
            <p class="lead fw-normal text-muted mb-0">{{ __('The list of all available categories.') }}</p>
        </div>
        <div class="row gx-5">
            <div class="col-xl-12">
                @foreach ($categories as $category)
                    <h2 class="fw-bolder mb-3">{{ $category->name }}</h2>
                    @foreach ($category->posts as $post)
                        <div class="accordion mb-3" id="accordion">
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="heading{{ $post->id }}"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $post->id }}" aria-expanded="true" aria-controls="collapse{{ $post->id }}">{{ $post->title }}</button></h3>
                                <div class="accordion-collapse collapse" id="collapse{{ $post->id }}" aria-labelledby="heading{{ $post->id }}" data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        {{ $post->subhead }}
                                        <a class="text-decoration-none" href="{{ route('posts.show', $post->id) }}">
                                            {{ __('Read more') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
        <nav aria-label="Pagination">
            <hr class="my-0" />
            <ul class="pagination justify-content-center my-3">
                {{ $categories->links() }}
            </ul>
        </nav>
    </div>
</section>
@endsection
