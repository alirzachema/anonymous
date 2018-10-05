<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCompaniesRequest;
use App\Http\Requests\Admin\UpdateCompaniesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

class CompaniesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Company.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('company_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Company::query();
            $query->with("categories");
            $query->with("city");
            $query->with("state");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('company_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'companies.id',
                'companies.company_logo',
                'companies.name',
                'companies.address',
                'companies.city_id',
                'companies.state_id',
                'companies.country',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'company_';
                $routeKey = 'admin.companies';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('company_logo', function ($row) {
                if($row->company_logo) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->company_logo) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->company_logo) .'"/>'; };
            });
            $table->editColumn('categories.name', function ($row) {
                if(count($row->categories) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->categories->pluck('name')->toArray()) . '</span>';
            });
            $table->editColumn('photos', function ($row) {
                $build  = '';
                foreach ($row->getMedia('photos') as $media) {
                    $build .= '<p class="form-group"><a href="' . $media->getUrl() . '" target="_blank">' . $media->name . '</a></p>';
                }
                
                return $build;
            });
            $table->editColumn('city.name', function ($row) {
                return $row->city ? $row->city->name : '';
            });
            $table->editColumn('state.name', function ($row) {
                return $row->state ? $row->state->name : '';
            });

            $table->rawColumns(['actions','massDelete','company_logo','categories.name','photos']);

            return $table->make(true);
        }

        return view('admin.companies.index');
    }

    /**
     * Show the form for creating new Company.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('company_create')) {
            return abort(401);
        }
        
        $categories = \App\CompanyCategory::get()->pluck('name', 'id');

        $cities = \App\City::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $states = \App\State::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.companies.create', compact('categories', 'cities', 'states'));
    }

    /**
     * Store a newly created Company in storage.
     *
     * @param  \App\Http\Requests\StoreCompaniesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompaniesRequest $request)
    {
        if (! Gate::allows('company_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $company = Company::create($request->all());
        $company->categories()->sync(array_filter((array)$request->input('categories')));


        foreach ($request->input('photos_id', []) as $index => $id) {
            $model          = config('medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $company->id;
            $file->save();
        }


        return redirect()->route('admin.companies.index');
    }


    /**
     * Show the form for editing Company.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('company_edit')) {
            return abort(401);
        }
        
        $categories = \App\CompanyCategory::get()->pluck('name', 'id');

        $cities = \App\City::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $states = \App\State::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $company = Company::findOrFail($id);

        return view('admin.companies.edit', compact('company', 'categories', 'cities', 'states'));
    }

    /**
     * Update Company in storage.
     *
     * @param  \App\Http\Requests\UpdateCompaniesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompaniesRequest $request, $id)
    {
        if (! Gate::allows('company_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $company = Company::findOrFail($id);
        $company->update($request->all());
        $company->categories()->sync(array_filter((array)$request->input('categories')));


        $media = [];
        foreach ($request->input('photos_id', []) as $index => $id) {
            $model          = config('medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $company->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $company->updateMedia($media, 'photos');


        return redirect()->route('admin.companies.index');
    }


    /**
     * Display Company.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('company_view')) {
            return abort(401);
        }
        $company = Company::findOrFail($id);

        return view('admin.companies.show', compact('company'));
    }


    /**
     * Remove Company from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('company_delete')) {
            return abort(401);
        }
        $company = Company::findOrFail($id);
        $company->deletePreservingMedia();

        return redirect()->route('admin.companies.index');
    }

    /**
     * Delete all selected Company at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('company_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Company::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore Company from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('company_delete')) {
            return abort(401);
        }
        $company = Company::onlyTrashed()->findOrFail($id);
        $company->restore();

        return redirect()->route('admin.companies.index');
    }

    /**
     * Permanently delete Company from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('company_delete')) {
            return abort(401);
        }
        $company = Company::onlyTrashed()->findOrFail($id);
        $company->forceDelete();

        return redirect()->route('admin.companies.index');
    }
}
