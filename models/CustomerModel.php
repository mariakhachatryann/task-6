<?php

class CustomerModel
{

    private $connection;

    public function __construct()
    {
        global $connection;
        $this->connection = $connection;
    }

    public function sign($username, $email, $password, $address)
    {
        $stmt = $this->connection->prepare("INSERT INTO customers (username, email, password, address) VALUES (:name, :email, :password, :address)");
        $stmt->execute([':name' => $username, ':email' => $email, ':password' => $password, ':address' => $address]);
    }

    public function login(string $email)
    {
        $stmt = $this->connection->prepare("SELECT * FROM customers WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}