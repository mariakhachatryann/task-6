<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h3 class="text-center">User Sign Up</h3>
                </div>
                <div class="card-body">
                    <form action="../index.php?action=sign" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" >
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" >
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" >
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" >
                        </div>
                        <?php if (isset($errors)) :?>
                            <?php foreach ($errors as $error):?>
                                <div class="alert alert-danger mt-3"><?= $error ?></div>
                            <?php endforeach?>
                        <?php endif; ?>
                        <div class="d-grid">
                            <input type="submit" value="Sign Up" name="userSign" class="btn btn-secondary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>