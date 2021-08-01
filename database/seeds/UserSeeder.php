<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;

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
            'name' => 'production',
            'email' => 'production@gmail.com',
            'password' => Hash::make('123456')
        ]);

        $user->assignRole('production');

        $user = User::create([
            'name' => 'warehouse',
            'email' => 'warehouse@gmail.com',
            'password' => Hash::make('123456')
        ]);

        $user->assignRole('warehouse');
    }
}
