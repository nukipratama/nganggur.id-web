<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->boolean('partner_finish')->nullable();
            $table->unsignedBigInteger('subtype_id');
            $table->bigInteger('budget');
            $table->string('title');
            $table->text('description');
            $table->integer('status_id')->default(0);
            $table->unsignedBigInteger('views')->default(0);
            $table->integer('duration');
            $table->timestamp('withdraw_at')->nullable();
            $table->timestamp('withdraw_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('partner_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
