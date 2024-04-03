<?php
session_start();
require_once 'connection.php';
require_once 'views/components/bootstrap.php';
require_once 'views/components/_nav.php';

require_once 'models/ProductsModel.php';
require_once 'controllers/ProductsController.php';
require_once 'models/AdminModel.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/CustomerController.php';
require_once 'models/CustomerModel.php';

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
    case 'customerLogout':
        $controller = new CustomerController();
        $controller->logout();
    break;
    case 'signView':
        $controller = new CustomerController();
        $controller->renderSign();
    break;
    case 'sign':
        $controller = new CustomerController();
        $controller->sign();
        break;
    case 'loginView':
        $controller = new CustomerController();
        $controller->renderLogin();
    break;
    case 'login':
        $controller = new CustomerController();
        $controller->login();
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
    case 'customerCartView':
        $controller = new CustomerController();
        $controller->renderCart();
    break;
    default:
        $controller = new ProductsController();
        $controller->getAllProducts();
}

//$username = "maria_kh";
//$password = password_hash("mmm582313", PASSWORD_DEFAULT);
//
//$stmt = $connection->prepare("INSERT INTO admins (username, password) VALUES (:username, :password)");
//
//// Bind parameters
//$stmt->bindParam(':username', $username);
//$stmt->bindParam(':password', $password);
//
//// Execute the query
//if ($stmt->execute()) {
//    echo "Admin added successfully.";
//} else {
//    echo "Error: Unable to add admin.";
//}