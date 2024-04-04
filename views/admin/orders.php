<div class="container mt-5">
    <h1 class="mb-4">Admin Order Information</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Order Date</th>
                <th>Total Amount</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $order) : ?>
                <?php $customerInfo = json_decode($order['customer_info'], true); ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= $customerInfo['name'] ?></td>
                    <td><?= $customerInfo['email'] ?></td>
                    <td><?= $order['order_date'] ?></td>
                    <td>$<?= $order['total'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>