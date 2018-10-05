<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1538565617CompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            if(Schema::hasColumn('companies', 'location_id')) {
                $table->dropForeign('214911_5bb4a5b8153cd');
                $table->dropIndex('214911_5bb4a5b8153cd');
                $table->dropColumn('location_id');
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
                        
        });

    }
}
