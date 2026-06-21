<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneratePayrollRequest;
use App\Http\Resources\PayrollResource;
use App\Services\PayrollService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PayrollController extends Controller
{
    public function __construct(
        private PayrollService $payrollService
    ) {}

    public function index(Request $request)
    {
        $payrolls = $this->payrollService->getAll(
            $request->all()
        );

        return response()->json([
            'success' => true,
            'message' => 'Payroll list retrieved successfully',
            'data' => PayrollResource::collection($payrolls),
            'meta' => [
                'current_page' => $payrolls->currentPage(),
                'last_page' => $payrolls->lastPage(),
                'per_page' => $payrolls->perPage(),
                'total' => $payrolls->total(),
            ]
        ]);
    }

    public function show($id)
    {
        $payroll = $this->payrollService->getById($id);

        return response()->json([
            'success' => true,
            'message' => 'Payroll detail retrieved successfully',
            'data' => new PayrollResource($payroll)
        ]);
    }

    public function generate(GeneratePayrollRequest $request)
    {
        $payroll = $this->payrollService->generate(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Payroll generated successfully',
            'data' => new PayrollResource(
                $payroll->load('employee')
            )
        ], 201);
    }

    public function slip($id)
    {
        $payroll = $this->payrollService
            ->getPayroll($id);

        $pdf = Pdf::loadView(
            'payroll.slip',
            [
                'payroll' => $payroll
            ]
        );

        return $pdf->download(
            'slip-gaji-' .
            $payroll->employee->employee_number .
            '.pdf'
        );
    }
}
