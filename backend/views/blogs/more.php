<?php require ROOTDIR . '/views/partials/header.php'; ?>
<div class="fcf-body">
    <div id="fcf-form">
        <?php setFlashMessage('success'); ?>
        <?php setFlashMessage('danger'); ?>
        <h3 class="fcf-h3">Blog</h3>
        <ul>
            <li><?php echo $data['blog']->subject; ?></li>
            <li><?php echo $data['blog']->description; ?></li>
        </ul>

        <h3 class="fcf-h3">Comments</h3>

        <ul>
            <?php if (!empty($data['comments'])) : ?>
                <?php foreach ($data['comments'] as $comment) : ?>
                    <li><?php echo $comment->posted_by; ?>: <?php echo $comment->description; ?> (<?php echo $comment->sentiment; ?>)</li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>

        <h3 class="fcf-h3">New comment</h3>

        <form id="fcf-form-id" class="fcf-form-class" method="POST" action="<?php echo URLROOT; ?>/blogs/comment">
            <div class="fcf-form-group">
                <input type="radio" name="rating" value="positive"> Positive<br>
                <input type="radio" name="rating" value="negative"> Negative<br>
            </div>

            <div class="fcf-form-group">
                <label for="review" class="fcf-label">Review</label>
                <div class="fcf-input-group">
                    <textarea id="review" name="review" class="fcf-form-control" rows="6" maxlength="3000" required></textarea>
                </div>
            </div>

            <div class="fcf-form-group">
                <button type="submit" id="fcf-button" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block" onclick="history.back()">Back</button>
            </div>

            <input type="hidden" name="blogId" value="<?php echo $data['blog']->blogid; ?>">

            <div class="fcf-form-group">
                <button type="submit" id="fcf-button" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block">Add Comment</button>
            </div>
        </form>
    </div>
</div>
<?php require ROOTDIR . '/views/partials/footer.php'; ?>