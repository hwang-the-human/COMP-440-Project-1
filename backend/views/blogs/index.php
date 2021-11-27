<?php require ROOTDIR . '/views/partials/header.php'; ?>
<div class="fcf-body">
    <div id="fcf-form">
        <?php setFlashMessage('success'); ?>
        <a class="btn btn-primary btn-block float-end" href="<?php echo URLROOT; ?>/blogs/create" role="button">Add +</a>
        <h3 class="fcf-h3">All Blogs</h3>

        <div id="fcf-form-id" class="fcf-form-class">
            <ul>
                <?php foreach ($data['blogs'] as $blog) : ?>
                    <li><a href="<?php echo URLROOT; ?>/blogs/more/<?php echo $blog->blogid; ?>"><?php echo $blog->subject; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<?php require ROOTDIR . '/views/partials/footer.php'; ?>