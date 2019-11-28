<?php
  function build_query_string(array $params) {
    $query_string = http_build_query($params);
  return $query_string;
  }
  function curl_get($url) {
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    curl_close($client);
    return $response;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Serri Jokes</title>
</head>
<body>
  <p>Number of jokes: <strong id="number"></strong></p>
  <?php
    for ($i=24; $i<100; $i++) {
      echo "<span>".$i.". </span><span id='".$i."'></span><br>";
    }
    $allSerriJokes[] = [];
    while(sizeof($allSerriJokes)<77) {
      $url = "http://api.serri.codefactory.live/random/";
      $jokeJson = curl_get($url);
      $jokeObj = json_decode($jokeJson);
      $allSerriJokes[intval($jokeObj->id_joke)] = $jokeObj->joke;
      ksort($allSerriJokes);
      foreach ($allSerriJokes as $key => $value) {
        ?>
          <script>document.getElementById('<?php echo $key; ?>').innerHTML = "<?php echo $value; ?>";</script>
          <script>document.getElementById('number').innerHTML = "<?php echo (sizeof($allSerriJokes)-1) ?>";</script>
        <?php
      }
    }
    echo "<br>";
    var_dump($allSerriJokes);
  ?>

</body>
</html>