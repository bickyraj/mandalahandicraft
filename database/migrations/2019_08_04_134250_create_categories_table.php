<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->boolean('is_parent')->default(0)->nullable()->comment('0:main parent');
            $table->string('name', 255);
            $table->string('slug', 255)->nullable();
            $table->string('image', 500)->nullable();
            $table->boolean('show_on_menu')->default(0)->comment('1:show on menu');
            $table->boolean('exclusive')->default(0);
            $table->unsignedInteger('priority')->default(999);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('categories');
    }
}
