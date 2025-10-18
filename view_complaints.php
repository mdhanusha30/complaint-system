<?php
include 'db.php'; // connects to your database

// Optional: mark complaint as resolved
if(isset($_GET['resolve'])){
    $id = $_GET['resolve'];
    $conn->query("UPDATE complaints SET status='Resolved' WHERE id=$id");
    header("Location: view_complaints.php"); // refresh the page
    exit;
}

$result = $conn->query("SELECT complaints.*, users.name 
                        FROM complaints 
                        JOIN users ON complaints.user_id = users.id");
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Complaints</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
  <div>Complaint Management System</div>
  <div>
    <a href="register.php">Register</a>
    <a href="login.php">Login</a>
    <a href="submit_complaint.php">Submit Complaint</a>
    <a href="view_complaints.php">Admin Dashboard</a>
    <a href="logout.php">Logout</a>
  </div>
</nav>

<div class="container">
  <h2>All Complaints</h2>

  <?php
  while($row = $result->fetch_assoc()){
      $status_class = $row['status'] == 'Pending' ? 'status-pending' : 'status-resolved';
      echo "<div class='card'>
              <strong>Student:</strong> {$row['name']}<br>
              <strong>Complaint:</strong> {$row['complaint']}<br>
              <strong>Status:</strong> <span class='$status_class'>{$row['status']}</span><br>";
      if($row['status']=='Pending'){
          echo "<a href='?resolve={$row['id']}'>Mark Resolved</a>";
      }
      echo "</div>";
  }
  ?>
</div>

<footer>
  &copy; 2025 College Mini Project | Complaint Management System
</footer>

</body>
</html>
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h2>Complaint Dashboard</h2>
  <table border="1" cellpadding="10">
    <tr>
      <th>ID</th><th>Student Name</th><th>Complaint</th><th>Status</th><th>Action</th>
    </tr>

    <?php
    $result = $conn->query("SELECT complaints.*, users.name FROM complaints 
                            JOIN users ON complaints.user_id = users.id");
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['name']}</td>
              <td>{$row['complaint']}</td>
              <td>{$row['status']}</td>
              <td><a href='?resolve={$row['id']}'>Mark Resolved</a></td>
            </tr>";
    }

    if (isset($_GET['resolve'])) {
      $id = $_GET['resolve'];
      $conn->query("UPDATE complaints SET status='Resolved' WHERE id=$id");
      header("Location: view_complaints.php");
    }
    ?>
  </table><footer>
  &copy; 2025 College Mini Project | Complaint Management System
</footer>

</body>
</html>
