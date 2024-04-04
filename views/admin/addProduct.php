<div class="container mt-5">
    <h2 class="mb-4">Add Product</h2>
    <form action="../index.php?action=addProduct" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Product Description:</label>
            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Product Price:</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="image">Product Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
        </div>
        <?php if (isset($errors)) :?>
            <?php foreach ($errors as $error):?>
                <div class="alert alert-danger mt-3"><?= $error ?></div>
            <?php endforeach?>
        <?php endif; ?>
        <input type="submit" value="Add Product" name="add" class="btn btn-primary">
        <a href="../index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
