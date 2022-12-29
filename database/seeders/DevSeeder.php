<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment('local')) {
            Employee::factory()->count(10)->create([
                'branch_id' => 1,
                'type' => Employee::FRONTDESK,
            ]);
        }
    }
}
