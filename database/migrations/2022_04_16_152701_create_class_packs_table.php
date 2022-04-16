<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassPacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_packs', function (Blueprint $table) {
            $table->integer('disp_order');
            $table->string('pack_id')->primary();
            $table->string('pack_name');
            $table->string('pack_description');
            $table->string('pack_type');
            $table->integer('total_credit');
            $table->string('tag_name')->nullable();
            $table->integer('validity_month');
            $table->float('pack_price');
            $table->boolean('newbie_first_attend');
            $table->integer('newbie_addition_credit');
            $table->string('newbie_note');
            $table->string('pack_alias');
            $table->float('estimate_price');
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
        Schema::dropIfExists('class_packs');
    }
}
