<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class DashboardService
{
    /**
     * Get statistics for manager dashboard.
     *
     * @return array
     */
    public function getStatistics()
    {
        $totalPosts = Post::published()
            ->count();

        $totalViews = Post::published()
            ->sum('views');

        $totalComments = Comment::count();

        $totalUsers = User::count();

        $topPosts = Post::published()
            ->select('id', 'title', 'subhead', 'views', 'slug')
            ->orderBy('views', 'DESC')
            ->latest()
            ->take(3)
            ->get();

        $topUsers = User::select('username')
            ->withCount('posts')
            ->orderBy('posts_count', 'DESC')
            ->take(3)
            ->get();

        $latestPosts = Post::with('author:id,username')
            ->published()
            ->select(['id', 'title', 'published_at', 'author_id', 'slug'])
            ->orderBy('published_at', 'DESC')
            ->take(5)
            ->get();

        $latestUsers = User::select(['id', 'username', 'created_at'])
            ->latest()
            ->take(5)
            ->get();

        $statistics = [
            'totalPosts' => $totalPosts,
            'totalViews' => $totalViews,
            'totalComments' => $totalComments,
            'totalUsers' => $totalUsers,
            'topPosts' => $topPosts,
            'topUsers' => $topUsers,
            'latestPosts' => $latestPosts,
            'latestUsers' => $latestUsers
        ];

        return $statistics;
    }
}
