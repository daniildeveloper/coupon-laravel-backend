<?php

use Illuminate\Database\Seeder;
use App\Model\OrderStatus as S;

class OrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $s1 = new S();
        $s1->name = 'Счет выставлен';
        $s1->slug = 'created';
        $s1->save();

        $s2 = new S();
        $s2->name = 'Счет оплачен';
        $s2->slug = 'payed';
        $s2->save();

        $s3 = new S();
        $s3->name = 'Счет отклонен';
        $s3->slug = 'rejected';
        $s3->save();

        $s4 = new S();
        $s4->name = 'Возврат средств';
        $s4->slug = 'returned';
        $s4->save();
    }
}
