<?php

namespace Modules\Masters\DataTables;


use Modules\Masters\Entities\ItemMaster;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ItemMasterDataTable extends DataTable
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
                return view('masters::items_master._action', compact('model'));
            })->editColumn('item_group', function ($model) {
                if (is_null($model->itemGroup)) return null;
                return $model->itemGroup->name;
            })->editColumn('unit', function ($model) {
                if (is_null($model->unit)) return null;
                return $model->unit->name;
            })->editColumn('created_at', function ($model) {
                if (is_null($model->created_at)) return null;
                return $model->created_at->format('d-m-Y h:i:s A');
            })
            ->rawColumns(['is_primary', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param ItemMaster $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ItemMaster $model): \Illuminate\Database\Eloquent\Builder
    {
        return $model->newQuery()->with('itemGroup', 'unit');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html(): Builder
    {
        return $this->builder()
            ->setTableId('item-master-datatable-table')
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
            Column::make('item_group')->title('Item Group'),
            Column::make('unit')->title('Unit'),
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
        return 'ItemMaster_' . date('YmdHis');
    }
}
