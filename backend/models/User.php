<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Insert User into 'users' table
    public function register($data)
    {
        // Prepare SQL query
        $this->db->query('INSERT INTO users(username, password, firstName, lastName, email) 
                VALUES(:username, :password, :firstName, :lastName, :email)');

        // Bind parameters
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':firstName', $data['firstName']);
        $this->db->bind(':lastName', $data['lastName']);
        $this->db->bind(':email', $data['email']);

        // Execute SQL statement
        if ($this->db->execute()) {
            // Query was successful
            return true;
        } else {
            // Query was unsuccessful
            return false;
        }
    }

    // Query row (tuple) from 'users' table
    public function login($username, $enteredPassword)
    {
        // Prepare SQL query
        $this->db->query('SELECT * FROM users WHERE username = :username');

        // Bind parameter
        $this->db->bind(':username', $username);

        // Fetch associated row
        $row = $this->db->getOneRow();

        // Fetch User's password
        $password = $row->password;

        // Check if passwords match
        if ($password == $enteredPassword) {
            // Passwords match
            return $row;
        } else {
            // Passwords do not match
            return false;
        }
    }

    // Find a User by username
    public function findUserByUsername($username)
    {
        // Prepare SQL query
        $this->db->query('SELECT username from users WHERE username = :username');

        // Bind parameter
        $this->db->bind(':username', $username);

        // Fetch associated row
        $this->db->getOneRow();

        // Check if row is empty
        if ($this->db->rowCount() > 0) {
            // Username was found
            return true;
        } else {
            // Username not found
            return false;
        }
    }

    // Find a User by email
    public function findUserByEmail($email)
    {
        // Prepare SQL query
        $this->db->query('SELECT email from users WHERE email = :email');

        // Bind parameter
        $this->db->bind(':email', $email);

        $this->db->getOneRow();

        // Check if row is empty
        if ($this->db->rowCount() > 0) {
            // Email was found
            return true;
        } else {
            // Email not found
            return false;
        }
    }

    // Initialize Database
    public function initializeDatabase()
    {
        if ($this->db->executeFile('university-1.sql') == false) {
            return false;
        } else {
            return true;
        }
    }
}
