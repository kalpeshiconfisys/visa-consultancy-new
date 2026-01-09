<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeAndCategoryIdToSubCategoryTableOfContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_category_table_of_contents', function (Blueprint $table) {
             $table->string('type')->nullable()->after('bullets');
              $table->string('category_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_category_table_of_contents', function (Blueprint $table) {
            //
        });
    }
}
