<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id");
            $table->string('seller_name');
            $table->text('seller_address');
            $table->string('seller_primary_phone');
            $table->string('seller_second_phone')->nullable();
            $table->string('seller_logo')->default('images/logo-inline.png');
            $table->string('seller_second_image')->nullable();
            $table->integer('seller_company_type');
            $table->boolean('confirmed')->default(true);
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
        Schema::dropIfExists('companies');
    }
}
