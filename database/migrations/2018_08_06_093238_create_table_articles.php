<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('category_id')->default(0)->comment('所属分类ID');
            $table->string('title', 255)->default('')->comment('文章标题');
            $table->integer('view')->default(0)->comment('文章被阅读次数');
            $table->tinyInteger('publish')->default(0)->comment('是否发布；1：发布；2：未发布');
            $table->tinyInteger('delete')->default(0)->comment('是否发布；1：未删除；2：删除');
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
        Schema::drop('articles');
    }
}
