<div class="card mb-3 d-flex flex-row p-3">
    <img src="<?= $product['image_path']?>" width="500px" height="500px" class="rounded-start" alt="...">
    <div class="card-body ps-3">
        <h5 class="card-title"><?= $product['name']?></h5>
        <p class="card-text"><?= $product['description']?></p>
        <p class="card-text">$<?= $product['price']?></p>

        <?php if (isset($_SESSION['customer'])): ?>
            <div class="counter d-flex">
                <div class="counter-minus">-</div>
                <div class="counter-value bg-white">0</div>
                <div class="counter-plus">+</div>
            </div>
            <button class="btn btn-primary addToCart">Add to cart</button>
        <?php endif; ?>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let addBtn = document.querySelector('.counter-plus');
        addBtn.addEventListener('click', function () {
            let counterValue = document.querySelector('.counter-value');
            let currentValue = parseInt(counterValue.innerText);
            counterValue.innerText = currentValue + 1;
        });

        let minusBtn = document.querySelector('.counter-minus');
        minusBtn.addEventListener('click', function () {
            let counterValue = document.querySelector('.counter-value');
            let currentValue = parseInt(counterValue.innerText);
            if (currentValue !== 0) {
                counterValue.innerText = currentValue - 1;
            }
        });

        let addToCartBtn = document.querySelector('.addToCart');
        addToCartBtn.addEventListener('click', function () {
            let productId = "<?php echo $product['id']; ?>";
            let quantity = parseInt(document.querySelector('.counter-value').innerText);
            let customerId = "<?php echo $_SESSION['customer']['id']; ?>";

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'addToCart.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('productId=' + productId + '&quantity=' + quantity);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                }
            };
        });
    });
</script>


<style>
    .counter {
        width: 160px;
        background-color: rgb(20 103 194);
        border-radius: .5rem;
    }

    .counter-plus, .counter-minus {
        padding-bottom: 12px;
        padding-top: 12px;
        width: 3.5rem;
        cursor: pointer;
        text-align: center;
        color: white;
    }

    .counter-value {
        width: 4rem;
        text-align: center;
        color: black;
        border: 1px solid rgb(230 230 231);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>