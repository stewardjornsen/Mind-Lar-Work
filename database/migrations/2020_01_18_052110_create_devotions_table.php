<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devotions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('topic');
            $table->string('bible_ref');
            $table->longText('study')->nullable();
            $table->date('devotion_date');
            $table->text('top_quote')->nullable();
            $table->mediumText('prayers')->nullable();
            $table->text('further_reading')->nullable();
            $table->string('author')->nullable();
            $table->string('photo')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('devotions');
    }
}
