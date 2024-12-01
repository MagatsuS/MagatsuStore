<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            // Add the columns for address_line1 and address_line2
            $table->string('address_line_1')->after('id');
            $table->string('address_line_2')->nullable()->after('address_line_1');
        });
    }
    
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            // Drop the columns in case of rollback
            $table->dropColumn('address_line_1');
            $table->dropColumn('address_line_2');
        });
    }
    
};
