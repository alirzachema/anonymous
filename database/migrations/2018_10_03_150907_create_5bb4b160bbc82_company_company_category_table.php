<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5bb4b160bbc82CompanyCompanyCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('company_company_category')) {
            Schema::create('company_company_category', function (Blueprint $table) {
                $table->integer('company_id')->unsigned()->nullable();
                $table->foreign('company_id', 'fk_p_214911_214930_compan_5bb4b160bbe2c')->references('id')->on('companies')->onDelete('cascade');
                $table->integer('company_category_id')->unsigned()->nullable();
                $table->foreign('company_category_id', 'fk_p_214930_214911_compan_5bb4b160bbf34')->references('id')->on('company_categories')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_company_category');
    }
}
