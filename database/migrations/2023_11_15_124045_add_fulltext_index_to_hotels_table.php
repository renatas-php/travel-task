<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            // Add a FULLTEXT index on the columns you want to search
            DB::statement('ALTER TABLE hotels ADD FULLTEXT fulltext_index(hotel_name)');
            //$table->index(['hotel_name'], 'fulltext_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropIndex('fulltext_index');
        });
    }
};
