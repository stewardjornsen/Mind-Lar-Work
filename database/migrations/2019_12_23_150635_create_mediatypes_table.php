<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediatypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediatypes', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('type');
            $table->string('category');
            $table->timestamps();
        });
    }

    //INSERT INTO `mediatypes` (`id`, `type`, `category`, `created_at`, `updated_at`) VALUES ('pdf', 'eBook PDF', 'Book', NULL, NULL), ('mp3', 'Audio', 'Audio', NULL, NULL), ('mp4', 'H.264 Video (MP4)', 'Video', NULL, NULL), ('youtube', 'YouTube Video', 'Video', NULL, NULL), ('docx', 'MicroSoft Office Word', 'Book', NULL, NULL), ('zip', 'Zip', 'Download', NULL, NULL);
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mediatypes');
    }
}
