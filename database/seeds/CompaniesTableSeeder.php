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
        $water->name = "Вода";
        $water->address = 'Some address';
        $water->primary_phone = '+7800000000';
        $water->company_type = 1;
        $water->save();
    }
}
