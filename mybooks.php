<?php
    include 'db.php';
    include 'header.php';
?>

<div class="MBcontent">
  <h1>My Books</h1>
  <h3>If you have reserved a book, it will appear below. To return a book, click 'Return Book'.</h3>

<?php
  if($conn->connect_error){
    echo "Sorry, couldn't connect" . $conn->connect_error;
    exit();
  }

  # return book via bookid
  if (isset($_GET['bookid']))
  {
    $bookid = $_GET['bookid'];
    $query = "UPDATE books
              SET reserved=0
              WHERE id = $bookid";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    echo "<br>"."<p class='resmsg'>Book returned. Check <i>Browse</i> to reserve another book</p>"."<br>";

  }

  $query = "SELECT books.id, books.title, authors.firstname, authors.lastname, books.shelf_id FROM books
  JOIN book_author ON books.id = book_author.book_id
  JOIN authors ON authors.id = book_author.author_id
  WHERE books.reserved=1"; //show books that are reserved

  $stmt = $conn->prepare($query);
  $stmt->bind_result($bookid, $title, $firstname, $lastname, $shelfid);
  $stmt->execute();

  echo "<table class='MBtable'>";
  echo "<tr class='titlerow' ><td>Title of Book</td><td>Author Name</td><td>Shelf ID</td></tr>";

  while($stmt->fetch()){

  echo "<td>$title</td>
        <td>$firstname $lastname</td>
        <td>$shelfid</td>
        <td><form method='get' action=''><button name='bookid'value='".$bookid."' type='submit'>Return Book</button></form></td></tr>";
      }
  echo "</table></div>";
  ?>
  <?php
    include 'footer.php';
  ?>
