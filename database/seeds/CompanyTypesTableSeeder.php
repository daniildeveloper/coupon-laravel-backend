<?php

use App\Model\CompanyType;
use Illuminate\Database\Seeder;

class CompanyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // супер маркет
        $supermarket       = new CompanyType();
        $supermarket->slug = 'supermarket';
        $supermarket->name = 'Супермаркет';
        $supermarket->save();

        // аква парк
        $aqua       = new CompanyType();
        $aqua->slug = 'aquapark';
        $aqua->name = 'Аквапарк';
        $aqua->save();

        // салон красоты
        $beauty       = new CompanyType();
        $beauty->slug = 'beauty';
        $beauty->name = 'Салон красоты';
        $beauty->save();

        // боулинг
        $bouling       = new CompanyType();
        $bouling->slug = 'bouling';
        $bouling->name = 'Боулинг';
        $bouling->save();

        // bordel
        $bordel       = new CompanyType();
        $bordel->name = 'Бордель';
        $bordel->slug = 'bordel';
        $bordel->save();
    }
}
