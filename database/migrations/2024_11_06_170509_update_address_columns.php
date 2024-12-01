<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            // Rename columns to match your form's input names
            $table->renameColumn('address_line1', 'address_line_1');
            $table->renameColumn('address_line2', 'address_line_2');
            
            // Add any other necessary modifications (optional)
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            //
        });
    }
};
