<?php

class ProductsModel
{
    private $connection;

    public function __construct()
    {
        global $connection;
        $this->connection = $connection;
    }

    public function getAllProducts(): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM products ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById(int $productId)
    {
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([':id' => $productId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addProduct($name, $description, $price,  $imgPath)
    {
        $stmt = $this->connection->prepare("INSERT INTO products (name, description, price, image_path) VALUES (:name, :description, :price, :image_path)");
        $stmt->execute([':name' => $name, ':description' => $description, ':price' => $price, ':image_path' => $imgPath]);
    }

    public function deleteProduct($productId): void
    {
        $stmt = $this->connection->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute([':id' => $productId]);
    }

    public function editProduct($productId, $name, $description, $price, $image_path): void
    {
        $stmt = $this->connection->prepare("UPDATE products SET name = :name, description = :description, price = :price, image_path = :image_path WHERE id = :id");
        $stmt->execute([':name' => $name, ':description' => $description, ':price' => $price, 'image_path' => $image_path, ':id' => $productId]);
    }
}