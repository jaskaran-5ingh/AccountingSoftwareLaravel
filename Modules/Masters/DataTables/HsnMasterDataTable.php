<?php

namespace Modules\Masters\DataTables;


use Modules\Masters\Entities\HsnMaster;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class HsnMasterDataTable extends DataTable
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
                return view('masters::hsn_master._action', compact('model'));
            })->editColumn('created_at', function ($model) {
                if (is_null($model->created_at)) return null;
                return $model->created_at->format('d-m-Y h:i:s A');
            })->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param HsnMaster $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(HsnMaster $model): \Illuminate\Database\Eloquent\Builder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html(): Builder
    {
        return $this->builder()
            ->setTableId('hsn-master-datatable-table')
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
            Column::make('hsn_code')->title('HSN Code'),
            Column::make('min_amount')->title('Min Amount'),
            Column::make('gst_min_percentage')->title('GST Min(%)'),
            Column::make('gst_max_percentage')->title('GST Max(%)'),
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
        return 'HsnMaster_' . date('YmdHis');
    }
}
