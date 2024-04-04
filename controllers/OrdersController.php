<?php

class OrdersController {
    private $model;

    public function __construct()
    {
        $this->model = new OrdersModel();
    }

    public function getOrders()
    {
        $orders = $this->model->getOrders();
        $customersInfo = [];
        foreach ($orders as $order) {
            $customerInfo = json_decode($order['customer_info'], true);
            $customersInfo[] = $customerInfo;
        }
        require_once 'views/admin/orders.php';
    }

    public function orderInfoPage()
    {
        require_once 'views/customer/collectInfo.php';
    }

    public function orderConfirmPage()
    {
        $errors = [];
        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['address'])) {
            $prodController= new ProductsController();
            $products = $prodController->getProductsFromCart()[0];
            $total = $prodController->getProductsFromCart()[1];

            $_SESSION['customer'] = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
            ];

            require_once 'views/customer/orderConfirm.php';
        } else {
            $errors[] = 'All fields are required!';
            require_once 'views/customer/collectInfo.php';
        }
    }

    public function confirm()
    {
        $prodController = new ProductsController();
        $cartData = $prodController->getProductsFromCart();
        $products = $cartData[0];

        $total = $cartData[1];

        $customerInfo = json_encode($_SESSION['customer']);
        $orderID = $this->model->confirmOrders($customerInfo, $total);

        foreach ($products as $product) {
            $productID = $product['id'];
            $quantity = $product['quantity'];
            $this->model->confirmOrderItems($orderID, $productID, $quantity);
        }

        $_SESSION['orderConfirmed'] = true;
        $_SESSION['cart'] = [];
        require_once 'views/customer/orderConfirm.php';
    }
}
