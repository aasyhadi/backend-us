<?php

namespace App\Repositories\Interfaces;

interface PayrollRepositoryInterface
{
    public function getAll(array $filters = []);
    public function findById(int $id);
    public function create(array $data);
}
