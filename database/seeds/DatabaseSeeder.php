<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BahanSeeder::class);
        $this->call(PotongSeeder::class);
        $this->call(JahitSeeder::class);
        $this->call(CuciSeeder::class);
        $this->call(RekapitulasiSeeder::class);
        $this->call(FinishingSeeder::class);
        $this->call(WarehouseSeeder::class);
        $this->call(RekapitulasiWarehouseSeeder::class);
    }
}
