<?php

namespace App\Interfaces;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface CompanyInterface
{
    public function getAllCompanies(): Collection;

    public function getCompanies(Request $request): LengthAwarePaginator;

    public function getCompanyById(int $id): Company;

    public function deleteCompany(int $id): void;

    public function createCompany(array $data): Company;

    public function updateCompany(int $id, array $data): int;
}
