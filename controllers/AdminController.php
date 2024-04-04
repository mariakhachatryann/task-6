<?php

class AdminController {
    private $model;

    public function __construct()
    {
        $this->model = new AdminModel();
    }

    public function renderLogin()
    {
        require_once 'views/admin/login.php';
    }

    public function login()
    {

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['adminLogin']) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

            if (empty($username) || empty($password)) {
                $errors[] = 'Please fill out all fields';
                require_once 'views/admin/login.php';
            } else {
                $row = $this->model->login($username);

                if ($row && password_verify($password, $row['password'])) {
                    $_SESSION['admin'] = $row;
                    header('Location: index.php?action');
                } else {
                    $errors[] = 'incorrect username or password';
                    require_once 'views/admin/login.php';
                }
            }
        }
    }

    public function logout()
    {
        session_start();
        $_SESSION['admin'] = [];

        header('Location: index.php');
        exit();
    }
}


