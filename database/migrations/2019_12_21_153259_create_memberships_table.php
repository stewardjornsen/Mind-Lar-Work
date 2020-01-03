<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('title')->nullable();
            $table->integer('interval')->default(30);
            $table->integer('amount_kobo');
            $table->mediumText('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }


    // INSERT INTO `memberships` (`id`, `type`, `title`, `interval`, `amount`, `description`, `created_at`, `updated_at`) VALUES (NULL, 'Standard (Monthly)', NULL, '30', '500', NULL, '2019-12-23 00:00:00', '2019-12-23 00:00:00'), (NULL, 'Standard (Yearly)', NULL, '30', '5000', NULL, NULL, NULL);

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memberships');
    }
}
