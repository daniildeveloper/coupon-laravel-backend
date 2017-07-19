<?php
use App\Coupon;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $canoe = new Coupon();
        $canoe->title = 'Аренда каное';
        $canoe->short_description = 'Почасовая аренда каное';
        $canoe->description = "Почасовая аренда каное";
        $canoe->price = 1200;
        $canoe->old_price = 2000;
        $canoe->available_until = Carbon::now()->addWeeks(3);
        $canoe->is_show = 1;
        $canoe->image = 'images/seed/каноэ.jpg';
        $canoe->coupon_category = 1;
        $canoe->save();
    }
}
