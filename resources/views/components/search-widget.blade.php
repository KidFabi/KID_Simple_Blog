<div class="card mb-4">
    <div class="card-header">{{ __('Search') }}</div>
    <div class="card-body">
        <form class="form-inline" method="GET" action="{{ route('posts.search') }}">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="{{ __('Search for a blog post...') }}" name="search" minlength="5" required>
                <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
            </div>
        </form>
    </div>
</div>