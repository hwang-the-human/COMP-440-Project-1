<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    // Register a User
    public function register()
    {
        // Redirect user if already logged in
        if (isAuthenticated()) {
            redirect('blogs');
            die();
        }

        // Check if HTTP request is POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Collect POST data
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'firstName' => trim($_POST['firstName']),
                'lastName' => trim($_POST['lastName']),
                'email' => trim($_POST['email']),
                'usernameError' => '',
                'passwordError' => '',
                'confirmPasswordError' => '',
                'firstNameError' => '',
                'lastNameError' => '',
                'emailError' => ''
            ];

            // Check all fields are filled
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter a username';
            } else {
                // Check for duplicate username in 'users' table
                if ($this->userModel->findUserByUsername($data['username'])) {
                    $data['usernameError'] = 'That username is already in use!';
                }
            }

            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password';
            }

            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please confirm your password';
            } else {
                // Check if passwords match
                if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Passwords do not match!';
                }
            }

            if (empty($data['firstName'])) {
                $data['firstNameError'] = 'Please enter your first name';
            }

            if (empty($data['lastName'])) {
                $data['lastNameError'] = 'Please enter your last name';
            }

            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter your email address';
            } else {
                // Check for duplicate email in 'users' table
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['emailError'] = 'That email address is already in use!';
                }
            }

            // Check for no errors
            if (
                empty($data['usernameError']) && empty($data['passwordError'])
                && empty($data['confirmPasswordError']) && empty($data['firstNameError'])
                && empty($data['lastNameError']) && empty($data['emailError'])
            ) {
                // Insert user into 'users' table and redirect
                if ($this->userModel->register($data)) {
                    setFlashMessage('success', 'Account Created! You can now log in!');
                    redirect('users/login');
                } else {
                    die('Oops! Something went wrong.');
                }
            } else {
                // Reload view with errors
                $this->view('users/register', $data);
            }
        } else {
            // Initialize empty data fields
            $data = [
                'username' => '',
                'password' => '',
                'confirmPassword' => '',
                'firstName' => '',
                'lastName' => '',
                'email' => ''
            ];

            $this->view('users/register', $data);
        }
    }

    // Login a User
    public function login()
    {
        // Redirect user if already logged in
        if (isAuthenticated()) {
            redirect('blogs');
            die();
        }

        // Check if HTTP request is POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Collect POST data
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => '',
            ];

            // Check all fields are filled
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter a username';
            }

            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password';
            }

            // Check for no errors
            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                // Query 'users' table for matching credentials
                if ($this->userModel->findUserByUsername($data['username'])) {
                    $user = $this->userModel->login($data['username'], $data['password']);

                    // If credentials match, start session
                    if ($user) {
                        $this->startSession($user);
                    } else {
                        setFlashMessage('danger', 'Username or password is incorrect!', 'alert alert-danger');
                    }
                } else {
                    setFlashMessage('danger', 'Username or password is incorrect!', 'alert alert-danger');
                }

                $this->view('users/login', $data);
            } else {
                // Reload view with errors
                $this->view('users/login', $data);
            }
        } else {
            // Initialize empty data fields
            $data = [
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => '',
            ];

            $this->view('users/login', $data);
        }
    }

    // Start session when User logs in
    public function startSession($user)
    {
        $_SESSION['username'] = $user->username;
        $_SESSION['firstName'] = $user->firstName;
        $_SESSION['lastName'] = $user->lastName;
        $_SESSION['email'] = $user->email;
        redirect('blogs');
    }

    // Log out User
    public function logout()
    {
        unset($_SESSION['username']);
        unset($_SESSION['firstName']);
        unset($_SESSION['lastName']);
        unset($_SESSION['email']);
        redirect('users/login');
    }

    // Initialize database
    public function initialize()
    {
        $this->userModel->initializeDatabase('university-1.sql');
        setFlashMessage('success', 'Database initialized successfully!');
        redirect('blogs');
    }
}
