<?php

if(isset($_GET['get_image'])){
  $url = "https://picsum.photos/v2/list";
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $picture = json_decode(curl_exec($curl), true);
  curl_close($curl);
}



?>
<body>
  <form action="" method="get">
    <label for="get_image">Press button for image</label>
    <button type="submit" name="get_image">Image</button>
  </form>
</body>
<?php
  if(!empty($picture)){
    //$id_array = array(0, 1, 10, 100, 1000, 1001, 1002, 1003, 1004, 1005, 1006, 1008, 1009, 101, 1010, 1011, 1012, 1013, 1014, 1015, 1016, 1018, 1019, 102, 1020, 1021, 1022, 1023, 1024, 1025);
    $rand_id = random_int(1000, 1016);
    //$rand_id = array_rand($id_array);
    //echo $rand_id;
    echo 'Picture:';
    foreach($picture as $post){
      if($post['id'] == $rand_id){
      echo '<img class="pics" src= "'. $post["download_url"] .'" height="350" width="500">';
      }
    }
  }
?>
