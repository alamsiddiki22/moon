<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {

            $table->id();
            $table->integer('user_id');
            $table->integer('vendor_id');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone_number');
            $table->string('customer_country_id');
            $table->string('customer_city_id');
            $table->longText('customer_address');
            $table->longText('customer_remarks');
            $table->string('payment_method');
            $table->string('payment_status')->default('unpaid');
            $table->string('order_status')->default('processing');
            $table->string('coupon_info')->nullable();
            $table->float('after_discount');
            $table->float('shipping_charge');
            $table->float('order_total');
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
        Schema::dropIfExists('invoices');
    }
}
