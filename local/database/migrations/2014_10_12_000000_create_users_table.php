<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('memberid')->unique()->nullable();
            
            $table->string('sponserid');
           
            $table->string('link_left')->nullable();
            $table->string('link_center')->nullable();
            $table->string('link_right')->nullable();
         
            $table->string('mobile')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('account_type')->nullable();
            $table->string('bname')->nullable();
            $table->string('bifsc')->nullable();
            $table->string('baccno')->nullable();
            $table->bigInteger('isDeleted')->default(0)->nullable();
            $table->string('u_parent')->nullable();
            $table->bigInteger('u_position')->nullable();
            $table->bigInteger('id_active')->default(0)->nullable();
            $table->dateTimeTz('activation_date')->nullable();
            $table->bigInteger('plan_id')->nullable()->default(0);
            $table->string('otp_pass')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('fake_password');
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


