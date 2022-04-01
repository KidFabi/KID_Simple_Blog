<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display categories with published posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with(['posts' => function ($query) {
            $query->select(['id', 'title', 'subhead'])
                ->published();
        }])->select('id', 'name')
            ->latest()
            ->paginate(5);

        return view('web.categories.index', compact('categories'));
    }
}
