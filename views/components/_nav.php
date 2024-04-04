<link rel="stylesheet" href="views/css/style.css">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo02">
            <ul class="navbar-nav mb-2 mb-lg-0 d-flex justify-content-center align-items-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Products</a>
                </li>
                <?php if(empty($_SESSION['admin'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=adminLoginView">Admin Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=customerCartView">
                            <i class="bi bi-basket-fill text-white" style="font-size: 30px; margin: 10px; cursor: pointer"></i>
                        </a>
                    </li>
                <?php elseif(isset($_SESSION['admin'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=orders">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=addProductView">Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=adminLogout">Admin Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>