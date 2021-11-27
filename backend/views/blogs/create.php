<?php require ROOTDIR . '/views/partials/header.php'; ?>
<div class="fcf-body">
    <div id="fcf-form">
        <?php echo setFlashMessage('danger'); ?>
        <h3 class="fcf-h3">New Blog</h3>

        <form id="fcf-form-id" class="fcf-form-class" action="<?php echo URLROOT; ?>/blogs/create" method="POST">
            <div class="fcf-form-group">
                <label for="Subject" class="fcf-label">Subject</label>
                <div class="fcf-input-group">
                    <input type="text" id="Subject" name="subject" class="fcf-form-control" required>
                </div>
            </div>

            <div class="fcf-form-group">
                <label for="Tags" class="fcf-label">Tags</label>
                <div class="fcf-input-group">
                    <input type="text" id="Tags" name="tags" class="fcf-form-control" required>
                </div>
            </div>

            <div class="fcf-form-group">
                <label for="Description" class="fcf-label">Description</label>
                <div class="fcf-input-group">
                    <textarea id="Description" name="description" class="fcf-form-control" rows="6" maxlength="3000" required></textarea>
                </div>
            </div>

            <div class="fcf-form-group">
                <button type="submit" id="fcf-button" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block" onclick="history.back()">Back</button>
            </div>

            <div class="fcf-form-group">
                <button type="submit" id="fcf-button" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block">Create Blog</button>
            </div>
        </form>
    </div>
</div>
<?php require ROOTDIR . '/views/partials/footer.php'; ?>