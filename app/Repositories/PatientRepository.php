<?php

namespace App\Repositories;

use App\Interfaces\PatientInterface;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class PatientRepository implements PatientInterface
{
    /**
     * @return Collection
     */
    public function getAllPatients(): Collection
    {
        return Cache::rememberForever(Patient::$cacheKey, function () {
            return Patient::query()
                ->where('active', true)
                ->get();
        });
    }

    /**
     * @return Collection
     */
    public function getAllPatientsWithAppointmentsCount(): Collection
    {
        return Patient::query()
            ->withCount(['appointments' => function (Builder $query) {
                $query->where('date', '>', Carbon::now()->subMonths(2)->format('m/d/Y'));
            }])
            ->where('active', true)
            ->get();
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPatients(Request $request): LengthAwarePaginator
    {
        return Patient::query()
            ->with('company')
            ->when($request->query('search'), function (Builder $query, string $search) {
                $query->where(function($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                    $query->orWhere('email', 'LIKE', '%' . $search . '%');
                    $query->orWhere('phone', 'LIKE', '%' . $search . '%');
                });
            })
            ->when($request->query('status'), function (Builder $query, string $status) {
                $query->where('active', $status == 'Active' ? 1 : 0 );
            })
            ->paginate(25)
            ->withQueryString();
    }

    /**
     * @param int $id
     * @return Patient
     */
    public function getPatientById(int $id): Patient
    {
        return Patient::find($id);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deletePatient(int $id): void
    {
        Patient::destroy($id);
    }

    /**
     * @param array $data
     * @return Patient
     */
    public function createPatient(array $data): Patient
    {
        return Patient::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return int
     */
    public function updatePatient(int $id, array $data): int
    {
        return Patient::whereId($id)->update($data);
    }
}
