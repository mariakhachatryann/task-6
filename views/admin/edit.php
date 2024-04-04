<div class="container mt-5">
    <h2 class="mb-4">Edit Product</h2>
    <form action="../index.php?action=edit&id=<?= $product['id']?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Product Description:</label>
            <textarea class="form-control" id="description" name="description" rows="5" required><?php echo $product['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="price">Product Price:</label>
            <input type="number" class="form-control" id="price" value="<?php echo $product['price']; ?>" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="image">Product Image:</label>
            <input type="file" class="form-control-file" id="image"  name="image" accept="image/*">
        </div>
        <?php if (isset($errors)) :?>
            <?php foreach ($errors as $error):?>
                <div class="alert alert-danger mt-3"><?= $error ?></div>
            <?php endforeach?>
        <?php endif; ?>
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <input type="submit" name="update" value="Update Product" class="btn btn-primary">
        <a href="../index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>