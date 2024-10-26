<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Core\Database;

// Connect to the database
$db = Database::getInstance();

// Get all migration files
$migrationFiles = glob(__DIR__ . '/*.php');

// Fetch applied migrations
$appliedMigrations = $db->query("SELECT migration FROM migrations")->fetchAll(PDO::FETCH_COLUMN);
// print_r($appliedMigrations);die();

echo "Applied migrations: " . implode(", ", $appliedMigrations) . "\n"; // Debugging line

foreach ($migrationFiles as $file) {
    require_once $file;

    // Convert the filename to class name
    $className = preg_replace('/^\d+_/', '', basename($file, '.php')); // Remove the timestamp
    if($className != 'migrate'){
        // Check if migration has already been applied
        if (in_array($className, $appliedMigrations)) {
            echo "Migration $className already applied.\n";
            continue;
        }

        // Ensure class exists before instantiating
        if (!class_exists($className)) {
            echo "Class $className not found in file $file.\n";
            continue;
        }

        // Create a new migration instance and apply it
        $migration = new $className();
        echo "Applying migration: $className\n";
        $migration->up();

        // Record the migration as applied
        $stmt = $db->prepare("INSERT INTO migrations (migration) VALUES (:migration)");
        $stmt->execute(['migration' => $className]);
    }

}

echo "All migrations applied.\n";
