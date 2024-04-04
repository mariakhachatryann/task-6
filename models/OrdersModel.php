<?php

class OrdersModel
{
    private $connection;

    public function __construct()
    {
        global $connection;
        $this->connection = $connection;
    }

    public function getOrders()
    {
        $stmt = $this->connection->prepare("SELECT * FROM orders ORDER BY order_date");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function confirmOrders($customer_info, $total)
    {
        $stmt = $this->connection->prepare("INSERT INTO orders (customer_info, total) VALUES (:customer_info, :total)");
        $stmt->execute([':customer_info' => $customer_info, ':total' => $total]);
        return $this->connection->lastInsertId();
    }

    public function confirmOrderItems($orderID, $productId, $qnt)
    {
        $stmt = $this->connection->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)");
        $stmt->execute([':order_id' => $orderID, ':product_id' => $productId, ':quantity' => $qnt]);
    }
}