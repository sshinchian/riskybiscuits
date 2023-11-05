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
        Schema::create('work_slots', function (Blueprint $table) {
            $table->id();
            $table->string('time_slot_name')->default(''); // Example: "Morning Shift," "Afternoon Shift"
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
           /*  $table->date('date'); */
            $table->time('start_time'); // Example: 09:00:00
            $table->time('end_time'); // Example: 15:00:00
            $table->unsignedBigInteger('staff_role_id')->comment('1=Chef, 2=Waiter, 3=Cashier');
            $table->integer('quantity');
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->timestamps();

            $table->foreign('staff_role_id')->references('id')->on('staff_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_slots');
    }
};
