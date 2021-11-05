<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | COMP 440</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="form-container">
        <h3>Log In</h3>
        <span class="errors">
            <?php
            if (!empty($_GET['message'])) {
                echo "<h4>Username or password is invalid!</h4>";
            }
            ?>
        </span>
        <form class="login" action="welcome.php" method="POST">
            <div class="form-group">
                <label for="username"></label>
                <input type="text" id="username" name="username" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <label for="password"></label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
            </div>
            <button type="submit">Log In</button>
            <div>
                <small>Need an account? <a href="/">Sign Up</a></small>
            </div>
    </div>
    </form>
</body>

</html>