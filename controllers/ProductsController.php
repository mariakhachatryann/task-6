<?php

class ProductsController {
    private $model;

    public function __construct()
    {
        $this->model = new ProductsModel();
    }

    public function getAllProducts()
    {
        $products = $this->model->getAllProducts();
        require_once 'views/index.php';
    }

    public function addProductView()
    {
        if (empty($_SESSION['admin'])) {
            header("Location: index.php");
        } else {
            require_once "views/addProduct.php";
        }
    }

    public function addProduct()
    {
        if (empty($_SESSION['admin'])) {
            header("Location: index.php");
        } else {
            $errors = [];
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
                $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
                $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
                $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT);
                $target_file = 'productsImg/' . basename($_FILES['image']['name']);

                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    if (empty($name) || empty($description) || empty($price)) {
                        $errors[] = 'All fields are required!';
                    } else {
                        $this->model->addProduct($name, $description, $price, $target_file);
                        header('Location: index.php');
                        exit;
                    }
                } else {
                    $errors[] = 'Failed to upload an image, try again!';
                }
            }
        }
    }

    public function getProductById($productId)
    {
        $product = $this->model->getProductById($productId);
        require_once 'views/product.php';
    }

    public function deleteProduct($productId)
    {
        if (empty($_SESSION['admin'])) {
            header("Location: index.php");
        } else {
            $this->model->deleteProduct($productId);
            header('Location: index.php');
        }
    }

    public function renderEdit($productId)
    {
        if (empty($_SESSION['admin'])) {
            header("Location: index.php");
        } else {
            $product = $this->model->getProductById($productId);
            require_once 'views/edit.php';
        }
    }

    public function editProduct($productId)
    {
        $errors = [];

        if (empty($_SESSION['admin'])) {
            header("Location: index.php");
            exit;
        }

        $product = $this->model->getProductById($productId);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
            $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT);
            $target_file = 'productsImg/' . basename($_FILES['image']['name']);

            if (empty($name) || empty($description) || empty($price)) {
                $errors[] = 'All fields are required!';
            }

            if (!empty($_FILES['image']['name'])) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    $this->model->editProduct($product['id'], $name, $description, $price, $target_file);
                    header('Location: index.php');
                    exit;
                } else {
                    $errors[] = 'Failed to upload the image, please try again!';
                }
            } else {
                $this->model->editProduct($product['id'], $name, $description, $price, $product['image_path']);
                header('Location: index.php');
                exit;
            }

        }
    }
}
