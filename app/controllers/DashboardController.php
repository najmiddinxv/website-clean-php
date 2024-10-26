<?php

namespace App\Controllers;

use Core\Controller;

class DashboardController extends Controller {
    
    public function __construct() {}

    public function dashboard() {
        $this->checkAccess();
        $this->render('dashboard');
    }

}
