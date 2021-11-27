<?php
class Blogs extends Controller
{
    public function __construct()
    {
        if (!isAuthenticated()) {
            redirect('users/login');
            die();
        }

        $this->blogModel =  $this->model('Blog');
    }

    public function index()
    {
        $blogs = $this->blogModel->getBlogs();

        $data = [
            'blogs' => $blogs
        ];

        $this->view('blogs/index', $data);
    }

    public function create()
    {
        // Check if HTTP request is POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if user is authenticated to post
            if ($this->blogModel->canUserPostBlog($_SESSION['username'])) {
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Store each tag in an array
                $tags = rtrim($_POST['tags'], ',');
                $tags = filter_var($tags, FILTER_SANITIZE_STRING);
                $tags = explode(',', $tags);

                // Collect POST data
                $data = [
                    'subject' => trim($_POST['subject']),
                    'description' => trim($_POST['description']),
                    'tags' => $tags,
                    'subjectError' => '',
                    'descriptionError' => '',
                    'tagsError' => '',
                ];

                // Check all fields are filled
                if (empty($data['subject'])) {
                    $data['subjectError'] = 'Please enter a subject';
                }

                if (empty($data['description'])) {
                    $data['descriptionError'] = 'Please enter a description';
                }

                if (empty($data['tags'])) {
                    $data['tagsError'] = 'Please enter at least one tag';
                }

                // Check for no errors
                if (
                    empty($data['subjectError']) && empty($data['descriptionError'])
                    && empty($data['tagsError'])
                ) {
                    if ($this->blogModel->addBlog($data)) {
                        setFlashMessage('success', 'Blog successfully added!');
                        redirect('blogs');
                    } else {
                        die('Oops! Something went wrong.');
                    }
                } else {
                    // Reload view with errors
                    $this->view('blogs/create', $data);
                }
            } else {
                setFlashMessage('danger', 'You have reached your daily post limit.
                Please try again tomorrow', 'alert alert-danger');
                redirect('blogs/create');
            }
        } else {
            // Initialize empty data fields
            $data = [
                'subject' => '',
                'description' => '',
                'tags' => ''
            ];

            $this->view('blogs/create', $data);
        }
    }

    // Display a single blog post
    public function more($blogId)
    {
        $blog = $this->blogModel->getBlogById($blogId);
        $comments = $this->blogModel->getComments($blogId);

        $data = [
            'blog' => $blog,
            'comments' => $comments
        ];

        $this->view('blogs/more', $data);
    }

    // Add a comment to a blog
    public function comment()
    {
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Collect POST data
        $data = [
            'sentiment' => trim($_POST['rating']),
            'review' => trim($_POST['review']),
            'blogId' => trim($_POST['blogId'])
        ];

        if ($this->blogModel->canUserCommentDaily()) {
            if ($this->blogModel->isUserOwner($data['blogId'])) {
                setFlashMessage('danger', 'You cannot comment on your own blog!', 'alert alert-danger');
                redirect('blogs/more/' . $data['blogId']);
            } else {
                if ($this->blogModel->hasUserCommented($data['blogId'])) {
                    setFlashMessage('danger', 'You have already commented on this blog!', 'alert alert-danger');
                    redirect('blogs/more/' . $data['blogId']);
                } else {
                    if ($this->blogModel->addComment($data)) {
                        setFlashMessage('success', 'Comment added!');
                        redirect('blogs/more/' . $data['blogId']);
                    } else {
                        die('Oops! Something went wrong.');
                    }
                }
            }
        } else {
            setFlashMessage('danger', 'You have reached your daily post limit.
            Please try again tomorrow', 'alert alert-danger');
            redirect('blogs/more/' . $data['blogId']);
        }
    }
}
