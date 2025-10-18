<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h2>Student Registration</h2>
  <form method="POST">
    <input type="text" name="name" placeholder="Full Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit" name="register">Register</button>
  </form>

  <?php
  if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = md5($_POST['password']); // simple encryption

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$pass')";
    if ($conn->query($sql)) {
      echo "<p>Registration successful! <a href='login.php'>Login here</a></p>";
    } else {
      echo "<p>Error: " . $conn->error . "</p>";
    }
  }
  ?><footer>
  &copy; 2025 College Mini Project | Complaint Management System
</footer>

</body>
</html>

