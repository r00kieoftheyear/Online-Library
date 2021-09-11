<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
@ob_start();
session_start();
//check for ip  address
if (isset($_COOKIE['counter'])) //isset() finds out if cookie is set
    $count = $_COOKIE['counter'];// $_COOKIE is global variable that retrieves value of the cookie
else
    $count = 0;
$count = $count + 1;
setcookie('counter', $count, time() + 24 * 3600, '/', 'localhost', false); //cookie created here
?>
<html>
    <body>
        <FORM action="cookie.php" method="GET">
            <INPUT type="submit" name="Count" value="Count">
            <?php
            echo "count is $count";
            ?>
        </FORM>
    </body>
</html>
