<?php require ROOTDIR . '/views/partials/header.php'; ?>
<div class="row">
    <div class="col-md-5 mx-auto">
        <?php setFlashMessage('success'); ?>
        <?php setFlashMessage('danger'); ?>
        <h3 class="text-center mb-3">Login</h3>
        <form action="<?php echo URLROOT; ?>/users/login" method="POST">
            <div class="form-group my-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" value="<?php echo $data['username']; ?>" required>
            </div>
            <div class="form-group my-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" value="<?php echo $data['password']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<?php require ROOTDIR . '/views/partials/footer.php'; ?>