<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Traits\ApiResponseTrait;

class ActivityLogController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $logs = ActivityLog::latest()->paginate(20);

        return $this->successResponse(
            'Activity logs retrieved successfully',
            $logs->items(),
            200,
            [
                'current_page' => $logs->currentPage(),
                'last_page' => $logs->lastPage(),
                'per_page' => $logs->perPage(),
                'total' => $logs->total(),
            ]
        );
    }
}
