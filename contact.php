<?php
include 'header.php';
?>

<div class="contactinfo">
  <form class="contact" action="index.html" method="post">
    <label for="fname">First Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your name..">
    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name..">
    <label for="subject">Subject</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
    <input id="contactsubmit" type="submit" value="Submit">
  </form>
</div>

<?php
include 'footer.php';
 ?>
