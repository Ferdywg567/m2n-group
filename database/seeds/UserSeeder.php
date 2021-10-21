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
            'name' => 'produksi',
            'email' => 'produksi@gmail.com',
            'password' => Hash::make('123456')
        ]);

        $user->assignRole('production');

        $user = User::create([
            'name' => 'gudang',
            'email' => 'gudang@gmail.com',
            'password' => Hash::make('123456')
        ]);

        $user->assignRole('warehouse');

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin_offline@gmail.com',
            'password' => Hash::make('123456')
        ]);

        $user->assignRole('admin-offline');

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin_online@gmail.com',
            'password' => Hash::make('123456')
        ]);

        $user->assignRole('admin-online');
    }
}
