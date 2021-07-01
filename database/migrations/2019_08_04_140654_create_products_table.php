<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('vendor_id')->nullable();
            $table->unsignedInteger('brand_id')->nullable();
            $table->string('title', 255);
            $table->string('slug', 271);
            $table->string('image', 300)->nullable();
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('discount')->default(0);
            $table->unsignedInteger('admin_profit_percentage')->default(0);
            $table->boolean('discount_type')->default(1)->comment('1:amount 0:percentage');
            $table->float('user_price', 8, 2);
            $table->float('whole_sheller_price', 8, 2)->nullable();
            $table->text('description')->nullable();
            $table->text('specification')->nullable();
            $table->text('review')->nullable();
            $table->boolean('gender')->nullable()->comment('1:male 0:female null:other');
            $table->boolean('featured')->default(0);
            $table->boolean('sale')->default(0);
            $table->boolean('hot')->default(0);
            $table->boolean('popular')->default(0);
            $table->integer('view_count')->default(0);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
