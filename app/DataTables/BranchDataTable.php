<?php 
namespace App\DataTables;

use App\Models\Branch;
use Yajra\DataTables\Services\DataTable;

class BranchDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'branches.datatables.action'); 
    }

    public function query(Branch $model)
    {
        return $model->newQuery()->with(['business', 'timeSlots']);
    }

    public function html()
    {
        return $this->builder()
            ->columns([
                ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
                ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
                ['data' => 'business.name', 'name' => 'business.name', 'title' => 'Business'],
                ['data' => 'timeSlots.weekday', 'name' => 'timeSlots.weekday', 'title' => 'Weekday'],
                ['data' => 'timeSlots.start_time', 'name' => 'timeSlots.start_time', 'title' => 'Start Time'],
                ['data' => 'timeSlots.end_time', 'name' => 'timeSlots.end_time', 'title' => 'End Time'],
            ])
            ->parameters([
                'responsive' => true,
                'dom' => 'Bfrtip',
                'buttons' => ['export', 'print', 'reset', 'reload'],
            ]);
    }

    protected function filename()
    {
        return 'Branches_' . date('YmdHis');
    }
}

?>