<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shippings', function (Blueprint $table) {
            $table->string('first_name', 191)->nullable()->change();
            $table->string('last_name', 191)->nullable()->change();
            $table->string('contact_number', 191)->nullable()->change();
            $table->string('address', 191)->nullable()->change();
            $table->string('shipping_name', 191)->nullable();
            $table->string('shipping_email', 191)->nullable();
            $table->string('shipping_phone_number', 191)->nullable();
            $table->string('shipping_street_address', 191)->nullable();
            $table->string('shipping_city', 191)->nullable();
            $table->string('shipping_postal_code', 191)->nullable();
            $table->string('shipping_country', 191)->nullable();
            $table->string('billing_name', 191)->nullable();
            $table->string('billing_email', 191)->nullable();
            $table->string('billing_phone_number', 191)->nullable();
            $table->string('billing_street_address', 191)->nullable();
            $table->string('billing_city', 191)->nullable();
            $table->string('billing_postal_code', 191)->nullable();
            $table->string('billing_country', 191)->nullable();
            $table->integer('credit_card_no')->nullable();
            $table->integer('expired_month')->nullable();
            $table->integer('expired_year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shippings', function (Blueprint $table) {
            $table->dropColumn('shipping_name');
            $table->dropColumn('shipping_email');
            $table->dropColumn('shipping_phone_number');
            $table->dropColumn('shipping_street_address');
            $table->dropColumn('shipping_city');
            $table->dropColumn('shipping_postal_code');
            $table->dropColumn('shipping_country');
            $table->dropColumn('billing_name');
            $table->dropColumn('billing_email');
            $table->dropColumn('billing_phone_number');
            $table->dropColumn('billing_street_address');
            $table->dropColumn('billing_city');
            $table->dropColumn('billing_postal_code');
            $table->dropColumn('billing_country');
            $table->dropColumn('credit_card_no');
            $table->dropColumn('expired_month');
            $table->dropColumn('expired_year');
        });
    }
}
