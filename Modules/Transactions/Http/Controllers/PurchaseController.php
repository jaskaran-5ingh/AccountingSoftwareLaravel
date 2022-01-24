<?php

namespace Modules\Transactions\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Modules\Transactions\DataTables\PurchaseDataTable;
use Modules\Transactions\Entities\Purchase;
use Modules\Transactions\Http\Requests\PurchaseSaveRequest;
use Modules\Transactions\Http\Requests\PurchaseUpdateRequest;
use Session;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param PurchaseDataTable $dataTable
     * @return void
     */
    public function index(PurchaseDataTable $dataTable)
    {
        return $dataTable->render('transactions::purchases.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('transactions::purchases.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param PurchaseSaveRequest $request
     * @return RedirectResponse
     */
    public function store(PurchaseSaveRequest $request): RedirectResponse
    {
        Purchase::create($request->validated());
        Session::flash("success", "Success|Purchase has been created successfully");
        return back();
    }

    /**
     * Show the specified resource.
     * @param Purchase $purchase
     * @return Renderable
     */
    public function show(Purchase $purchase): Renderable
    {
        return view('transactions::purchases.show', ['model' => $purchase]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Purchase $purchase
     * @return Renderable
     */
    public function edit(Purchase $purchase): Renderable
    {
        return view('transactions::purchases.edit', ['model' => $purchase]);
    }

    /**
     * Update the specified resource in storage.
     * @param PurchaseUpdateRequest $request
     * @param Purchase $purchase
     * @return RedirectResponse
     */
    public function update(PurchaseUpdateRequest $request, Purchase $purchase): RedirectResponse
    {
        $purchase->update($request->validated());
        Session::flash("success", "Success|Purchase has been updated successfully");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Purchase $purchase
     * @return RedirectResponse
     */
    public function destroy(Purchase $purchase): RedirectResponse
    {
        $purchase->delete();
        Session::flash("success", "Success|Purchase has been deleted successfully");
        return back();
    }
}
