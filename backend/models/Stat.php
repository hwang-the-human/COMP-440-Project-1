<?php
class Stat
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // List all the blogs of user X, such that all 
    // the comments are positive for these blogs.
    public function getUserPositiveBlogs($user)
    {
        // Prepare SQL query
        $this->db->query('SELECT *
        FROM blogs b
        JOIN comments c
        ON b.blogid = c.blogid
        WHERE created_by = :created_by
        GROUP BY b.blogid
        HAVING MIN(sentiment) = :sentiment');

        // Bind parameters
        $this->db->bind(':created_by', $user);
        $this->db->bind(':sentiment', 'positive');

        $rows = $this->db->getMultiRows();

        if ($rows) {
            return $rows;
        } else {
            return false;
        }
    }

    // List the users who posted the most number of 
    // blogs on 10/10/2021; if there is a tie, list 
    // all the users who have a tie.
    public function getMostBlogsOnDay($date)
    {
        // Prepare SQL query
        $this->db->query(
            'SELECT created_by, pdate, COUNT(*) AS "numBlogs" 
            FROM blogs
            WHERE pdate = :pdate
            GROUP BY created_by
            HAVING numBlogs =
            (SELECT MAX(Total) 
            FROM 
            	(SELECT COUNT(*) AS "Total"
            	FROM blogs
                WHERE pdate = :pdate
            	GROUP BY created_by)
            AS Results)'
        );

        // Bind parameters
        $this->db->bind(':pdate', $date);

        $rows = $this->db->getMultiRows();

        if ($rows) {
            return $rows;
        } else {
            return false;
        }
    }

    // List the users who are followed by both X and Y.
    // Usernames X and Y are inputs from the user
    public function getUsersFollowedBy($user1, $user2)
    {
        // Check if user1 exists
        $this->db->query('SELECT username FROM users WHERE username = :username');

        // Bind parameter
        $this->db->bind(':username', $user1);

        $firstUser = $this->db->getOneRow();

        if (!$firstUser) {
            return 'user1Error';
        }

        // Check if user2 exists
        $this->db->query('SELECT username FROM users WHERE username = :username');

        // Bind parameter
        $this->db->bind(':username', $user2);

        $secondUser = $this->db->getOneRow();

        if (!$secondUser) {
            return 'user2Error';
        }

        // Prepare SQL query
        $this->db->query('SELECT f.leadername
        FROM follows f
        JOIN follows o
        ON f.leadername = o.leadername
        WHERE f.followername = :follower1
        AND o.followername = :follower2
        ');

        // Bind parameters
        $this->db->bind(':follower1', $user1);
        $this->db->bind(':follower2', $user2);

        $rows = $this->db->getMultiRows();

        if ($rows) {
            return $rows;
        } else {
            return false;
        }
    }

    // Display all the users who never posted a blog. 
    public function getUsersNoBlogs()
    {
        // Prepare SQL query
        $this->db->query('SELECT blogid, username
        FROM users
        LEFT JOIN blogs
        ON users.username = blogs.created_by
        GROUP BY username
        HAVING blogid IS NULL;
        ');

        $rows = $this->db->getMultiRows();

        if ($rows) {
            return $rows;
        } else {
            return false;
        }
    }

    // Display all the users who posted some comments, 
    // but each of them is negative.
    public function getUsersNegativeComments()
    {
        // Prepare SQL query
        $this->db->query('SELECT posted_by, sentiment
        FROM comments
        GROUP BY posted_by
        HAVING MAX(sentiment) = :sentiment;
        ');

        // Bind parameters
        $this->db->bind(':sentiment', 'negative');

        $rows = $this->db->getMultiRows();

        if ($rows) {
            return $rows;
        } else {
            return false;
        }
    }

    // Display those users such that all the blogs they
    // posted so far never received any negative comments. 
    public function getUsersNoNegativeBlogs()
    {
        // Prepare SQL query
        $this->db->query('SELECT *
        FROM blogs b
        LEFT JOIN comments c
        ON b.blogid = c.blogid
        GROUP BY created_by
        HAVING MIN(sentiment) = :sentiment
        OR commentid IS NULL;
        ');

        // Bind parameters
        $this->db->bind(':sentiment', 'positive');

        $rows = $this->db->getMultiRows();

        if ($rows) {
            return $rows;
        } else {
            return false;
        }
    }
}
