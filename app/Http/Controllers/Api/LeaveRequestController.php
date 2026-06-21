<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaveRequestRequest;
use App\Http\Resources\LeaveRequestResource;
use App\Services\LeaveRequestService;
use App\Traits\ApiResponseTrait;

class LeaveRequestController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private LeaveRequestService $service
    ) {}

    public function index()
    {
        $leaves = $this->service->getAll();

        return $this->successResponse(
            'Leave requests retrieved successfully',
            LeaveRequestResource::collection($leaves)
        );
    }

    public function store(
        StoreLeaveRequestRequest $request
    )
    {
        $leave = $this->service->create(
            $request->validated()
        );

        return $this->successResponse(
            'Leave request submitted',
            new LeaveRequestResource(
                $leave->load('employee')
            ),
            201
        );
    }

    public function approve($id)
    {
        $leave = $this->service->approve($id);

        return $this->successResponse(
            'Leave approved',
            new LeaveRequestResource(
                $leave->load('employee')
            )
        );
    }

    public function reject($id)
    {
        $leave = $this->service->reject($id);

        return $this->successResponse(
            'Leave rejected',
            new LeaveRequestResource(
                $leave->load('employee')
            )
        );
    }
}
