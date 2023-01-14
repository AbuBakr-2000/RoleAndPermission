<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username'=>'abubakr',
            'name' => 'Abu Bakr',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('11111111'),
        ]);
        $user->roles()->attach([1,2,3]);

        $user3 = User::create([
            'username'=>'abdulloh',
            'name' => 'Abdulloh',
            'email' => 'abdulloh@gmail.com',
            'password' => Hash::make('11111111'),
        ]);
        $user3->roles()->attach([2]);
    }
}
