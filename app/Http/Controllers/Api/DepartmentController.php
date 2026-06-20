<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Services\DepartmentService;

class DepartmentController extends Controller
{
    public function __construct(
        protected DepartmentService $departmentService
    ) {}

    public function index()
    {
        $departments = $this->departmentService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Department list retrieved successfully',
            'data' => DepartmentResource::collection($departments),
            'meta' => [
                'current_page' => $departments->currentPage(),
                'last_page' => $departments->lastPage(),
                'per_page' => $departments->perPage(),
                'total' => $departments->total(),
            ]
        ]);
    }

    public function store(StoreDepartmentRequest $request)
    {
        $department = $this->departmentService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Department created successfully',
            'data' => new DepartmentResource($department)
        ], 201);
    }

    public function show(Department $department)
    {
        return response()->json([
            'success' => true,
            'message' => 'Department detail retrieved successfully',
            'data' => new DepartmentResource($department)
        ]);
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department = $this->departmentService->update(
            $department,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Department updated successfully',
            'data' => new DepartmentResource($department)
        ]);
    }

    public function destroy(Department $department)
    {
        $this->departmentService->delete($department);

        return response()->json([
            'success' => true,
            'message' => 'Department deleted successfully'
        ]);
    }
}
