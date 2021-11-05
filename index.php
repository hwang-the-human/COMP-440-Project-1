<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | COMP 440</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="form-container">
    <h3>Create an Account</h3>
    <span id="errors">
      <?php
      if (!empty($_GET['message'])) {
        $message = $_GET['message'];
        if ($message == 'error1') {
          echo "<h4>That username is already in use!</h4>";
        } else if ($message == 'error2') {
          echo "<h4>That email is already in use!</h4>";
        }
      }
      ?>
    </span>
    <form class="register" action="account-created.php" method="POST">
      <div class="form-group">
        <label for="username"></label>
        <input type="text" id="username" name="username" placeholder="Enter Username" required>
      </div>
      <div class="form-group">
        <label for="password1"></label>
        <input type="password" id="password1" name="password1" placeholder="Enter Password" required>
      </div>
      <div class="form-group">
        <label for="password2"></label>
        <input type="password" id="password2" name="password2" placeholder="Confirm Password" required>
      </div>
      <div class="form-group">
        <label for="firstName"></label>
        <input type="text" id="firstName" name="firstName" placeholder="Enter First Name" required>
      </div>
      <div class="form-group">
        <label for="lastName"></label>
        <input type="text" id="lastName" name="lastName" placeholder="Enter Last Name" required>
      </div>
      <div class="form-group">
        <label for="email"></label>
        <input type="email" id="email" name="email" placeholder="Enter Email" required>
      </div>
      <button type="submit" onclick="return validate()">Register</button>
      <div>
        <small>Already have an account? <a href="login.php">Log In</a></small>
      </div>
  </div>
  </form>
  <script src="main.js"></script>
</body>

</html>