<?php

namespace Modules\Masters\DataTables;


use Modules\Masters\Entities\AccountMaster;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AccountMasterDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query): DataTableAbstract
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('action', function ($model) {
                return view('masters::account_master._action', compact('model'));
            })->editColumn('created_at', function ($model) {
                if (is_null($model->created_at)) return null;
                return $model->created_at->format('d-m-Y h:i:s A');
            })->editColumn('account_group_id', function ($model) {
                if (is_null($model->accountGroup)) return null;
                return $model->accountGroup->name;
            })->editColumn('account_type', function ($model) {
                return ucfirst($model->account_type);
            })
            ->rawColumns(['account_group_id', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param AccountMaster $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AccountMaster $model): \Illuminate\Database\Eloquent\Builder
    {
        return $model->newQuery()->orderBy('id')->with('accountGroup');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html(): Builder
    {
        return $this->builder()
            ->setTableId('account-master-datatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('account_group_id')->title('Account Group'),
            Column::make('account_type'),
            Column::make('opening_balance'),
            Column::make('created_at')->title('Created At'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width('150px')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'AccountMaster_' . date('YmdHis');
    }
}
