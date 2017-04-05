<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable();
            $table->string('photo_cover')->nullable();
            $table->smallInteger('level')->nullable()->default(2);
            $table->smallInteger('language')->nullable()->default(0);
            $table->string('facebook_id')->nullable();
            $table->boolean('review_liciense')->nullable()->default(1);
            $table->boolean('comment_liciense')->nullable()->default(1);
            $table->string('token_confirm')->nullable();
            $table->integer('score')->unsigned()->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
