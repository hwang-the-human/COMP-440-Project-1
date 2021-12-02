<?php require ROOTDIR . '/views/partials/header.php'; ?>
<div class="row">
    <div class="col-md-4">
        <h5 class="text-center">Your Blogs With All Positive Comments</h5>
        <div class="card my-4">
            <div class="card-body">
                <?php if (!empty($data['userPositiveBlogs'])) : ?>
                    <?php foreach ($data['userPositiveBlogs'] as $userPositiveBlog) : ?>
                        <h5 class="card-title"><a href="<?php echo URLROOT; ?>/blogs/more/<?php echo $userPositiveBlog->blogid; ?>"><?php echo $userPositiveBlog->subject; ?></a></h5>
                        <p class="card-text">- <?php echo $userPositiveBlog->created_by; ?></p>
                    <?php endforeach; ?>
                <?php else : ?>
                    <h5 class="card-title">No blogs to display</h5>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <?php if (!empty($data['mostBlogsOnDay'])) : ?>
            <h5 class="text-center">Users With Most Blogs On <?php echo $data['mostBlogsOnDay'][0]->pdate; ?></h5>
            <div class="card my-4">
                <div class="card-body">
                    <?php foreach ($data['mostBlogsOnDay'] as $mostBlogsOnDay) : ?>
                        <h5 class="card-title"><?php echo $mostBlogsOnDay->created_by; ?></h5>
                        <p class="card-text"><?php echo $mostBlogsOnDay->numBlogs; ?> blogs</p>
                    <?php endforeach; ?>
                <?php else : ?>
                    <h5 class="text-center">Users With Most Blogs On <?php echo date('Y-m-d'); ?></h5>
                    <div class="card my-4">
                        <div class="card-body">
                            <h5 class="card-title">No users to display</h5>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <h5 class="text-center">Find Users Followed By...</h5>
                    <div class="card my-4">
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
                                    <div class="col-md-5">
                                        <label for="user1">User 1</label>
                                        <input type="text" class="form-control <?php echo (!empty($data['user1Error'])) ? 'is-invalid' : '' ?>" name="user1" value="<?php echo $data['user1']; ?>">
                                        <span class=" invalid-feedback"><?php echo $data['user1Error']; ?></span>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="user2">User 2</label>
                                        <input type="text" class="form-control <?php echo (!empty($data['user2Error'])) ? 'is-invalid' : '' ?>" name="user2" value="<?php echo $data['user2']; ?>">
                                        <span class=" invalid-feedback"><?php echo $data['user2Error']; ?></span>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm col-md-2 h-25 mt-4">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h5 class="text-center">Users With No Blogs</h5>
                        <div class="card my-4">
                            <div class="card-body">
                                <?php foreach ($data['usersNoBlogs'] as $userNoBlog) : ?>
                                    <h5 class="card-title"><?php echo $userNoBlog->username; ?></h5>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <h5 class="text-center">Bad Apples (Users With Negative Reviews)</h5>
                        <div class="card my-4">
                            <div class="card-body">
                                <?php foreach ($data['usersNegativeComments'] as $userNegativeComment) : ?>
                                    <h5 class="card-title"><?php echo $userNegativeComment->posted_by; ?></h5>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <h5 class="text-center">Users Who Never Had A Negative Comment</h5>
                        <div class="card my-4">
                            <div class="card-body">
                                <?php foreach ($data['usersNoNegativeBlogs'] as $usersNoNegativeBlog) : ?>
                                    <h5 class="card-title"><?php echo $usersNoNegativeBlog->created_by; ?></h5>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <?php require ROOTDIR . '/views/partials/footer.php'; ?>