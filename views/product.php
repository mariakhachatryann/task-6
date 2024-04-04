<div class="card mb-3 d-flex flex-row p-3 align-items-center">
    <img src="<?= $product['image_path']?>" width="500px" height="500px" class="rounded-start" alt="...">
    <div class="card-body ps-3">
        <h5 class="card-title"><?= $product['name']?></h5>
        <p class="card-text"><?= $product['description']?></p>
        <p class="card-text">$<?= $product['price']?></p>
        <?php if (isset($_SESSION['customer'])): ?>
            <div class="counter d-flex">
                <div class="counter-minus">-</div>
                <div class="counter-value bg-white">1</div>
                <div class="counter-plus">+</div>
            </div>
            <a href="index.php?action=customerCartView">
                <button class="btn btn-primary addToCart mt-2">Add to cart</button>
            </a>
        <?php endif; ?>
    </div>
</div>
<script src="views/js/script.js"></script>