<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePatientRequest;
use App\Models\Patient;
use App\Repositories\CompanyRepository;
use App\Repositories\PatientRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PatientController extends Controller
{
    private CompanyRepository $companyRepository;
    private PatientRepository $patientRepository;

    /**
     * @param CompanyRepository $companyRepository
     * @param PatientRepository $patientRepository
     */
    public function __construct(
        CompanyRepository $companyRepository,
        PatientRepository $patientRepository,
    )
    {
        $this->companyRepository = $companyRepository;
        $this->patientRepository = $patientRepository;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Admin/Patients/Report', [
            'patients'  => $this->patientRepository->getPatients($request),
            'filters'   => [
                'search'    => $request->query('search', ''),
                'status'    => $request->query('status', '')
            ]
        ]);
    }

    /**
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Patients/Create', [
            'companies' => $this->companyRepository->getAllCompanies()
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(StorePatientRequest $request): RedirectResponse
    {
        $patient = $this->patientRepository->createPatient($request->validated());

        return redirect()->route('admin.patients')
            ->with('alert', "{$patient->name} was successfully created!");
    }

    /**
     * @param Patient $patient
     * @return Response
     */
    public function edit(Patient $patient): Response
    {
        return Inertia::render('Admin/Patients/EditTabs/Basic', [
            'patient'   => $patient,
            'companies' => $this->companyRepository->getAllCompanies()
        ]);
    }

    /**
     * @param Request $request
     * @param Patient $patient
     * @return RedirectResponse
     */
    public function update(StorePatientRequest $request, Patient $patient): RedirectResponse
    {
        $patient->update($request->validated());

        return redirect()->route('admin.patients')
            ->with('alert', "{$patient->name} was successfully updated!");
    }

    /**
     * @param ParkingOperator $parkingOperator
     * @return RedirectResponse
     */
    public function destroy(Patient $patient): RedirectResponse
    {
        $this->patientRepository->deletePatient($patient->id);

        return redirect()->route('admin.patients')
            ->with('alert', "{$patient->name} was successfully deleted!");
    }
}
