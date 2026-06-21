<?php

namespace App\Services;

use Carbon\Carbon;
use App\Repositories\Interfaces\LeaveRequestRepositoryInterface;

class LeaveRequestService
{
    public function __construct(
        private LeaveRequestRepositoryInterface $repository
    ) {}

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create(array $data)
    {
        $start = Carbon::parse($data['start_date']);
        $end = Carbon::parse($data['end_date']);

        $data['total_days'] =
            $start->diffInDays($end) + 1;

        return $this->repository->create($data);
    }

    public function approve(int $id)
    {
        return $this->repository->approve($id);
    }

    public function reject(int $id)
    {
        return $this->repository->reject($id);
    }
}
