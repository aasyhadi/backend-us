<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Request;
use App\Services\EmployeeService;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Support\Facades\Storage;
use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ImportEmployeeRequest;

class EmployeeController extends Controller
{
    private EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index(Request $request)
    {
        $employees = $this->employeeService->getEmployees(
            $request->all()
        );

        return response()->json([
            'success' => true,
            'message' => 'Employee list retrieved successfully',
            'data' => EmployeeResource::collection($employees),
            'meta' => [
                'current_page' => $employees->currentPage(),
                'last_page' => $employees->lastPage(),
                'per_page' => $employees->perPage(),
                'total' => $employees->total(),
            ]
        ]);
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employee = $this->employeeService->createEmployee(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Employee created successfully',
            'data' => new EmployeeResource(
                $employee->load(['department', 'position'])
            )
        ], 201);
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {
        $employee = $this->employeeService->updateEmployee(
            $id,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Employee updated successfully',
            'data' => new EmployeeResource(
                $employee->load(['department', 'position'])
            )
        ]);
    }

    public function show($id)
    {
        $employee = $this->employeeService->getEmployeeById($id);

        return response()->json([
            'success' => true,
            'message' => 'Employee detail retrieved successfully',
            'data' => new EmployeeResource(
                $employee->load(['department', 'position'])
            )
        ]);
    }

    public function destroy($id)
    {
        $this->employeeService->deleteEmployee($id);

        return response()->json([
            'success' => true,
            'message' => 'Employee deleted successfully'
        ]);
    }

    public function uploadPhoto(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $employee = $this->employeeService->getEmployeeById($id);

        $path = $request
            ->file('photo')
            ->store('employees', 'public');

        $employee->update([
            'photo' => $path
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Photo uploaded successfully',
            'data' => [
                'employee_id' => $employee->id,
                'photo' => $path,
                'url' => asset('storage/' . $path)
            ]
        ]);
    }

    public function export()
    {
        return Excel::download(
            new EmployeesExport,
            'employees.xlsx'
        );
    }

    public function import(
        ImportEmployeeRequest $request
    )
    {
        $this->employeeService->importEmployees(
            $request->file('file')
        );

        return response()->json([
            'success' => true,
            'message' => 'Employees imported successfully'
        ]);
    }

}
