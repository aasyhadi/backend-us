<?php

namespace App\Repositories\Interfaces;

interface LeaveRequestRepositoryInterface
{
    public function getAll(array $filters = []);

    public function create(array $data);

    public function approve(int $id);

    public function reject(int $id);

    public function findById(int $id);
}
