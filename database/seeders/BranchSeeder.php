<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branch = Branch::create([
            'name' => 'ALMA RESIDENCES GENSAN',
            'address' => 'Brgy. 1, Gensan, South Cotabato',
        ]);

        $admin = User::create([
            'name' => 'ALMA Admin',
            'email' => 'almaadmin@gmail.com',
            'password' => bcrypt('password'),
            'branch_id' => $branch->id,
            'branch_name' => $branch->name,
        ]);

        $admin->assignRole('admin');

        $frontdesk = User::create([
            'name' => 'ALMA Frontdesk',
            'email' => 'almafrontdesk@gmail.com',
            'password' => bcrypt('password'),
            'branch_id' => $branch->id,
            'branch_name' => $branch->name,
        ]);

        $frontdesk->assignRole('frontdesk');

        $kiosk = User::create([
            'name' => 'ALMA Kiosk',
            'email' => 'almakiosk@gmail.com',
            'password' => bcrypt('password'),
            'branch_id' => $branch->id,
            'branch_name' => $branch->name,
        ]);

        $kiosk->assignRole('kiosk');
    }
}
