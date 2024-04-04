<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Shopping Cart</h5>
                    <?php if (empty($products)): ?>
                        <p>Shopping cart is empty</p>
                    <?php endif; ?>
                    <?php foreach ($products as $product): ?>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <img src="<?= $product['image_path']?>" class="img-fluid rounded" alt="Product Image">
                            </div>
                            <div class="col-md-5">
                                <h6 class="card-subtitle mb-2"><?= $product['name']?></h6>
                                <p class="card-text"><?= $product['description']?></p>
                            </div>
                            <div class="col-md-2">
                                <p class="price">$<?= $product['price']?> x <?= $product['quantity']?></p>
                            </div>
                            <div class="col-md-2">
                                <a href="index.php?action=removeFromCart&id=<?=$product['id']?>" type="submit" class="btn btn-danger btn-sm">Remove</a>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Summary</h5>
                    <ul class="list-group">
                        <li class="list-group-item">Total Items: <?= count($products) ?></li>
                        <li class="list-group-item">Total Price: $<?= $sumOfPrice ?></li>
                    </ul>
                    <a class="btn btn-primary btn-block mt-3" href="index.php?action=checkout">Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>