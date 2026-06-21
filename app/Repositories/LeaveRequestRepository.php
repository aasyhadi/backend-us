<?php

namespace App\Repositories;

use App\Models\LeaveRequest;
use App\Repositories\Interfaces\LeaveRequestRepositoryInterface;

class LeaveRequestRepository implements LeaveRequestRepositoryInterface
{
    public function getAll(array $filters = [])
    {
        return LeaveRequest::with('employee')
            ->latest()
            ->paginate(10);
    }

    public function create(array $data)
    {
        return LeaveRequest::create($data);
    }

    public function findById(int $id)
    {
        return LeaveRequest::findOrFail($id);
    }

    public function approve(int $id)
    {
        $leave = $this->findById($id);

        $leave->update([
            'status' => 'approved'
        ]);

        return $leave;
    }

    public function reject(int $id)
    {
        $leave = $this->findById($id);

        $leave->update([
            'status' => 'rejected'
        ]);

        return $leave;
    }
}
