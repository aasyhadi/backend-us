<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaveRequestRequest;
use App\Http\Resources\LeaveRequestResource;
use App\Services\LeaveRequestService;

class LeaveRequestController extends Controller
{
    public function __construct(
        private LeaveRequestService $service
    ) {}

    public function index()
    {
        $leaves = $this->service->getAll();

        return response()->json([
            'success' => true,
            'data' => LeaveRequestResource::collection($leaves)
        ]);
    }

    public function store(
        StoreLeaveRequestRequest $request
    )
    {
        $leave = $this->service->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Leave request submitted',
            'data' => new LeaveRequestResource(
                $leave->load('employee')
            )
        ], 201);
    }

    public function approve($id)
    {
        $leave = $this->service->approve($id);

        return response()->json([
            'success' => true,
            'message' => 'Leave approved',
            'data' => new LeaveRequestResource(
                $leave->load('employee')
            )
        ]);
    }

    public function reject($id)
    {
        $leave = $this->service->reject($id);

        return response()->json([
            'success' => true,
            'message' => 'Leave rejected',
            'data' => new LeaveRequestResource(
                $leave->load('employee')
            )
        ]);
    }
}
