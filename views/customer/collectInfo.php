<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-secondary text-white text-center">
                    <h3>Collect user's information for order</h3>
                </div>
                <div class="card-body">
                    <form action="../index.php?action=orderPage" method="POST">
                        <div class="form-group">
                            <input name="name" type="text" class="form-control" id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input name="email" type="emil" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input name="address" type="text" class="form-control" id="address" placeholder="Address">
                        </div>
                        <?php if (isset($errors)) :?>
                            <?php foreach ($errors as $error):?>
                                <div class="alert alert-danger mt-3"><?= $error ?></div>
                            <?php endforeach?>
                        <?php endif; ?>
                        <div class="text-center">
                            <input name="confirm" value="Confirm" type="submit" class="btn btn-secondary">
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
