<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticlesContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_contents', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('article_id')->default(0)->comment('所属文章ID');
            $table->text('content')->comment('文章标题');
            $table->timestamps();
            // 索引
            $table->index('article_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles_contents');
    }
}
