<div class="form-group mb-3">
    <label for="name">{{ __('Name') }}</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" minlength="3" maxlength="30" value="{{ old('name', $category->name ?? '') }}" placeholder="{{ __('Name of the category') }}" required>
    @error ('name')
        <x-validation-error :message="$message"/>
    @enderror
</div>
<button type="submit" class="btn btn-primary w-100 mt-3">
    @isset ($category)
        {{ __('Update Category') }}
    @else
        {{ __('Create Category') }}
    @endisset
</button>