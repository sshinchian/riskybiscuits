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
        Schema::create('staff_role_bids', function (Blueprint $table) {
            $table->id();
            $table->integer('cafe_id')->default(1)->nullable();
            $table->integer('staff_role_id');
            $table->integer('user_id');
            $table->integer('status')->default(0)->comment('Status: 0=Pending Approval; 1=Approved; -1=Rejected');
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('staff_role_bids');
    }
};
