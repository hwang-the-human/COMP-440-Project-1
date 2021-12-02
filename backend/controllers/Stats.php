<?php
class Stats extends Controller
{
    public function __construct()
    {
        if (!isAuthenticated()) {
            redirect('users/login');
            die();
        }

        $this->statModel = $this->model('Stat');
    }

    public function index()
    {
        // Check if HTTP request is POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Collect POST data
            $data = [
                'user1' => trim($_POST['user1']),
                'user2' => trim($_POST['user2']),
                'user1Error' => '',
                'user2Error' => '',
            ];

            // Check all fields are filled
            if (empty($data['user1'])) {
                $data['user1Error'] = 'Please enter a user';
            }

            if (empty($data['user2'])) {
                $data['user2Error'] = 'Please enter a user';
            }

            // Check for no errors
            if (
                empty($data['user1Error']) && empty($data['user2Error'])
            ) {
                // Fetch all data from statModel
                $userPositiveBlogs = $this->statModel->getUserPositiveBlogs($_SESSION['username']);
                $mostBlogsOnDay = $this->statModel->getMostBlogsOnDay(date('Y-m-d'));
                $followingList = $this->statModel->getUsersFollowedBy($data['user1'], $data['user2']);
                $usersNoBlogs = $this->statModel->getUsersNoBlogs();
                $usersNegativeComments = $this->statModel->getUsersNegativeComments();
                $usersNoNegativeBlogs = $this->statModel->getUsersNoNegativeBlogs();

                $data = [
                    'userPositiveBlogs' => $userPositiveBlogs,
                    'mostBlogsOnDay' => $mostBlogsOnDay,
                    'user1' => trim($_POST['user1']),
                    'user2' => trim($_POST['user2']),
                    'followingList' => $followingList,
                    'usersNoBlogs' => $usersNoBlogs,
                    'usersNegativeComments' => $usersNegativeComments,
                    'usersNoNegativeBlogs' => $usersNoNegativeBlogs,
                ];

                // Check if either user does not exist
                if ($data['followingList'] == 'user1Error' || $data['followingList'] == 'user2Error') {
                    unset($data['followingList']);
                    trim($followingList);
                    $data[$followingList] = 'No user found';
                    $this->view('stats/index', $data);
                } else if (!$data['followingList']) {
                    // No results found
                    $data['noResultsFound'] = 'No results found';
                    $this->view('stats/index', $data);
                }

                $this->view('stats/index', $data);
            } else {
                // Fetch all data from statModel
                $userPositiveBlogs = $this->statModel->getUserPositiveBlogs($_SESSION['username']);
                $mostBlogsOnDay = $this->statModel->getMostBlogsOnDay(date('Y-m-d'));
                $usersNoBlogs = $this->statModel->getUsersNoBlogs();
                $usersNegativeComments = $this->statModel->getUsersNegativeComments();
                $usersNoNegativeBlogs = $this->statModel->getUsersNoNegativeBlogs();

                $data = [
                    'userPositiveBlogs' => $userPositiveBlogs,
                    'mostBlogsOnDay' => $mostBlogsOnDay,
                    'user1' => trim($_POST['user1']),
                    'user2' => trim($_POST['user2']),
                    'usersNoBlogs' => $usersNoBlogs,
                    'usersNegativeComments' => $usersNegativeComments,
                    'usersNoNegativeBlogs' => $usersNoNegativeBlogs,
                    'user1Error' => $data['user1Error'],
                    'user2Error' => $data['user2Error'],
                ];

                // Reload view with errors
                $this->view('stats/index', $data);
            }
        } else {
            // Fetch all data from statModel
            $userPositiveBlogs = $this->statModel->getUserPositiveBlogs($_SESSION['username']);
            $mostBlogsOnDay = $this->statModel->getMostBlogsOnDay(date('Y-m-d'));
            $usersNoBlogs = $this->statModel->getUsersNoBlogs();
            $usersNegativeComments = $this->statModel->getUsersNegativeComments();
            $usersNoNegativeBlogs = $this->statModel->getUsersNoNegativeBlogs();

            $data = [
                'userPositiveBlogs' => $userPositiveBlogs,
                'mostBlogsOnDay' => $mostBlogsOnDay,
                'user1' => '',
                'user2' => '',
                'usersNoBlogs' => $usersNoBlogs,
                'usersNegativeComments' => $usersNegativeComments,
                'usersNoNegativeBlogs' => $usersNoNegativeBlogs
            ];

            $this->view('stats/index', $data);
        }
    }
}
