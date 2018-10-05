<?php

namespace App\Http\Controllers\Api\V1;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCompaniesRequest;
use App\Http\Requests\Admin\UpdateCompaniesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

class CompaniesController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Company::all();
    }

    public function show($id)
    {
        return Company::findOrFail($id);
    }

    public function update(UpdateCompaniesRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $company = Company::findOrFail($id);
        $company->update($request->all());
        

        return $company;
    }

    public function store(StoreCompaniesRequest $request)
    {
        $request = $this->saveFiles($request);
        $company = Company::create($request->all());
        

        return $company;
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return '';
    }
}
