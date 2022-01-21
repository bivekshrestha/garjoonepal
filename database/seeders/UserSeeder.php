<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->truncate();

        $admin = Role::where('slug', 'admin')->first();
        $seller = Role::where('slug', 'seller')->first();
        $buyer = Role::where('slug', 'buyer')->first();

        $data =  [
            'first_name' => 'Sajan',
            'last_name' => 'Aryal',
            'email' => 'admin@garjoonepal.com',
            'password' => 'password',
            'is_active' => true,
            'is_verified' => true,
            'activated_by' => 'self',
            'email_verified_at' => Carbon::now()
        ];

        $user = User::create($data);
        $user->roles()->attach($admin);

        $data =   [
            'first_name' => 'Yuvraj',
            'last_name' => 'Timalsina',
            'email' => 'seller@garjoonepal.com',
            'password' => 'password',
            'is_active' => true,
            'activated_by' => 'admin',
            'is_verified' => true,
            'email_verified_at' => Carbon::now()
        ];

        $user = User::create($data);
        $user->roles()->attach($seller);

        $data = [
            'first_name' => 'Bivek',
            'last_name' => 'Shrestha',
            'email' => 'buyer@garjoonepal.com',
            'password' => 'password',
            'activated_by' => 'admin',
            'is_active' => true,
            'is_verified' => true,
            'email_verified_at' => Carbon::now()
        ];

        $user = User::create($data);
        $user->roles()->attach($buyer);
    }
}
