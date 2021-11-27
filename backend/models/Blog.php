<?php
class Blog
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Get all blogs
    public function getBlogs()
    {
        // Prepare SQL query
        $this->db->query('SELECT * FROM blogs ORDER BY pdate DESC');
        $rows = $this->db->getMultiRows();

        return $rows;
    }

    // Get single blog
    public function getBlogById($blogId)
    {
        // Prepare SQL query
        $this->db->query('SELECT * FROM blogs WHERE blogid = :blogid');

        // Bind parameter
        $this->db->bind(':blogid', $blogId);

        $row = $this->db->getOneRow();

        return $row;
    }

    // Add a blog
    public function addBlog($blog)
    {
        // Prepare SQL query
        $this->db->query('INSERT INTO blogs(subject, description, pdate, created_by)
                VALUES(:subject, :description, :pdate, :created_by)');

        // Bind parameters
        $this->db->bind(':subject', $blog['subject']);
        $this->db->bind(':description', $blog['description']);
        $this->db->bind(':pdate', date('Y-m-d'));
        $this->db->bind(':created_by', $_SESSION['username']);

        // Insert into 'blogstags' table
        if ($this->db->execute()) {
            $lastId = $this->db->getLastId();

            foreach ($blog['tags'] as $tag) {
                $this->db->query('INSERT INTO blogstags(blogid, tag) VALUES(:blogid, :tag)');
                $this->db->bind(':blogid', $lastId);
                $this->db->bind(':tag', $tag);
                $this->db->execute();
            }

            return true;
        } else {
            return false;
        }
    }

    // Check if user can insert a blog
    public function canUserPostBlog($user)
    {
        // Prepare SQL query
        $this->db->query('SELECT COUNT(*) AS count FROM blogs WHERE created_by = :created_by 
        AND pdate = :pdate');

        // Bind parameter
        $this->db->bind(':created_by', $user);
        $this->db->bind(':pdate', date('Y-m-d'));

        $row = $this->db->getOneRow();

        if ($row->count < 2) {
            return true;
        } else {
            return false;
        }
    }

    // Insert comment into 'comments' table
    public function addComment($data)
    {
        // Prepare SQL query
        $this->db->query('INSERT INTO comments(sentiment, description, cdate, blogid, posted_by)
                VALUES(:sentiment, :description, :cdate, :blogid, :posted_by)');

        // Bind parameter
        $this->db->bind(':sentiment', $data['sentiment']);
        $this->db->bind(':description', $data['review']);
        $this->db->bind(':cdate', date('Y-m-d'));
        $this->db->bind(':blogid', $data['blogId']);
        $this->db->bind(':posted_by', $_SESSION['username']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Get all comments related to blog
    public function getComments($blogId)
    {
        // Prepare SQL query
        $this->db->query('SELECT sentiment, c.description, cdate, posted_by
        FROM comments c
        JOIN blogs b
        ON c.blogid = b.blogid
        WHERE c.blogid = :blogid
        ORDER BY cdate DESC');

        // Bind parameters
        $this->db->bind(':blogid', $blogId);

        $rows = $this->db->getMultiRows();

        if ($rows) {
            return $rows;
        } else {
            return false;
        }
    }

    // Check if User owns blog
    public function isUserOwner($blogId)
    {
        // Prepare SQL query
        $this->db->query('SELECT created_by FROM blogs WHERE blogid = :blogid');

        // Bind parameter
        $this->db->bind(':blogid', $blogId);

        $row = $this->db->getOneRow();

        // Check if owner of blog matches logged in user
        if ($row->created_by == $_SESSION['username']) {
            return true;
        } else {
            return false;
        }
    }

    // Check if User can comment (daily limit)
    public function canUserCommentDaily()
    {
        // Prepare SQL query
        $this->db->query('SELECT COUNT(*) AS count FROM comments
        WHERE posted_by = :posted_by AND cdate = :cdate');

        // Bind parameters
        $this->db->bind(':posted_by', $_SESSION['username']);
        $this->db->bind(':cdate', date('Y-m-d'));

        $row = $this->db->getOneRow();

        // Check if owner of blog matches logged in user
        if ($row->count < 3) {
            return true;
        } else {
            return false;
        }
    }

    // Check if User has commented on a blog
    public function hasUserCommented($blogId)
    {
        // Prepare SQL query
        $this->db->query('SELECT COUNT(*) AS count FROM comments
        WHERE posted_by = :posted_by AND blogid = :blogid');

        // Bind parameters
        $this->db->bind(':posted_by', $_SESSION['username']);
        $this->db->bind(':blogid', $blogId);

        $row = $this->db->getOneRow();

        // Check if owner of blog matches logged in user
        if ($row->count > 0) {
            return true;
        } else {
            return false;
        }
    }
}
