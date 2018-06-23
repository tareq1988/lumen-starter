<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(['name' => 'user']);
        Role::firstOrCreate(['name' => 'manager']);
        Role::firstOrCreate(['name' => 'admin']);
    }
}
