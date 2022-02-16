<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dcards', function (Blueprint $table) {
            $table->index('Id');
            $table->string('Title');
            $table->string('Content');
            $table->string('Excerpt');
            $table->boolean('AnonymousSchool');
            $table->boolean('AnonymousDepartment');
            $table->boolean('Pinned');
            $table->string('ForumId');
            $table->string('ReplyId');
            $table->timestamp('CreatedAt');
            $table->timestamp('UpdatedAt');
            $table->integer('CommentCount');
            $table->integer('LikeCount');
            $table->boolean('WithNickname');
            $table->string('Tags');
            $table->string('Topics');
            $table->string('Gender');
            $table->string('School');
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
        Schema::dropIfExists('dcards');
    }
}
