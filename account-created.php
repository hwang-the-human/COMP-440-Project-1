<?php
require('connect.php');

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password1']) ? $_POST['password1'] : '';
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

$query = 'SELECT username FROM user WHERE username = ?';
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if ($row != 0) {
    header('Location: http://localhost/?message=error1');
    die();
}

$query = 'SELECT email FROM user WHERE email = ?';
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if ($row != 0) {
    header('Location: http://localhost/?message=error2');
    die();
}

$stmt = $conn->prepare('INSERT INTO user(username, password, firstName, lastName, email) 
VALUES (?, ?, ?, ?, ?)');

$stmt->bind_param('sssss', $username, $password, $firstName, $lastName, $email);

$stmt->execute();

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Created | COMP 440</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="create-success">
        <h3>Account successfully created!</h3>
        <h3><a href="login.php">Click here to login!</a></h3>
    </div>
</body>

</html>