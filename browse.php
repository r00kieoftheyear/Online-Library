<?php
include 'db.php';
include 'header.php';

#check if there is a connection error

if($conn->connect_error){
  echo "Sorry, couldn't connect" . $conn->connect_error;
  exit();
}

#variables set to empty
$searchauthor = "";
$searchtitle = "";

#reserve code
if(isset($_GET['book_id'])){
  $book_id = $_GET['book_id'];
  $query = "UPDATE books SET reserved=1 WHERE id = $book_id";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  echo "<br>"."<p class='resmsg'>Reservation successful. Check <i>My Books</i> to see all reserved</p>"."<br>";
}

#search book/author code

if(isset($_POST) && !empty($_POST)){
  $searchauthor = trim($_POST['author']);
  $searchtitle = trim($_POST['title']);
}

//table join relation
$query = "SELECT books.id, books.title, authors.firstname, authors.lastname, authors.birthyear, authors.about, books.addDate FROM books
JOIN book_author ON books.id = book_author.book_id
JOIN authors ON authors.id = book_author.author_id";


if($searchtitle && !$searchauthor){
  $query = $query . " WHERE books.title LIKE '%" . $searchtitle . "%' ";
}
if($searchauthor && !$searchtitle){
  $query = $query . " WHERE authors.firstname LIKE '%" . $searchauthor . "%' ";
}
if($searchtitle && $searchauthor){
  $query = $query . " WHERE books.title LIKE '%" . $searchtitle . "%' AND authors.firstname LIKE '%" .
  $searchauthor . "%' ";
}

$stmt = $conn->prepare($query);
$stmt->bind_result($book_id, $title, $firstname, $lastname, $birthyear, $about_auth, $addDate);
$stmt->execute();


?>

<form class="searchfield" action="" method="post">
  <h1> Hello <b><?php echo htmlspecialchars($_SESSION["username"]);?></b>. You have "<b><?php echo htmlspecialchars($_SESSION["role"]);?></b>" permissions.</h1>
  <h3>Search books here:</h3>
    <input type="text" id="author" name="author" placeholder="Author of book.">
    <input type="text" id="title" name="title" placeholder="Title of book.">
    <button type="submit" class="searchButton"></i>Search</button>
</form>
<?php
# Create table with output

    echo "<table class='browsecontent'>";
    echo "<tr class='titlerow'><td>Title of Book</td>
    <td>Author Name</td>
    <td>Birthyear</td>
    <td>About Author</td>
    <td>Date Added</td></tr>";

    while($stmt->fetch()){

    echo "<td>$title</td>
          <td>$firstname $lastname</td>
          <td>$birthyear</td>
          <td>$about_auth</td>
          <td>$addDate</td>
          <td>

          <form method='get' action=''>
          <button class='reserveButton' name=' book_id'value='".$book_id."' type='submit'>Reserve Book</button>
          </form></td></tr>";
        }

        echo "</table></div>";

?>
<?php
include 'footer.php';
 ?>
