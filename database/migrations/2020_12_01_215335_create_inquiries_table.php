<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id')->comment('メンバーID');
            $table->integer('admin_id')->nullable()->comment('回答者ID');
            $table->integer('speaker')->comment('しゃべっている人');
            $table->text('comment')->comment('コメント');
            $table->integer('status')->comment('既読ステータス');
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
        Schema::dropIfExists('inquiries');
    }
}
