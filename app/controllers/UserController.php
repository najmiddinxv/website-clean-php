<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\User;
use GuzzleHttp\Client;

class UserController extends Controller {
    private $userModel;

    
    public function __construct() {
        $this->userModel = new User();
    }

    public function users() {
        $this->checkAccess('admin');
        $users = $this->userModel->getAllUsers();

        try {
            // $client = new Client();
            // $posts = $client->request('GET', 'https://jsonplaceholder.typicode.com/posts', [
            //     '_start' => 0,
            //     '_limit' => 5
            // ]);
            // $postsData = json_decode($posts->getBody()->getContents(), true);
    
            // print_r($postsData);die;
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            echo "Error: Could not connect to the server. Please try again later.";
        } catch (\Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }


        $this->render('users', [
            'users' => $users,
            // 'posts' => $posts,
            
        ]);
    }

    public function create() {
        $this->checkAccess('admin');
        $this->render('users-create');
    }
}
