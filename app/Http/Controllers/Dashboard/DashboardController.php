<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    /**
     * Get statistics for manager dashboard.
     *
     * @param  \App\Services\DashboardService  $service
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(DashboardService $service)
    {
        $this->authorize('access-dashboard');

        $statistics = $service->getStatistics();

        return view('web.manager.dashboard', compact('statistics'));
    }
}
