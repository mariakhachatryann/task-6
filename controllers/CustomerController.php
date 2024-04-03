<?php

class CustomerController
{

    private $model;

    public function __construct()
    {
        $this->model = new CustomerModel();
    }
    public function renderSign()
    {
        require_once "views/customer/sign.php";
    }

    public function renderLogin()
    {
        require_once "views/customer/login.php";
    }

    public function renderCart()
    {
        require_once 'views/customer/cart.php';
    }

    public function sign()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['userSign'])) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
            $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
            $confirmPassword = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_SPECIAL_CHARS);

            if (empty($username) || empty($password) || empty($email) || empty($confirmPassword) || empty($address)) {
                $errors[] = 'Please fill out all fields';
            } else {
                if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
                    $errors[] = 'Password must be at least 8 characters long and contain letters and numbers.';
                } else {
                    $hash = password_hash($password, PASSWORD_DEFAULT);

                    if ($password == $confirmPassword) {
                        $this->model->sign($username, $email, $hash, $address);
                        header("Location: index.php?action=loginView");
                        exit;
                    } else {
                        $errors[] = 'Passwords don\'t match';
                    }
                }
            }
        }
        require_once 'views/customer/sign.php';
    }

    public function login()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

            if (empty($email) || empty($password)) {
                $errors[] = 'Please fill out all fields';
            } else {
                $row = $this->model->login($email);

                if ($row && password_verify($password, $row['password'])) {
                    $_SESSION['customer'] = $row;
                    header('Location: index.php?action');
                } else {
                    $errors[] = 'incorrect username or password';
                    require_once 'views/customer/login.php';
                }
            }
        }
        require_once 'views/customer/login.php';

    }

    public function logout()
    {
        session_start();
        $_SESSION = [];
        session_destroy();

        header('Location: index.php');
        exit();
    }
}