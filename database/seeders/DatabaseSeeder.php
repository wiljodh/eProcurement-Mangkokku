<?php

namespace Database\Seeders;

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
        $this->call(UserStatusSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserPermissions::class);
        $this->call(UserSeeder::class);
        $this->call(TenderCategorySeeder::class);
        $this->call(TenderStatusSeeder::class);
        $this->call(TenderSeeder::class);
        $this->call(OfferStatusSeeder::class);
    }
}
