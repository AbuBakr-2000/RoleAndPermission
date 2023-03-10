<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Admin','slug'=>'admin']);
        Role::create(['name' => 'Blogger','slug'=>'blogger']);
        Role::create(['name' => 'Editor','slug'=>'editor']);
    }
}
