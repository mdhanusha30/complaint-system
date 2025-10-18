<?php include 'db.php'; session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h2>Student Login</h2>
  <form method="POST">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit" name="login">Login</button>
  </form>

  <?php
  if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
      $_SESSION['user'] = $result->fetch_assoc();
      header("Location: submit_complaint.php");
    } else {
      echo "<p>Invalid credentials!</p>";
    }
  }
  ?><footer>
  &copy; 2025 College Mini Project | Complaint Management System
</footer>

</body>
</html>
