<?php

/**
 * Migration Script: SQLite to PostgreSQL
 * 
 * This script helps migrate your data from SQLite to PostgreSQL
 * Run this after setting up your PostgreSQL database
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "Starting migration from SQLite to PostgreSQL...\n";

try {
    // Step 1: Connect to SQLite (source)
    $sqliteConfig = [
        'driver' => 'sqlite',
        'database' => __DIR__ . '/database.sqlite',
        'prefix' => '',
    ];
    
    // Step 2: Connect to PostgreSQL (destination)
    $pgsqlConfig = [
        'driver' => 'pgsql',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '5432'),
        'database' => env('DB_DATABASE', 'dnd_computers_ecom'),
        'username' => env('DB_USERNAME', 'postgres'),
        'password' => env('DB_PASSWORD', ''),
        'charset' => 'utf8',
        'prefix' => '',
        'search_path' => 'public',
        'sslmode' => 'prefer',
    ];
    
    echo "✓ Configuration loaded\n";
    
    // Step 3: Create PostgreSQL connection
    $pgsqlConnection = new PDO(
        "pgsql:host={$pgsqlConfig['host']};port={$pgsqlConfig['port']};dbname={$pgsqlConfig['database']}",
        $pgsqlConfig['username'],
        $pgsqlConfig['password']
    );
    
    echo "✓ Connected to PostgreSQL\n";
    
    // Step 4: Check if SQLite database exists
    if (!file_exists($sqliteConfig['database'])) {
        echo "❌ SQLite database not found at: {$sqliteConfig['database']}\n";
        echo "Please ensure your SQLite database exists before running this script.\n";
        exit(1);
    }
    
    echo "✓ SQLite database found\n";
    
    // Step 5: Create SQLite connection
    $sqliteConnection = new PDO("sqlite:{$sqliteConfig['database']}");
    $sqliteConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✓ Connected to SQLite\n";
    
    // Step 6: Get all tables from SQLite
    $tables = $sqliteConnection->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'")->fetchAll(PDO::FETCH_COLUMN);
    
    echo "Found tables: " . implode(', ', $tables) . "\n";
    
    // Step 7: Migrate each table
    foreach ($tables as $table) {
        echo "Migrating table: {$table}\n";
        
        // Get table structure
        $columns = $sqliteConnection->query("PRAGMA table_info({$table})")->fetchAll(PDO::FETCH_ASSOC);
        
        // Create table in PostgreSQL
        $createTableSQL = "CREATE TABLE IF NOT EXISTS {$table} (";
        $columnDefinitions = [];
        
        foreach ($columns as $column) {
            $name = $column['name'];
            $type = $column['type'];
            $notNull = $column['notnull'] ? ' NOT NULL' : '';
            $default = $column['dflt_value'] ? " DEFAULT '{$column['dflt_value']}'" : '';
            $primaryKey = $column['pk'] ? ' PRIMARY KEY' : '';
            
            // Map SQLite types to PostgreSQL types
            $pgType = match (strtolower($type)) {
                'integer' => 'INTEGER',
                'real' => 'REAL',
                'text' => 'TEXT',
                'blob' => 'BYTEA',
                'boolean' => 'BOOLEAN',
                default => 'TEXT'
            };
            
            $columnDefinitions[] = "{$name} {$pgType}{$notNull}{$default}{$primaryKey}";
        }
        
        $createTableSQL .= implode(', ', $columnDefinitions) . ")";
        
        try {
            $pgsqlConnection->exec($createTableSQL);
            echo "  ✓ Table structure created\n";
        } catch (Exception $e) {
            echo "  ❌ Error creating table: " . $e->getMessage() . "\n";
            continue;
        }
        
        // Migrate data
        $rows = $sqliteConnection->query("SELECT * FROM {$table}")->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($rows)) {
            echo "  ✓ No data to migrate\n";
            continue;
        }
        
        $inserted = 0;
        foreach ($rows as $row) {
            $columns = array_keys($row);
            $placeholders = ':' . implode(', :', $columns);
            $insertSQL = "INSERT INTO {$table} (" . implode(', ', $columns) . ") VALUES ({$placeholders})";
            
            try {
                $stmt = $pgsqlConnection->prepare($insertSQL);
                $stmt->execute($row);
                $inserted++;
            } catch (Exception $e) {
                echo "  ⚠️  Error inserting row: " . $e->getMessage() . "\n";
            }
        }
        
        echo "  ✓ Migrated {$inserted} rows\n";
    }
    
    echo "\n🎉 Migration completed successfully!\n";
    echo "Your data has been migrated from SQLite to PostgreSQL.\n";
    
} catch (Exception $e) {
    echo "❌ Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}
