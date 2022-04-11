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
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('billing_name')->nullable();           
            $table->string('billing_address')->nullable();            
            $table->string('billing_phone')->nullable();

            $table->string('startDate');
            $table->string('endDate');
            $table->integer('late');
            $table->integer('other_fine');
            $table->integer('billing_subtotal');
            $table->integer('billing_deposit');
            $table->integer('billing_refund');
            $table->integer('billing_total');    
    
            $table->string('account_name');
            $table->string('account_no');
            $table->string('bank_name');
            
            $table->string('tracking_no_send');  
            $table->string('image_payment_return')->default(false);
            $table->string('image_return_slip')->default(false);
            $table->string('payment_slip')->default(false);
            $table->string('status')->default(1);
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
        Schema::dropIfExists('orders');
    }
};
