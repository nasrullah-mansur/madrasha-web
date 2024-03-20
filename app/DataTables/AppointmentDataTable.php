<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\Appointment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class AppointmentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'users.action')
            ->addIndexColumn()
            ->editColumn('created_at', function ($data) {
                return $data->created_at->diffForHumans(); // human readable format
            })


            ->editColumn('name', function ($data) {
                return "<span class='text-nowrap mb-0'>$data->name</span>";
            })

            ->editColumn('email', function ($data) {
                return "<span class='text-nowrap mb-0'>$data->email</span>";
            })

            ->editColumn('phone', function ($data) {
                return "<span class='text-nowrap mb-0'>$data->phone</span>";
            })

            ->editColumn('day', function ($data) {
                return "<span class='text-nowrap mb-0'>$data->day</span>";
            })

            ->editColumn('time', function ($data) {
                return "<span class='text-nowrap mb-0'>$data->time</span>";
            })

            ->editColumn('action', function ($data) {
                return
                    '<div class="d-flex action-btn">
                        <a data-id="' . $data->id . '" class="btn btn-icon btn-danger delete-data" style="margin-right: 5px;" href="#"><i class="ft-trash-2"></i></a> 
                        <a class="btn btn-icon btn-info" style="margin-right: 5px;" href="' . route('pdf.create', $data->id) . '"><i class="fa fa-file-pdf-o"></i></a> 
                    </div>';
            })
            ->rawColumns([
                'action', 
                'name', 
                'email',
                'phone',
                'day',
                'time',
                'fee',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Appointment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Appointment $model): QueryBuilder
    {
        $tenDaysAgo = Carbon::now()->subDays(30)->toDateString();
        
        return $model
        ->whereDate('created_at', '>=', $tenDaysAgo)
        ->orderBy('created_at', 'DESC')
        ->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->addIndex()
            ->setTableId('data-table')->addTableClass('table table-striped table-bordered zero-configuration dataTable')->autoWidth()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->serverSide(true)
            ->dom('lBfrtip')
            ->orderBy(0)
            ->buttons(
                Button::make('copy')->addClass('btn-secondary'),
                Button::make('print')->addClass('btn-secondary'),
                Button::make('pdf')->addClass('btn-secondary'),
                Button::make('excel')->addClass('btn-secondary'),
                Button::make('colvis')->text('Show')->addClass('btn-secondary'),
            );
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('SL')->orderable(false)->searchable(false),
            Column::make('chamber'),
            Column::make('name'),
            Column::make('email'),
            Column::make('phone'),
            Column::make('day'),
            Column::make('fee'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('table-actions'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Appointment_' . date('YmdHis');
    }
}
