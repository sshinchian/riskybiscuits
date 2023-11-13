<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->required();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('mobile_number')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('role_id')->default(4)->comment('1=SuperAdmin, 2=CafeOwner, 3=Manager, 4=Staff');
            $table->unsignedBigInteger('staff_role_id')->nullable()->comment('1=Cashier, 2=Chef, 3=Waiter');
            $table->integer('requested_workslots')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->foreign('staff_role_id')->references('id')->on('staff_roles')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
