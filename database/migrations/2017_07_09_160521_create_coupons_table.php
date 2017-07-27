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
            $table->text('meta_keywords')->nullable();
            $table->integer("price")->nullable();
            $table->integer('old_price')->nullable();
            $table->string('currency')->default('KZT');
            $table->integer("coupon_type")->default(1);
            $table->dateTime('available_until');
            $table->integer('count')->nullable(); // if is limited only
            $table->integer('coupon_category');
            $table->integer('min_age')->default(0);
            $table->integer('views')->nullable();
            $table->boolean('is_show')->default(0);
            $table->boolean('is_hit')->default(0);
            $table->boolean('is_new')->default(true);
            $table->boolean('is_border')->default(0);
            $table->integer('costs')->nullable(); // publish fee
            $table->string('image');
            $table->integer('company_id')->default(1);
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
