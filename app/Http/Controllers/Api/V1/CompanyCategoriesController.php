<?php

namespace App\Http\Controllers\Api\V1;

use App\CompanyCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCompanyCategoriesRequest;
use App\Http\Requests\Admin\UpdateCompanyCategoriesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

class CompanyCategoriesController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return CompanyCategory::all();
    }

    public function show($id)
    {
        return CompanyCategory::findOrFail($id);
    }

    public function update(UpdateCompanyCategoriesRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $company_category = CompanyCategory::findOrFail($id);
        $company_category->update($request->all());
        

        return $company_category;
    }

    public function store(StoreCompanyCategoriesRequest $request)
    {
        $request = $this->saveFiles($request);
        $company_category = CompanyCategory::create($request->all());
        

        return $company_category;
    }

    public function destroy($id)
    {
        $company_category = CompanyCategory::findOrFail($id);
        $company_category->delete();
        return '';
    }
}
