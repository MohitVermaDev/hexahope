<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopupWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topup_wallet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('user_id');
            $table->Integer('wallet_id');
            $table->decimal('amount',20,2);
            $table->Integer('sent_by')->nullable()->default(0);
            $table->Integer('sent_from')->nullable()->default(0);
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
        Schema::dropIfExists('topup_wallet');
    }
}
