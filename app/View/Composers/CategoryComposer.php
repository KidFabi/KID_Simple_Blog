<?php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class CategoryComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return mixed
     */
    public function compose(View $view)
    {
        $categories = Cache::remember('categories', 60*60*24*7, function() {
            return Category::select(['id', 'name'])
                ->orderBy('name', 'ASC')
                ->get();
        });

        $view->with('categories', $categories);
    }
}