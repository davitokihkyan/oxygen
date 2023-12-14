<?php

namespace App\Repositories;

use App\Interfaces\AppointmentInterface;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AppointmentRepository implements AppointmentInterface
{
    /**
     * @return Collection
     */
    public function getAllAppointments(): Collection
    {
        return Appointment::query()
            ->where('active', true)
            ->get();
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getAppointments(Request $request): LengthAwarePaginator
    {
        return Appointment::query()
            ->with('patient', 'patient.company')
            ->when($request->query('search'), function (Builder $query, string $search) {
                $query->where(function($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                });
            })
            ->when($request->query('company_id'), function (Builder $query, string $companyId) {
                $query->whereRelation('patient.company', 'id', $companyId);
            })
            ->when($request->query('patient_id'), function (Builder $query, string $patientId) {
                $query->where('patient_id', $patientId);
            })
            ->when($request->query('status'), function (Builder $query, string $status) {
                $query->where('active', $status == 'Active' ? 1 : 0 );
            })
            ->when($request->query('date'), function (Builder $query, array $dates) {
                $query->where('date', '>=', $dates[0]);
                $query->where('date', '<=', $dates[1]);
            })
            ->paginate(25)
            ->withQueryString();
    }

    /**
     * @param int $id
     * @return Appointment
     */
    public function getAppointmentById(int $id): Appointment
    {
        return Appointment::find($id);
    }

    /**
     * @param string $date
     * @return Collection
     */
    public function getAppointmentByDate(string $date): Collection
    {
        return Appointment::where('date', $date)
            ->where('active', true)
            ->get();
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteAppointment(int $id): void
    {
        Appointment::destroy($id);
    }

    /**
     * @param array $data
     * @return Appointment
     */
    public function createAppointment(array $data): Appointment
    {
        $data['end_time'] = Carbon::createFromDate($data['start_time'])->addMinutes(45)->format('g:i A');

        return Appointment::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return int
     */
    public function updateAppointment(int $id, array $data): int
    {
        return Appointment::whereId($id)->update($data);
    }
}
