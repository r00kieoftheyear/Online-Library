<?php
define('UPLOAD_PATH', 'uploads/');

if (isset($_POST['submit'])) {
  $file = $_FILES['file'];
  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];
  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));
  $allowed = array('jpg', 'jpeg', 'gif', 'png');

if(in_array($fileActualExt, $allowed)){
  if ($fileError === 0){
    if ($fileSize < 600000){
      $fileDestination = UPLOAD_PATH . $fileName;
      move_uploaded_file($fileTmpName, $fileDestination);
      header("Location: admin.php?uploadsuccess");
      # show image #
      echo 'img src="' . UPLOAD_PATH . $fileName . '" alt="uploaded image" /></p>';
      echo "<br>"."<p class='resmsg'> Upload successful. Check <i>Gallery</i> to view image</p>"."<br>";
    }else{
      echo "file is too big!";
      }
    }else{
      echo "file type not allowed";
    }
  }
}
?>
