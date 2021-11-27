<?php require ROOTDIR . '/views/partials/header.php'; ?>
<div class="row">
    <div class="col-md-5 mx-auto">
        <h3 class="text-center mb-3">Register</h3>
        <form action="<?php echo URLROOT; ?>/users/register" method="POST">
            <div class="form-group my-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control <?php echo (!empty($data['usernameError'])) ? 'is-invalid' : '' ?>" name="username" value="<?php echo $data['username']; ?>" required>
                <span class="invalid-feedback"><?php echo $data['usernameError']; ?></span>
            </div>
            <div class="form-group my-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control <?php echo (!empty($data['passwordError'])) ? 'is-invalid' : '' ?>" name="password" value="<?php echo $data['password']; ?>" required>
                <span class="invalid-feedback"><?php echo $data['passwordError']; ?></span>
            </div>
            <div class="form-group mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control <?php echo (!empty($data['confirmPasswordError'])) ? 'is-invalid' : '' ?>" name="confirmPassword" value="<?php echo $data['confirmPassword']; ?>" required>
                <span class="invalid-feedback"><?php echo $data['confirmPasswordError']; ?></span>
            </div>
            <div class="form-group my-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control <?php echo (!empty($data['firstNameError'])) ? 'is-invalid' : '' ?>" name="firstName" value="<?php echo $data['firstName']; ?>" required>
                <span class="invalid-feedback"><?php echo $data['firstNameError']; ?></span>
            </div>
            <div class="form-group my-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control <?php echo (!empty($data['lastNameError'])) ? 'is-invalid' : '' ?>" name="lastName" value="<?php echo $data['lastName']; ?>" required>
                <span class="invalid-feedback"><?php echo $data['lastNameError']; ?></span>
            </div>
            <div class="form-group my-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control <?php echo (!empty($data['emailError'])) ? 'is-invalid' : '' ?>" name="email" value="<?php echo $data['email']; ?>" required>
                <span class="invalid-feedback"><?php echo $data['emailError']; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<?php require ROOTDIR . '/views/partials/footer.php'; ?>