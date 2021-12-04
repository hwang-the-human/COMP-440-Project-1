<?php require ROOTDIR . '/views/partials/header.php'; ?>
<div class="row text-center">
    <h1 class="col-md-12">Statistics</h1>
</div>
<div class="row pt-5">
    <div class="col-md-4 col-auto mb-5 d-flex justify-content-center align-items-stretch">
        <div class="card my-4 text-center mh-13">
            <div class="card-header">
                Your Blogs With All Positive Comments
            </div>
            <div class="card-body">
                <?php if (!empty($data['userPositiveBlogs'])) : ?>
                    <?php foreach ($data['userPositiveBlogs'] as $userPositiveBlog) : ?>
                        <h5 class="card-title"><a href="<?php echo URLROOT; ?>/blogs/more/<?php echo $userPositiveBlog->blogid; ?>"><?php echo $userPositiveBlog->subject; ?></a></h5>
                    <?php endforeach; ?>
                <?php else : ?>
                    <h5 class="card-title">No blogs to display</h5>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-auto mb-5 d-flex justify-content-center align-items-stretch">
        <?php if (!empty($data['mostBlogsOnDay'])) : ?>
            <div class="card my-4 text-center mh-13">
                <div class="card-header">
                    Users With Most Blogs On <?php echo $data['mostBlogsOnDay'][0]->pdate; ?>
                </div>
                <div class="card-body">
                    <?php foreach ($data['mostBlogsOnDay'] as $mostBlogsOnDay) : ?>
                        <h5 class="card-title"><?php echo $mostBlogsOnDay->created_by; ?></h5>
                        <p class="card-text">
                            <?php echo $mostBlogsOnDay->numBlogs == 1 ? $mostBlogsOnDay->numBlogs . ' blog' : $mostBlogsOnDay->numBlogs . ' blogs'; ?>
                        </p>
                    <?php endforeach; ?>
                    <?php echo '</div>'; ?>
                    <?php echo '</div>'; ?>
                <?php else : ?>
                    <div class="card my-4 text-center mh-13">
                        <div class="card-header">
                            Users With Most Blogs On <?php echo date('Y-m-d'); ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">No users to display</h5>
                        </div>
                    </div>
                <?php endif; ?>
                </div>

                <div class="col-md-4 col-auto mb-5 d-flex justify-content-center align-items-stretch">
                    <div class="card my-4 text-center mh-13">
                        <div class="card-header">
                            Find Users Followed By...
                        </div>
                        <div class="card-body">
                            <?php if (!empty($data['followingList'])) : ?>
                                <?php foreach ($data['followingList'] as $following) : ?>
                                    <?php echo $following->leadername . '<br>' ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if (!empty($data['noResultsFound'])) : ?>
                                <?php echo $data['noResultsFound']; ?>
                            <?php endif; ?>
                            <form action="<?php echo URLROOT; ?>/stats" method="POST">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="user1">User 1</label>
                                        <input type="text" class="form-control <?php echo (!empty($data['user1Error'])) ? 'is-invalid' : '' ?>" name="user1" value="<?php echo $data['user1']; ?>">
                                        <span class=" invalid-feedback"><?php echo $data['user1Error']; ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="user2">User 2</label>
                                        <input type="text" class="form-control <?php echo (!empty($data['user2Error'])) ? 'is-invalid' : '' ?>" name="user2" value="<?php echo $data['user2']; ?>">
                                        <span class=" invalid-feedback"><?php echo $data['user2Error']; ?></span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-md mt-4 w-100">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-auto mb-5 d-flex justify-content-center align-items-stretch">
                    <div class="card my-4 text-center mh-13">
                        <div class="card-header">
                            Users With No Blogs
                        </div>
                        <div class="card-body">
                            <?php foreach ($data['usersNoBlogs'] as $userNoBlog) : ?>
                                <h5 class="card-title"><?php echo $userNoBlog->username; ?></h5>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-auto mb-5 d-flex justify-content-center align-items-stretch">
                    <div class="card my-4 text-center mh-13">
                        <div class="card-header">
                            Bad Apples (Users With Only Negative Reviews)
                        </div>
                        <div class="card-body">
                            <?php foreach ($data['usersNegativeComments'] as $userNegativeComment) : ?>
                                <h5 class="card-title"><?php echo $userNegativeComment->posted_by; ?></h5>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-auto mb-5 d-flex justify-content-center align-items-stretch">
                    <div class="card my-4 text-center mh-13">
                        <div class="card-header">
                            Users Who Never Had A Negative Comment
                        </div>
                        <div class="card-body">
                            <?php foreach ($data['usersNoNegativeBlogs'] as $usersNoNegativeBlog) : ?>
                                <h5 class="card-title"><?php echo $usersNoNegativeBlog->created_by; ?></h5>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <?php require ROOTDIR . '/views/partials/footer.php'; ?>