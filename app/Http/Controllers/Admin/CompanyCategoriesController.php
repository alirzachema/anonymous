<?php

namespace App\Http\Controllers\Admin;

use App\CompanyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCompanyCategoriesRequest;
use App\Http\Requests\Admin\UpdateCompanyCategoriesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

class CompanyCategoriesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of CompanyCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('company_category_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = CompanyCategory::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('company_category_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'company_categories.id',
                'company_categories.name',
                'company_categories.description',
                'company_categories.photo',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'company_category_';
                $routeKey = 'admin.company_categories';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('photo', function ($row) {
                if($row->photo) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->photo) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->photo) .'"/>'; };
            });

            $table->rawColumns(['actions','massDelete','photo']);

            return $table->make(true);
        }

        return view('admin.company_categories.index');
    }

    /**
     * Show the form for creating new CompanyCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('company_category_create')) {
            return abort(401);
        }
        return view('admin.company_categories.create');
    }

    /**
     * Store a newly created CompanyCategory in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyCategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyCategoriesRequest $request)
    {
        if (! Gate::allows('company_category_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $company_category = CompanyCategory::create($request->all());



        return redirect()->route('admin.company_categories.index');
    }


    /**
     * Show the form for editing CompanyCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('company_category_edit')) {
            return abort(401);
        }
        $company_category = CompanyCategory::findOrFail($id);

        return view('admin.company_categories.edit', compact('company_category'));
    }

    /**
     * Update CompanyCategory in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyCategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyCategoriesRequest $request, $id)
    {
        if (! Gate::allows('company_category_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $company_category = CompanyCategory::findOrFail($id);
        $company_category->update($request->all());



        return redirect()->route('admin.company_categories.index');
    }


    /**
     * Display CompanyCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('company_category_view')) {
            return abort(401);
        }
        $companies = \App\Company::whereHas('categories',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $company_category = CompanyCategory::findOrFail($id);

        return view('admin.company_categories.show', compact('company_category', 'companies'));
    }


    /**
     * Remove CompanyCategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('company_category_delete')) {
            return abort(401);
        }
        $company_category = CompanyCategory::findOrFail($id);
        $company_category->delete();

        return redirect()->route('admin.company_categories.index');
    }

    /**
     * Delete all selected CompanyCategory at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('company_category_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CompanyCategory::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore CompanyCategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('company_category_delete')) {
            return abort(401);
        }
        $company_category = CompanyCategory::onlyTrashed()->findOrFail($id);
        $company_category->restore();

        return redirect()->route('admin.company_categories.index');
    }

    /**
     * Permanently delete CompanyCategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('company_category_delete')) {
            return abort(401);
        }
        $company_category = CompanyCategory::onlyTrashed()->findOrFail($id);
        $company_category->forceDelete();

        return redirect()->route('admin.company_categories.index');
    }
}
