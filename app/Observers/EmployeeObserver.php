<?php

namespace App\Observers;

use App\Models\Employee;

class EmployeeObserver
{
    public function creating(Employee $employee)
    {
        $today = date('Ymdhis');
        $employeeUniqueIds = Employee::whereBranchId(auth()->user()->branch_id)->where('created_at', 'like', '%'.$today.'%')->pluck('id');
        do {
            $code = $today.str_pad(count($employeeUniqueIds) + 1, 3, '0', STR_PAD_LEFT);
        } while ($employeeUniqueIds->contains($code));
        $employee->unique_id = $code;
    }
}
