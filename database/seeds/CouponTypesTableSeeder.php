<?php

use Illuminate\Database\Seeder;
use App\Model\CouponTypes as Type;

class CouponTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultT = new Type();
        $defaultT->slug = 'default';
        $defaultT->description = 'Обычный купон. Дает право на скидку. Не лимиторован по количеству, но имеет срок годности. Может быть передан одному лицу.';
        $defaultT->save();

        $limited = new Type();
        $limited->slug = 'limited';
        $limited->description = 'Купон с ограниченным количеством. Используем для купонов с ограниченным количеством';
        $limited->save();
    }
}
