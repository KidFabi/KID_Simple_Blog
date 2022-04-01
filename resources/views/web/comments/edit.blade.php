@extends('layouts.blog')

@section('pageTitle')
    {{ __('Edit Comment - ') }} {{ $comment->id }}
@endsection

@section('pageContent')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <x-status-alert/>
                <section class="mb-5">
                    <div class="card bg-light">
                        <div class="card-body">
                            <form class="mb-4 justify-content-end" method="POST" action="{{ route('comments.update', $comment->id) }}">
                                @csrf
                                @method('PATCH')
                                <textarea class="form-control @error('comment') is-invalid @enderror" rows="3" name="comment" placeholder="{{ __('Join the discussion and leave a comment!') }}" minlength="10" maxlength="2000" required>{{ old('comment', $comment->comment) }}</textarea>
                                @error('comment')
                                    <x-validation-error :message="$message"/>
                                @enderror
                                <button type="submit" class="btn btn-primary btn-sm w-100 mt-2">{{ __('Submit') }}</button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
