<div class="form-group mb-4">
    <label for="title">{{ __('Title') }} <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title ?? '') }}" placeholder="{{ __('Title of the blog post') }}" minlength="10" maxlength="70" required>
    @error ('title')
        <x-validation-error :message="$message"/>
    @enderror
</div>
<div class="form-group mb-4">
    <label for="subhead">{{ __('Subhead') }} <span class="text-danger">*</span></label>
    <textarea class="form-control @error('subhead') is-invalid @enderror" id="subhead" name="subhead" rows="5" placeholder="{{ __('Subhead of the blog post') }}" minlength="50" maxlength="500">{{ old('subhead', $post->subhead ?? '') }}</textarea>
    @error ('subhead')
        <x-validation-error :message="$message"/>
    @enderror
</div>
<div class="form-group mb-4">
    <label for="content">{{ __('Content') }} <span class="text-danger">*</span></label>
    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="20" placeholder="{{ __('Content of the blog post') }}" minlength="500" maxlength="10000">{{ old('content', $post->content ?? '') }}</textarea>
    @error ('content')
        <x-validation-error :message="$message"/>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="visibility">{{ __('Visibility') }} <span class="text-danger">*</span></label>
    <select class="form-control @error('visibility') is-invalid @enderror" name="visibility" id="visibility" required>
        <option value="Draft" @if (old('visibility', $post->visibility ?? '') === 'Draft') selected @endif>{{ __('Draft') }}</option>
        <option value="Awaiting Approval" @if (old('visibility', $post->visibility ?? '') === 'Awaiting Approval') selected @endif>{{ __('Awaiting Approval') }}</option>
    </select>
    @error ('visibility')
        <x-validation-error :message="$message"/>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="cover">{{ __('Image of the blog post') }} {!! isset($post) ? '' : '<span class="text-danger">*</span>' !!}</label>
    <br/>
    <input type="file" class="form-control-file @error('cover') is-invalid @enderror" id="cover" name="cover" {{ isset($post) ? '' : 'required' }}>
    @error ('cover')
        <x-validation-error :message="$message"/>
    @enderror
    <br/>
    <x-image-requirements size="900x400"/>
    @isset ($post)
        <br/>
        <span class="text-muted">{{ __('Current image') }}: <a href="{{ asset($post->cover) }}" target="_blank" rel="noopener">{{ __('Check') }}</a></span>
    @endisset
</div>
<div class="form-group mb-3">
    <span>{{ __('Categories') }} <span class="text-danger">*</span></span>
    <br/>
    @foreach ($categories as $category)
        <div class="form-check form-check-inline mt-2">
            <input class="form-check-input" name="categories[]" id="category{{ $category->id }}" type="checkbox" value="{{ $category->id }}" @if (is_array(old('categories')) && in_array($category->id, old('categories')) || isset($post) && $post->categories->contains($category->id)) checked @endif>
            <label class="form-check-label" for="category{{ $category->id }}">{{ $category->name }}</label>
        </div>
    @endforeach
</div>
<button type="submit" class="btn btn-primary w-100 mt-3">
    @isset ($post)
        {{ __('Update Post') }}
    @else
        {{ __('Create Post') }}
    @endisset
</button>