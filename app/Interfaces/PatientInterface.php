<?php

namespace App\Interfaces;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface PatientInterface
{
    public function getAllPatients(): Collection;

    public function getPatients(Request $request): LengthAwarePaginator;

    public function getPatientById(int $id): Patient;

    public function deletePatient(int $id): void;

    public function createPatient(array $data): Patient;

    public function updatePatient(int $id, array $data): int;
}
