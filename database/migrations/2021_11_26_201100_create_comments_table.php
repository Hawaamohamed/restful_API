<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('comments'))
        {
            Schema::create('comments', function (Blueprint $table) {
                $table->integer('id');
                $table->integer('user_id')->unsigned();
                $table->integer('post_id')->unsigned();
                $table->integer('parent_id')->unsigned()->nullable();
                $table->longText('content');
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
