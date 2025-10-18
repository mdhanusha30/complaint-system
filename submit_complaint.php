<?php include 'db.php'; session_start();
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit; }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Submit Complaint</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h2>Welcome, <?php echo $_SESSION['user']['name']; ?></h2>
  <form method="POST">
    <textarea name="complaint" placeholder="Enter your complaint..." required></textarea><br>
    <button type="submit" name="submit">Submit Complaint</button>
  </form>
  <a href="logout.php">Logout</a>

  <?php
  if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user']['id'];
    $complaint = $_POST['complaint'];

    $sql = "INSERT INTO complaints (user_id, complaint) VALUES ('$user_id', '$complaint')";
    if ($conn->query($sql)) {
      echo "<p>Complaint submitted successfully!</p>";
    } else {
      echo "<p>Error: " . $conn->error . "</p>";
    }
  }
  ?><footer>
  &copy; 2025 College Mini Project | Complaint Management System
</footer>

</body>
</html>
