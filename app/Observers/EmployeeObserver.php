<?php

namespace App\Observers;

use App\Models\Employee;

class EmployeeObserver
{
    public function creating(Employee $employee)
    {
        $today = date('Ymdhis');
        $branch_id = app()->environment() == 'local' ? 1 : auth()->user()->branch_id;

        $employeeUniqueIds = Employee::whereBranchId($branch_id)->where('unique_id', 'like', '%'.$today.'%')->pluck('id');

        do {
            $code = $today.str_pad(count($employeeUniqueIds) + 1, 3, '0', STR_PAD_LEFT);
        } while ($employeeUniqueIds->contains($code));
        $employee->unique_id = $code;
    }
}
