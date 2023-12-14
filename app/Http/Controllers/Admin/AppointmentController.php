<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Patient;
use App\Repositories\AppointmentRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\PatientRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;
use Inertia\Response;

class AppointmentController extends Controller
{
    private CompanyRepository $companyRepository;
    private PatientRepository $patientRepository;
    private AppointmentRepository $appointmentRepository;

    /**
     * @param CompanyRepository $companyRepository
     * @param PatientRepository $patientRepository
     * @param AppointmentRepository $appointmentRepository
     */
    public function __construct(
        CompanyRepository $companyRepository,
        PatientRepository $patientRepository,
        AppointmentRepository $appointmentRepository
    )
    {
        $this->companyRepository = $companyRepository;
        $this->patientRepository = $patientRepository;
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Admin/Appointments/Report', [
            'appointments'  => $this->appointmentRepository->getAppointments($request),
            'companies'     => $this->companyRepository->getAllCompanies(),
            'patients'      => $this->patientRepository->getAllPatients(),
            'filters'       => [
                'search'        => $request->query('search', ''),
                'company_id'    => $request->query('company_id', ''),
                'patient_id'    => $request->query('patient_id', ''),
                'status'        => $request->query('status', ''),
                'date'          => $request->query('date', []),
            ]
        ]);
    }

    /**
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Appointments/Create', [
            'patients'  => $this->patientRepository->getAllPatientsWithAppointmentsCount()
        ]);
    }

    /**
     * @param StoreAppointmentRequest $request
     * @return RedirectResponse
     */
    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        $appointment = $this->appointmentRepository->createAppointment($request->validated());

        return redirect()->route('admin.appointments')
            ->with('alert', "{$appointment->id} was successfully created!");
    }

    /**
     * @param Appointment $appointment
     * @return Response
     */
    public function edit(Appointment $appointment): Response
    {
        return Inertia::render('Admin/Appointments/Edit', [
            'appointment'   => $appointment
        ]);
    }

    /**
     * @param StoreAppointmentRequest $request
     * @param Appointment $appointment
     * @return RedirectResponse
     */
    public function update(StoreAppointmentRequest $request, Appointment $appointment): RedirectResponse
    {
        $appointment->update($request->validated());

        return redirect()->route('admin.appointments')
            ->with('alert', "{$appointment->id} was successfully updated!");
    }

    /**
     * @param Appointment $appointment
     * @return RedirectResponse
     */
    public function destroy(Appointment $appointment): RedirectResponse
    {
        $this->appointmentRepository->deleteAppointment($appointment->id);

        return redirect()->route('admin.appointments')
            ->with('alert', "{$appointment->id} was successfully deleted!");
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAvailableStartTimes(Request $request): JsonResponse
    {
        $step = 15 * 60; // 15 minutes
        $start = 19800; // 05:30 AM
        $end = 79200; // 10:00 PM

        // generate all available start times
        $availableStartTimes = [];
        foreach (range($start, $end, $step) as $timestamp) {
            $time = Carbon::createFromTimestamp($timestamp)->format('g:i A');

            $availableStartTimes[$time] = $time;
        }

        // remove reserved and overlapped start times
        $appointments = $this->appointmentRepository->getAppointmentByDate($request->get('date'));
        foreach ($appointments as $appointment) {
            $startTimestamp = Carbon::parse($appointment->start_time)->secondsSinceMidnight();

            foreach (range($startTimestamp - ($step * 2), $startTimestamp + ($step * 2), $step) as $timestamp) {
                $time = Carbon::createFromTimestamp($timestamp)->format('g:i A');

                if (isset($availableStartTimes[$time])) {
                    unset($availableStartTimes[$time]);
                }
            }
        }

        return response()->json($availableStartTimes);
    }
}
