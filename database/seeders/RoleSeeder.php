<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Seo Analyst'],
            ['name' => 'Buyer'],
            ['name' => 'Seller']
        ];

        foreach ($roles as $role){
            Role::create($role);
        }
    }
}
