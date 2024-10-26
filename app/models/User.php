<?php

namespace App\Models;

use Core\Database;
use Core\Model;

class User extends Model{
    
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
