<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;

class CategoryManagerController extends Controller
{
    /**
     * Display category manager page.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', Category::class);

        $categories = Category::select(['id', 'created_at', 'name'])
            ->withCount('posts')
            ->latest()
            ->paginate(10);

        return view('web.manager.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Category::class);

        return view('web.manager.categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \App\Http\Requests\Category\CategoryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CategoryRequest $request)
    {
        $this->authorize('create', Category::class);

        Category::create($request->validated());

        /**
         * Clear categories cache in \App\Observers\CategoryObserver::created().
        */

        return redirect()
            ->route('manager.categories.index')
            ->with('success', __('Category has been created successfully.'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Category $category)
    {
        $this->authorize('update', Category::class);

        return view('web.manager.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $this->authorize('update', Category::class);

        $category->update($request->validated());

        /**
         * Clear categories cache in \App\Observers\CategoryObserver::updated().
        */

        return redirect()
            ->route('manager.categories.edit', $category->id)
            ->with('success', __('Category has been updated successfully.'));
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', Category::class);

        $deleted = $category->delete();

        if (!$deleted) {
            return redirect()
                ->route('manager.categories.index')
                ->with('fail', __('Category could not be deleted. Please, try again.'));
        }

        /**
         * Clear categories cache in \App\Observers\CategoryObserver::deleted().
        */

        return redirect()
            ->route('manager.categories.index')
            ->with('success', __('Category has been deleted successfully.'));
    }
}
