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
            require_once "views/admin/addProduct.php";
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
            require_once 'views/admin/edit.php';
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
    public function removeFromCart($productId): void
    {
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['id'] === $productId) {
                    unset($_SESSION['cart'][$key]);
                }
            }
        }
        header("Location: index.php?action=customerCartView");
        exit();
    }

    public function getProductsFromCart()
    {
        $products = [];
        $sumOfPrice = 0;

        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $productId = $item['id'];
                $quantity = $item['quantity'];

                $prod = $this->model->getProductById($productId);

                if (empty($prod)) {
                    $this->removeFromCart($productId);
                } else {
                    $products[] = [
                        'id' => $productId,
                        'quantity' => $quantity,
                        'name' => $prod['name'],
                        'description' => $prod['description'],
                        'image_path' => $prod['image_path'],
                        'price' => $prod['price']
                    ];

                    $sumOfPrice += ($prod['price'] * $quantity);
                }
            }
        }
        $products = array_reverse($products);
        return [$products, $sumOfPrice];
    }

    public function renderProducts()
    {
        $products = $this->getProductsFromCart()[0];
        $sumOfPrice = $this->getProductsFromCart()[1];
        require_once 'views/customer/cart.php';
    }

    public function addToCart()
    {
        if(isset($_POST['productId'], $_POST['quantity'])) {
            $productId = $_POST['productId'];
            $qnt = $_POST['quantity'];

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            $productIndex = array_search($productId, array_column($_SESSION['cart'], 'id'));

            if ($productIndex !== false) {
                $_SESSION['cart'][$productIndex]['quantity'] += $qnt;
            } else {
                $_SESSION['cart'][] = [
                    'id' => $productId,
                    'quantity' => $qnt
                ];
            }
        }
    }
}
