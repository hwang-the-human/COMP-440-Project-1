<?php require ROOTDIR . '/views/partials/header.php'; ?>
<a href="<?php echo URLROOT; ?>/blogs" class="btn btn-secondary mb-5" role="button">Go Back</a>
<br>
<div class="row">
    <?php setFlashMessage('success'); ?>
    <?php setFlashMessage('danger'); ?>
    <div class="card my-4">
        <div class="card-body">
            <h5 class="card-title"><?php echo $data['blog']->subject; ?></h5>
            <p class="card-text"><?php echo $data['blog']->description; ?></p>
        </div>
        <div class="card-footer">
            <p class="card-text float-start">
                <?php echo $data['blog']->pdate; ?>
            </p>
            <p class="card-text float-end">
                Created by <?php echo $data['blog']->created_by; ?>
            </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <form action="<?php echo URLROOT; ?>/blogs/comment" method="POST">
            <div class="form-group my-3">
                <label for="rating">Rating</label>
                <select class="form-control mt-2" name="rating" required>
                    <option value="">Choose One</option>
                    <option value="positive">Positive</option>
                    <option value="negative">Negative</option>
                </select>
            </div>
            <div class="form-group my-3">
                <label for="review">Review</label>
                <textarea class="form-control mt-2" name="review" rows="4" required></textarea>
            </div>
            <input type="hidden" name="blogId" value="<?php echo $data['blog']->blogid; ?>">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="col-md-8">
        <?php if (!empty($data['comments'])) : ?>
            <?php foreach ($data['comments'] as $comment) : ?>
                <div class="card my-4">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $comment->sentiment; ?></h5>
                        <p class="card-text"><?php echo $comment->description; ?></p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text float-end">
                            Created by <?php echo $comment->posted_by; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?php require ROOTDIR . '/views/partials/footer.php'; ?>