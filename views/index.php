<?php if ($products): ?>
    <h2>All products</h2>
    <div class="d-flex flex-wrap justify-content-around">
        <?php foreach ($products as $product): ?>
            <div class="card mb-4" style="width: 18rem;">
                <img src="<?= $product['image_path'] ?>" class="card-img-top" alt="<?= $product['name'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $product['name'] ?></h5>
                    <p class="card-text">$<?= $product['price'] ?></p>
                    <a href="index.php?action=product&id=<?= $product['id']?>" class="btn btn-secondary">Details</a>
                    <?php if(!empty($_SESSION['admin'])): ?>
                        <a href="index.php?action=editView&id=<?= $product['id']?>" class="btn btn-primary"><i class="bi bi-pen"></i></a>
                        <a href="index.php?action=delete&id=<?= $product['id']?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach ?>

    </div>
<?php endif; ?>
