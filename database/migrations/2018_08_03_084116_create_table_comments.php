<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('ip', 64)->comment('IP地址');
            $table->string('name', 128)->comment('评论人名称');
            $table->string('title', 128)->comment('评论title');
            $table->text('content');
            $table->integer('object_id')->comment('评论对象的ID主键');
            $table->tinyInteger('show')->comment('是否显示,1:显示;2:隐藏');
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
        Schema::drop('comments');
    }
}
