<?php require ROOTDIR . '/views/partials/header.php'; ?>
<a href="<?php echo URLROOT; ?>/blogs" class="btn btn-secondary mb-5" role="button">Go Back</a>
<br>
<div class="row">
    <div class="col-md-5 mx-auto">
        <?php echo setFlashMessage('danger'); ?>
        <h3 class="text-center mb-3">Create a Blog</h3>
        <form action="<?php echo URLROOT; ?>/blogs/create" method="POST">
            <div class="form-group my-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control <?php echo (!empty($data['subjectError'])) ? 'is-invalid' : '' ?>" name="subject" value="<?php echo $data['subject']; ?>" required>
                <span class="invalid-feedback"><?php echo $data['subjectError']; ?></span>
            </div>
            <div class="form-group my-3">
                <label for="description">Description</label>
                <textarea class="form-control <?php echo (!empty($data['descriptionError'])) ? 'is-invalid' : '' ?>" name="description" rows="4" required></textarea>
                <span class="invalid-feedback"><?php echo $data['descriptionError']; ?></span>
            </div>
            <div class="form-group my-3">
                <label for="tags" class="form-label">Tags</label>
                <input type="textarea" class="form-control <?php echo (!empty($data['tagsError'])) ? 'is-invalid' : '' ?>" name="tags" value="<?php echo $data['tags']; ?>" required>
                <span class="invalid-feedback"><?php echo $data['tagsError']; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<?php require ROOTDIR . '/views/partials/footer.php'; ?>