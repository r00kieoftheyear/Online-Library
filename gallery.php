<?php
include 'db.php';
include 'header.php';
?>

<div class="galleryContent">
	<h1>Gallery</h1>
	<h3>here are all of our featured photos below!</h3>
	<div>
			<?php
			$files = glob("uploads/*.*");
				for ($i=0; $i<count($files); $i++)
				{
				$num = $files[$i];
				echo '<img src="'.$num.'" alt="uploaded image">'."&nbsp;&nbsp;";
				}
			?>

	</div>
</div>


<?php
include 'footer.php';
?>
