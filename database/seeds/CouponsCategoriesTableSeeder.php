<?php
use App\Model\CouponsCategory as Category;
use Illuminate\Database\Seeder;

class CouponsCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat1       = new Category();
        $cat1->title = "Еда и напитки";
        $cat1->icon = "fa fa-cutlery";
        $cat1->save();

        $cat2       = new Category();
        $cat2->title = "Мероприятия";
        $cat2->icon = "fa fa-calendar";
        $cat2->save();

        $cat3       = new Category();
        $cat3->icon = "fa fa-female";
        $cat3->title = 'Красота и здоровье';
        $cat3->save();

        $cat5       = new Category();
        $cat5->icon = 'fa fa-bolt';
        $cat5->title = "Фитнесс";
        $cat5->save();

        $cat6       = new Category();
        $cat6->title = "Электроника";
        $cat6->icon = "fa fa-headphones";
        $cat6->save();

        $cat7       = new Category();
        $cat7->icon = "fa fa-shopping-cart";
        $cat7->title = "Скидки в ТЦ";
        $cat7->save();

        $cat8       = new Category();
        $cat8->icon = "fa fa-home";
        $cat8->title = "Сад и дом";
        $cat8->save();

        $cat9       = new Category();
        $cat9->title = "Путешествия";
        $cat9->icon = "fa fa-plane";
        $cat9->save();

    }
}
