<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5bb4a5b8ccc93CategoryCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('category_company')) {
            Schema::create('category_company', function (Blueprint $table) {
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id', 'fk_p_214900_214911_compan_5bb4a5b8ccd92')->references('id')->on('product_categories')->onDelete('cascade');
                $table->integer('company_id')->unsigned()->nullable();
                $table->foreign('company_id', 'fk_p_214911_214900_catego_5bb4a5b8cce1c')->references('id')->on('companies')->onDelete('cascade');
                
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
        Schema::dropIfExists('category_company');
    }
}
