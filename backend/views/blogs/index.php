<?php require ROOTDIR . '/views/partials/header.php'; ?>
<div class="container text-center">
    <?php setFlashMessage('success'); ?>
    <h1>Blogs</h1>
</div>
<a class="btn btn-primary btn-block float-end" href="<?php echo URLROOT; ?>/blogs/create" role="button">Add +</a>
<br>
<?php foreach ($data['blogs'] as $blog) : ?>
    <div class="card my-4">
        <div class="card-body">
            <h5 class="card-title"><a href="<?php echo URLROOT; ?>/blogs/more/<?php echo $blog->blogid; ?>"><?php echo $blog->subject; ?></a></h5>
            <p class="card-text"><?php echo $blog->description; ?></p>
        </div>
        <div class="card-footer">
            <p class="card-text float-end">
                Created by <?php echo $blog->created_by; ?>
            </p>
        </div>
    </div>
<?php endforeach; ?>
<div class="container text-center my-3">
    <form action="<?php echo URLROOT; ?>/users/initialize">
        <button type="submit" class="btn btn-info">Initialize Database</button>
    </form>
</div>
<?php require ROOTDIR . '/views/partials/footer.php'; ?>