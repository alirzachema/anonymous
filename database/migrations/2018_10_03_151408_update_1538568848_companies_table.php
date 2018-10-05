<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1538568848CompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            
if (!Schema::hasColumn('companies', 'company_logo')) {
                $table->string('company_logo')->nullable();
                }
if (!Schema::hasColumn('companies', 'country')) {
                $table->string('country');
                }
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('company_logo');
            $table->dropColumn('country');
            
        });

    }
}
