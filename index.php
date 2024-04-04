<?php
session_start();
require_once 'connection.php';
require_once 'views/components/bootstrap.php';
require_once 'views/components/_nav.php';

require_once 'models/AdminModel.php';
require_once 'controllers/AdminController.php';
require_once 'models/ProductsModel.php';
require_once 'controllers/ProductsController.php';
require_once 'controllers/OrdersController.php';
require_once 'models/OrdersModel.php';

unset($_SESSION['orderConfirmed']);

$action = $_GET['action'] ?? null;
$productId = $_GET['id'] ?? null;

switch ($action) {
    case "adminLoginView":
        $controller = new AdminController();
        $controller->renderLogin();
    break;
    case "adminLogin":
        $controller = new AdminController();
        $controller->login();
        break;
    case "adminLogout":
        $controller = new AdminController();
        $controller->logout();
    break;
    case 'delete':
        $controller = new ProductsController();
        $controller->deleteProduct($productId);
    break;
    case 'editView':
        $controller = new ProductsController();
        $controller->renderEdit($productId);
    break;
    case 'edit':
        $controller = new ProductsController();
        $controller->editProduct($productId);
        break;
    case 'addProductView':
        $controller = new ProductsController();
        $controller->addProductView();
    break;
    case 'addProduct':
        $controller = new ProductsController();
        $controller->addProduct();
        break;
    case "product":
        $controller = new ProductsController();
        $controller->getProductById($productId);
    break;
    case 'addToCart':
        $controller = new ProductsController();
        $controller->addToCart();
        break;
    case 'customerCartView':
        $controller = new ProductsController();
        $controller->renderProducts();
    break;
    case 'removeFromCart':
        $controller = new ProductsController();
        $controller->removeFromCart($productId);
    break;
    case 'checkout':
        $controller = new OrdersController();
        $controller->orderInfoPage();
    break;
    case 'confirm':
        $controller = new OrdersController();
        $controller->confirm();
    break;
    case 'orderPage':
        $controller = new OrdersController();
        $controller->orderConfirmPage();
    break;
    case 'orders':
        $controller = new OrdersController();
        $controller->getOrders();
    break;
    default:
        $controller = new ProductsController();
        $controller->getAllProducts();
}