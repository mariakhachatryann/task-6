<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Confirmation</h5>
                    <p><strong>Name:</strong> <?= $_SESSION['customer']['name'] ?></p>
                    <p><strong>Email:</strong> <?= $_SESSION['customer']['email'] ?></p>
                    <p><strong>Address:</strong> <?= $_SESSION['customer']['address'] ?></p>
                    <h6 class="card-subtitle mb-2 text-muted">Ordered Items:</h6>
                    <ul class="list-group">
                        <?php foreach ($products as $product): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= $product['name'] ?>
                                <span class="badge badge-primary badge-pill">$<?= $product['price'] ?> * <?= $product['quantity']?> </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <p class="mt-3"><strong>Total:</strong> $<?= $total ?> </p>
                    <?php if (isset($_SESSION['orderConfirmed'])): ?>
                        <p class="text-success"><strong>Status:</strong> Confirmed</p>
                    <?php else : ?>
                        <div class="mt-4">
                            <a href="../index.php?action=confirm" class="btn btn-success mr-2">Confirm Order</a>
                            <a href="../index.php?action=customerCartView" class="btn btn-danger">Cancel Order</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>