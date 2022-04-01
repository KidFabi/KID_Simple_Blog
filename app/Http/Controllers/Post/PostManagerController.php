<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Traits\ImageTrait;

class PostManagerController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the blog posts.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', Post::class);

        $posts = Post::with(['categories:id,name', 'author:id,username'])
            ->select(['id', 'created_at', 'author_id', 'title', 'visibility', 'published_at', 'views'])
            ->latest()
            ->orderBy('id', 'ASC')
            ->paginate(15);

        return view('web.manager.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a blog post.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        return view('web.manager.posts.create');
    }

    /**
     * Store a newly created blog post.
     *
     * @param  \App\Http\Requests\Post\StorePostRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StorePostRequest $request)
    {
        $this->authorize('create', Post::class);

        $data = $request->validated();

        try {
            $data['cover'] = $this->storeImage($request, 'cover', Post::IMAGE_FOLDER);
        } catch (\Exception $e) {
            return redirect()
                ->route('manager.posts.create')
                ->with('fail', __('The cover could not be uploaded. Please, try again.'))
                ->withInput($data);
        }

        $post = auth()->user()->posts()->create($data);

        $post->categories()->attach($request->categories);

        return redirect()
            ->route('manager.posts.index')
            ->with('success', __('Post has been created successfully.'));
    }

    /**
     * Display the preview of the blog post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);

        return view('web.manager.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified blog post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('web.manager.posts.edit', compact('post'));
    }

    /**
     * Update the specified blog post in storage.
     *
     * @param  \App\Http\Requests\Post\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $data = $request->validated();

        if ($request->hasFile('cover')) {
            try {
                $data['cover'] = $this->storeImage($request, 'cover', Post::IMAGE_FOLDER);
            } catch (\Exception $e) {
                return redirect()
                    ->route('manager.posts.create')
                    ->with('fail', __('The cover could not be uploaded. Please, try again.'))
                    ->withInput($data);
            }

            /**
             * Delete old post cover in \App\Observers\PostObserver::updated().
            */
        }

        $post->update($data);

        $post->categories()->sync($request->categories);

        return redirect()
            ->route('manager.posts.edit', $post->id)
            ->with('success', __('Post has been updated successfully.'));
    }

    /**
     * Remove the specified blog post from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', Post::class);

        $deleted = $post->delete();

        if (!$deleted) {
            return redirect()
                ->route('manager.posts.index')
                ->with('fail', __('Blog post could not be deleted. Please, try again.'));
        }

        /**
         * Delete post cover in \App\Observers\PostObserver::deleted().
        */

        return redirect()
            ->route('manager.posts.index')
            ->with('success', __('Blog post has been deleted successfully.'));
    }
}
