<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5bb4a77e10f90CompanyProductCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('company_product_category')) {
            Schema::create('company_product_category', function (Blueprint $table) {
                $table->integer('company_id')->unsigned()->nullable();
                $table->foreign('company_id', 'fk_p_214911_214875_produc_5bb4a77e1116a')->references('id')->on('companies')->onDelete('cascade');
                $table->integer('product_category_id')->unsigned()->nullable();
                $table->foreign('product_category_id', 'fk_p_214875_214911_compan_5bb4a77e11249')->references('id')->on('product_categories')->onDelete('cascade');
                
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
        Schema::dropIfExists('company_product_category');
    }
}
