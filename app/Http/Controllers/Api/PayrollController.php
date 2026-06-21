<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneratePayrollRequest;
use App\Http\Resources\PayrollResource;
use App\Services\PayrollService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\ActivityLogService;
use App\Traits\ApiResponseTrait;

class PayrollController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private PayrollService $payrollService,
        private ActivityLogService $activityLogService
    ) {}

    public function index(Request $request)
    {
        $payrolls = $this->payrollService->getAll(
            $request->all()
        );

        return $this->successResponse(
            'Payroll list retrieved successfully',
            PayrollResource::collection($payrolls),
            200,
            [
                'current_page' => $payrolls->currentPage(),
                'last_page' => $payrolls->lastPage(),
                'per_page' => $payrolls->perPage(),
                'total' => $payrolls->total(),
            ]
        );
    }

    public function show($id)
    {
        $payroll = $this->payrollService->getById($id);

        return $this->successResponse(
            'Payroll detail retrieved successfully',
            new PayrollResource($payroll)
        );
    }

    public function generate(GeneratePayrollRequest $request)
    {
        $payroll = $this->payrollService->generate(
            $request->validated()
        );

        $this->activityLogService->log(
            'generate',
            'payroll',
            'Payroll generated',
            [
                'payroll_id' => $payroll->id,
                'employee_id' => $payroll->employee_id,
                'period' => $payroll->period,
                'net_salary' => $payroll->net_salary,
            ]
        );

        return $this->successResponse(
            'Payroll generated successfully',
            new PayrollResource(
                $payroll->load('employee')
            ),
            201
        );
    }

    public function slip($id)
    {
        $payroll = $this->payrollService->getPayroll($id);

        $pdf = Pdf::loadView('payroll.slip', [
            'payroll' => $payroll
        ]);

        return $pdf->download(
            'slip-gaji-' .
            $payroll->employee->employee_number .
            '.pdf'
        );
    }
}
