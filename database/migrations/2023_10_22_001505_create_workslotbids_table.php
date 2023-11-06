<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_slot_bids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_slot_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('status')->default(0)->comment('Status: 0=Pending Approval; 1=Approved; -1=Rejected');
            $table->text('remarks')->nullable();
            $table->integer('cafe_id')->default(1)->nullable();
            $table->foreign('work_slot_id')->references('id')->on('work_slots');
            $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
        Schema::dropIfExists('work_slot_bids');
    }
};
