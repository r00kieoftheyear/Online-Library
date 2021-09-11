<?php
  include 'db.php';
  include 'header.php';

  # if role isn't admin, redirect user to login page
  if($_SESSION['role'] !== 'admin'){
    header('location: rolelogin.php');
    exit();
  } else { #
    $sql="SELECT id, username, role, password FROM users";
    $stmt=$conn->prepare($sql);
    $stmt->bind_result($id, $username, $role, $password);
    $stmt->execute();
  }
?>

<div class="profile">
<div class="profilename">
<h1> Welcome to your admin profile  <b><?php echo htmlspecialchars($_SESSION["username"]);?></b></h1>
</div>
<h2>
<form class="uploadform" action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:<br>
    <input type="file" name="file" id="file"><br>
    <input class="inputbutton" type="submit" value="Upload Image" name="submit">
</form>
</div>

<?php
  include 'footer.php';
?>
