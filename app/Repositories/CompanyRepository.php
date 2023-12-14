<?php

namespace App\Repositories;

use App\Interfaces\CompanyInterface;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class CompanyRepository implements CompanyInterface
{
    /**
     * @return Collection
     */
    public function getAllCompanies(): Collection
    {
        return Cache::rememberForever(Company::$cacheKey, function () {
            return Company::query()
                ->where('active', true)
                ->get();
        });
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getCompanies(Request $request): LengthAwarePaginator
    {
        return Company::query()
            ->when($request->query('search'), function (Builder $query, string $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->when($request->query('status'), function (Builder $query, string $status) {
                $query->where('active', $status == 'Active' ? 1 : 0 );
            })
            ->paginate(25)
            ->withQueryString();
    }

    /**
     * @param int $id
     * @return Company
     */
    public function getCompanyById(int $id): Company
    {
        return Company::find($id);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteCompany(int $id): void
    {
        Company::destroy($id);
    }

    /**
     * @param array $data
     * @return Company
     */
    public function createCompany(array $data): Company
    {
        return Company::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return int
     */
    public function updateCompany(int $id, array $data): int
    {
        return Company::whereId($id)->update($data);
    }
}
