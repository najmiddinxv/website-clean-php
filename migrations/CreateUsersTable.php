<?php
// migrations/20231025203000_create_users_table.php

use Core\Database;

class CreateUsersTable {
    public function up() {
        $db = Database::getInstance();
        $query = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $db->exec($query);
    }

    public function down() {
        $db = Database::getInstance();
        $query = "DROP TABLE IF EXISTS users";
        $db->exec($query);
    }
}
