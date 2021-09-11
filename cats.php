<?php

if(isset($_GET['breeds_query'])){
  $breeds_url = "https://catfact.ninja/breeds?limit=1";
  $breeds_obj = [
    'limit' => 1
  ];
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $breeds_url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $response = json_decode(curl_exec($curl), true);
  curl_close($curl);
  $breeds = $response['data'];

}else if(isset($_GET['facts_query'])){
  $facts_url = "https://catfact.ninja/facts?limit=1&max_length=140";
  $facts_obj = [
    'limit' => 1,
    'max_length' => 140
  ];
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $facts_url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $response = json_decode(curl_exec($curl), true);
  curl_close($curl);

  $facts = $response['data'];
}else{
  echo "data could not be found";

}

?>
<body>
  <form action="" method="get">
    <label for="breeds_query">Press button for breeds</label>
    <button type="submit" name="breeds_query">Breeds</button>
  </form>
</body>
<?php
  if(!empty($breeds)){
    echo 'Cat Breeds:';
    foreach($breeds as $post){
      echo '<h3>' . $post['breed'] . '</h3>';
      echo '<a>Country of Origin: ' . $post['country'] . '</a>';
      echo '<p>Origin Type: ' . $post['origin'] . '</p>';
      echo '<p>Coat:' . $post['coat'] .'</p>';
      echo '<p>Pattern:' . $post['pattern'] .'</p>';
    }
  }
?>
<body>
  <form action="" method="get">
    <label for="facts_query">Press button for facts</label>
    <button type="submit" name="facts_query">Facts</button>
  </form>
</body>
<?php
  if(!empty($facts)){
    echo 'Cat Facts:';
    foreach($facts as $post){
      echo '<a>' . $post['fact'] . '</a>';
    }
  }
?>
