<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // helpers tables seeder
        $this->call(OrderStatusesTableSeeder::class);
        $this->call(CouponsCategoriesTableSeeder::class);
        $this->call(CompanyTypesTableSeeder::class);
        $this->call(UsersRolesTableSeeder::class);
        
        // Demo data tables seeder
        $this->call(UsersTableSeeder::class);
        $this->call(CouponTypesTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(CouponsTableSeeder::class);
    }
}
