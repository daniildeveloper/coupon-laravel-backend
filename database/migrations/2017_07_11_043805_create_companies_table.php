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
            $table->string('name');
            $table->text('address');
            $table->string('primary_phone');
            $table->string('second_phone')->nullable();
            $table->string('logo')->default('images/logo-inline.png');
            $table->string('second_image')->nullable();
            $table->integer('company_type');
            // $table->integer
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
