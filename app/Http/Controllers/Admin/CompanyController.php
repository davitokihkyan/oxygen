<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCompanyRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends Controller
{
    private CompanyRepository $companyRepository;

    /**
     * @param CompanyRepository $companyRepository
     */
    public function __construct(
        CompanyRepository $companyRepository,
    )
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Admin/Companies/Report', [
            'companies' => $this->companyRepository->getCompanies($request),
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
        return Inertia::render('Admin/Companies/Create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        $company = $this->companyRepository->createCompany($request->validated());

        return redirect()->route('admin.companies')
            ->with('alert', "{$company->name} was successfully created!");
    }

    /**
     * @param Company $company
     * @return Response
     */
    public function edit(Company $company): Response
    {
        return Inertia::render('Admin/Companies/EditTabs/Basic', [
            'company' => $company
        ]);
    }

    /**
     * @param ParkingOperator $parkingOperator
     * @return Response
     */
    public function editLocations(ParkingOperator $parkingOperator): Response
    {
        return Inertia::render('Admin/Companies/EditTabs/Locations', [
            'parkingOperator'   => $parkingOperator,
            'parkingLocations'  => $parkingOperator->parkingLocations()->paginate(25)
        ]);
    }

    /**
     * @param UpdateParkingOperatorRequest $request
     * @param ParkingOperator $parkingOperator
     * @return RedirectResponse
     */
    public function update(StoreCompanyRequest $request, Company $company): RedirectResponse
    {
        $company->update($request->validated());

        return redirect()->route('admin.companies')
            ->with('alert', "{$company->name} was successfully updated!");
    }

    /**
     * @param ParkingOperator $parkingOperator
     * @return RedirectResponse
     */
    public function destroy(Company $company): RedirectResponse
    {
        $this->companyRepository->deleteCompany($company->id);

        return redirect()->route('admin.companies')
            ->with('alert', "{$company->name} was successfully deleted!");
    }
}
