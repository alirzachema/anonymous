<?php

namespace App\Http\Controllers\Admin;

use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStatesRequest;
use App\Http\Requests\Admin\UpdateStatesRequest;
use Yajra\DataTables\DataTables;

class StatesController extends Controller
{
    /**
     * Display a listing of State.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('state_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = State::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('state_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'states.id',
                'states.name',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'state_';
                $routeKey = 'admin.states';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.states.index');
    }

    /**
     * Show the form for creating new State.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('state_create')) {
            return abort(401);
        }
        return view('admin.states.create');
    }

    /**
     * Store a newly created State in storage.
     *
     * @param  \App\Http\Requests\StoreStatesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatesRequest $request)
    {
        if (! Gate::allows('state_create')) {
            return abort(401);
        }
        $state = State::create($request->all());

        foreach ($request->input('companies', []) as $data) {
            $state->companies()->create($data);
        }


        return redirect()->route('admin.states.index');
    }


    /**
     * Show the form for editing State.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('state_edit')) {
            return abort(401);
        }
        $state = State::findOrFail($id);

        return view('admin.states.edit', compact('state'));
    }

    /**
     * Update State in storage.
     *
     * @param  \App\Http\Requests\UpdateStatesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStatesRequest $request, $id)
    {
        if (! Gate::allows('state_edit')) {
            return abort(401);
        }
        $state = State::findOrFail($id);
        $state->update($request->all());

        $companies           = $state->companies;
        $currentCompanyData = [];
        foreach ($request->input('companies', []) as $index => $data) {
            if (is_integer($index)) {
                $state->companies()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentCompanyData[$id] = $data;
            }
        }
        foreach ($companies as $item) {
            if (isset($currentCompanyData[$item->id])) {
                $item->update($currentCompanyData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.states.index');
    }


    /**
     * Display State.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('state_view')) {
            return abort(401);
        }
        $companies = \App\Company::where('state_id', $id)->get();

        $state = State::findOrFail($id);

        return view('admin.states.show', compact('state', 'companies'));
    }


    /**
     * Remove State from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('state_delete')) {
            return abort(401);
        }
        $state = State::findOrFail($id);
        $state->delete();

        return redirect()->route('admin.states.index');
    }

    /**
     * Delete all selected State at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('state_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = State::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore State from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('state_delete')) {
            return abort(401);
        }
        $state = State::onlyTrashed()->findOrFail($id);
        $state->restore();

        return redirect()->route('admin.states.index');
    }

    /**
     * Permanently delete State from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('state_delete')) {
            return abort(401);
        }
        $state = State::onlyTrashed()->findOrFail($id);
        $state->forceDelete();

        return redirect()->route('admin.states.index');
    }
}
