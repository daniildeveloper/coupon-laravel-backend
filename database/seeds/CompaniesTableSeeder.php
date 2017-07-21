<?php

use App\Company;

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // first demo company
        $water = new Company();
        $water->user_id = 3;
        $water->seller_name = "Вода";
        $water->seller_address = 'Some address';
        $water->seller_primary_phone = '+7800000000';
        $water->seller_company_type = 1;
        $water->save();
    }
}
