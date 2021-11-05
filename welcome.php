<?php
require('connect.php');

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if ($username && $password) {
    $query = 'SELECT username, password FROM user WHERE username = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array();

    if ($row == 0 || $row[1] !== $password) {
        header('Location: http://localhost/login.php?message=error');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | COMP 440</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="http://localhost/welcome.php?init=true" method="POST">
        <div class="init-submit">
            <span>
                <?php
                if (!empty($_GET['init'])) {
                    $query = file_get_contents("university-1.sql");

                    $stmt = $conn->multi_query($query);

                    if ($stmt) {
                        echo "<h3>Database initialized successfully!</h3>";
                    } else {
                        echo "<h4>Failed to initialize database!</h4>";
                    }

                    die();
                }
                ?>
            </span>
            <button type="submit">Initialize Database</button>
        </div>
    </form>
</body>

</html>