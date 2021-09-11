<?php
include 'header.php';
include 'db.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

$username = mysqli_real_escape_string($conn, trim($_POST['username']));
$password = mysqli_real_escape_string($conn, trim($_POST['password']));

if(!empty($username)) {
  $sql = "SELECT id, username, password, role FROM users
  WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);

  if($stmt->execute()){
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

    $_SESSION['id'] = $row["id"];
    $_SESSION['role'] = $row["role"];
    $_SESSION['username'] = $username;
    $_SESSION['loggedin'] = true;

  } else{
    echo "couldn't fetch row";
  }

    if($row['role'] == 'admin') {
      header("location:admin.php");
    } else if ($row['role'] == 'mod'){
      header("location:mod.php");
    } else if ($row['role'] == 'browser'){
      header("location:browse.php");
    } else {
      echo "couldn't assign page";
  }
  }
  }



?>
<body>
  <div class="loginformdiv">
    <h2>Login</h2>
    <form method="POST">
    <div class="loginformdetails">
      <p>Username</p>
      <input type="text" name="username" class="loginformcontrol">
    </div>
    <div>
      <p>Select role: </p><select name="role">
        <option value="admin">admin</option>
        <option value="mod">mod</option>
        <option value="browser">browser</option></select>
    </div>
    <div class="loginform">
      <p>Password</p>
      <input type="password" name="password" class="loginformcontrol">
    </div>
    <div class="loginform">
      <input type="submit" name="login" class="submitbtn" value="login">
    </div>
    <p>New to us? <a href="register.php">Sign up now</a>.</p>
  </form>
</div>

<?php
include 'footer.php';
?>
