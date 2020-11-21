<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->integer('course')->comment('コース');
            $table->integer('classification')->comment('分類');
            $table->integer('order')->nullable()->comment('順番');
            $table->string('title')->nullable()->comment('タイトル');
            $table->text('heading')->nullable()->comment('見出し');
            $table->text('explanation')->nullable()->comment('説明');
            $table->string('movie_link')->nullable()->comment('動画リンク');
            $table->text('question')->nullable()->comment('問題');
            $table->text('commentary')->nullable()->comment('解説回答');
            $table->integer('status')->comment('公開状態'); 
            $table->integer('delete_flag')->comment('削除フラグ');
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
        Schema::dropIfExists('articles');
    }
}
