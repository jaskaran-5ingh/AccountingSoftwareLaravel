<?php

namespace Modules\Masters\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Modules\Masters\DataTables\ItemGroupMasterDataTable;
use Modules\Masters\Entities\AccountSubGroup;
use Modules\Masters\Entities\ItemGroupMaster;
use Modules\Masters\Entities\ItemSubGroup;
use Modules\Masters\Http\Requests\ItemGroupMasterSaveRequest;
use Modules\Masters\Http\Requests\ItemGroupMasterUpdateRequest;
use Session;

class ItemGroupMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return void
     */
    public function index(ItemGroupMasterDataTable $dataTable)
    {
        return $dataTable->render('masters::items_group_master.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('masters::items_group_master.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param ItemGroupMasterSaveRequest $request
     * @return RedirectResponse
     */
    public function store(ItemGroupMasterSaveRequest $request): RedirectResponse
    {
        $itemGroup = ItemGroupMaster::create($request->validated());
        if($request->is_primary !== 'on' && !is_null($request->sub_group_id)){
            ItemSubGroup::create([
                'parent_id' => $request->sub_group_id,
                'child_id' => $itemGroup->id,
            ]);
        }
        Session::flash('success', 'Success|Item Group Master Created Successfully');
        return back();
    }

    /**
     * Show the specified resource.
     * @param ItemGroupMaster $items_group
     * @return Renderable
     */
    public function show(ItemGroupMaster $items_group): Renderable
    {
        return view('masters::items_group_master.view', ['model' => $items_group]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param ItemGroupMaster $items_group
     * @return Renderable
     */
    public function edit(ItemGroupMaster $items_group): Renderable
    {
        return view('masters::items_group_master.edit', ['model' => $items_group]);
    }

    /**
     * Update the specified resource in storage.
     * @param ItemGroupMasterUpdateRequest $request
     * @param ItemGroupMaster $items_group
     * @return RedirectResponse
     */
    public function update(ItemGroupMasterUpdateRequest $request, ItemGroupMaster $items_group): RedirectResponse
    {
        ItemSubGroup::where('child_id', $items_group->id)->delete();
        if (is_null($request->is_primary)) {
            if (is_null($request->sub_group_id)) {
                Session::flash('error', 'Error|Please Select Sub Group');
                return back();
            }
            ItemSubGroup::create([
                'parent_id' => $request->sub_group_id,
                'child_id' => $items_group->id,
            ]);
            $items_group->update($request->validated() + ['is_primary' => 0]);
        } else {
            $items_group->update($request->validated());
        }Session::flash('success', 'Success|Item Group Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param ItemGroupMaster $items_group
     * @return RedirectResponse
     */
    public function destroy(ItemGroupMaster $items_group): RedirectResponse
    {
        $items_group->delete();
        Session::flash('success', 'Success|Item Group Deleted Successfully');
        return back();
    }
}
