<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoryTableOfContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_category_table_of_contents', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('visa_sub_category_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('bullets')->nullable();
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
        Schema::dropIfExists('sub_category_table_of_contents');
    }
}
