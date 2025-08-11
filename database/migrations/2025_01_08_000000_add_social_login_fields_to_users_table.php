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
        Schema::table('users', function (Blueprint $table) {
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('users', 'provider')) {
                $table->string('provider')->nullable()->after('password');
            }
            
            if (!Schema::hasColumn('users', 'provider_id')) {
                $table->string('provider_id')->nullable()->after('provider');
            }
            
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('provider_id');
            }
        });

        // Add indexes only if they don't exist
        if (!$this->indexExists('users', ['provider', 'provider_id'])) {
            Schema::table('users', function (Blueprint $table) {
                $table->index(['provider', 'provider_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop index first if it exists
            if ($this->indexExists('users', ['provider', 'provider_id'])) {
                $table->dropIndex(['provider', 'provider_id']);
            }
            
            // Drop columns if they exist
            if (Schema::hasColumn('users', 'avatar')) {
                $table->dropColumn('avatar');
            }
            
            if (Schema::hasColumn('users', 'provider_id')) {
                $table->dropColumn('provider_id');
            }
            
            if (Schema::hasColumn('users', 'provider')) {
                $table->dropColumn('provider');
            }
        });
    }

    /**
     * Check if an index exists on a table
     */
    private function indexExists(string $table, array $columns): bool
    {
        $indexes = Schema::getConnection()->getDoctrineSchemaManager()->listTableIndexes($table);
        
        foreach ($indexes as $index) {
            if ($index->getColumns() === $columns) {
                return true;
            }
        }
        
        return false;
    }
};