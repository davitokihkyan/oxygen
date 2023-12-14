<?php

namespace App\Interfaces;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface AppointmentInterface
{
    public function getAllAppointments(): Collection;

    public function getAppointments(Request $request): LengthAwarePaginator;

    public function getAppointmentById(int $id): Appointment;

    public function getAppointmentByDate(string $date): Collection;

    public function deleteAppointment(int $id): void;

    public function createAppointment(array $data): Appointment;

    public function updateAppointment(int $id, array $data): int;
}
