<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Services\DepartmentService;
use App\Traits\ApiResponseTrait;

class DepartmentController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        protected DepartmentService $departmentService
    ) {}

    public function index()
    {
        $departments = $this->departmentService->getAll();

        return $this->successResponse(
            'Department list retrieved successfully',
            DepartmentResource::collection($departments),
            200,
            [
                'current_page' => $departments->currentPage(),
                'last_page' => $departments->lastPage(),
                'per_page' => $departments->perPage(),
                'total' => $departments->total(),
            ]
        );
    }

    public function store(StoreDepartmentRequest $request)
    {
        $department = $this->departmentService->create(
            $request->validated()
        );

        return $this->successResponse(
            'Department created successfully',
            new DepartmentResource($department),
            201
        );
    }

    public function show(Department $department)
    {
        return $this->successResponse(
            'Department detail retrieved successfully',
            new DepartmentResource($department)
        );
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department = $this->departmentService->update(
            $department,
            $request->validated()
        );

        return $this->successResponse(
            'Department updated successfully',
            new DepartmentResource($department)
        );
    }

    public function destroy(Department $department)
    {
        $this->departmentService->delete($department);

        return $this->successResponse(
            'Department deleted successfully'
        );
    }
}
