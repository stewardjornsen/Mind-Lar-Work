<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('url', 255);
            $table->string('type')->default('pdf');
            $table->bigInteger('person_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
//INSERT INTO `media` (`id`, `title`, `url`, `type`, `person_id`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Reading Children', 'https://ihnbc.com/children.pdf', 'pdf', NULL, NULL, NULL, NULL), (NULL, 'Watch and Learn', 'https://www.youtube.com/watch?v=C7T1689IvPQ&t=35s', 'pdf', NULL, NULL, NULL, NULL);
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
}
