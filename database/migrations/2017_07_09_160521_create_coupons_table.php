<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title");
            $table->string("short_description");
            $table->text("description");
            $table->text('meta_keywords');
            $table->integer("price");
            $table->integer('old_price')->nullable();
            $table->integer('currency')->default(856);
            $table->integer("coupon_type")->default(1);
            $table->dateTime('available_until');
            $table->integer('count')->nullable(); // if is limited only
            $table->integer('coupon_category');
            $table->integer('min_age')->default(0);
            $table->integer('views');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
