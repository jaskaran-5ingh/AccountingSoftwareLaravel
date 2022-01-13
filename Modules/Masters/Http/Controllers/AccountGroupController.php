<?php

namespace Modules\Masters\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Modules\Masters\DataTables\UnitMasterDataTable;
use Modules\Masters\Entities\AccountGroup;
use Modules\Masters\Entities\AccountSubGroup;
use Modules\Masters\Http\Requests\AccountGroupSaveRequest;
use Modules\Masters\Http\Requests\AccountGroupUpdateRequest;
use Session;

class AccountGroupController extends Controller
{

    public function index(UnitMasterDataTable $dataTable)
    {
        return $dataTable->render('masters::account_group.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('masters::account_group.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param AccountGroupSaveRequest $request
     * @return RedirectResponse
     */
    public function store(AccountGroupSaveRequest $request): RedirectResponse
    {

        $accountGroup = AccountGroup::create($request->validated());
        if($request->is_primary !== 'on' && !is_null($request->sub_group_id)){
            AccountSubGroup::create([
                'parent_id' => $request->sub_group_id,
                'child_id' => $accountGroup->id,
            ]);
        }
        Session::flash('success', 'Success|Account Group Created Successfully');
        return redirect()->route('group.index');
    }

    /**
     * Show the specified resource.
     * @param AccountGroup $group
     * @return Renderable
     */
    public function show(AccountGroup $group): Renderable
    {
        return view('masters::account_group.view', ['model' => $group->load('children', 'parent')]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param AccountGroup $group
     * @return Renderable
     */
    public function edit(AccountGroup $group): Renderable
    {
        return view('masters::account_group.edit', ['model' => $group]);
    }

    /**
     * Update the specified resource in storage.
     * @param AccountGroupUpdateRequest $request
     * @param AccountGroup $group
     * @return RedirectResponse
     */
    public function update(AccountGroupUpdateRequest $request, AccountGroup $group): RedirectResponse
    {
        $group->update($request->validated());
        Session::flash('success', 'Success|Account Group Updated Successfully');
        return redirect()->route('group.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param AccountGroup $group
     * @return RedirectResponse
     */
    public function destroy(AccountGroup $group): RedirectResponse
    {
        dd($group);
    }
}