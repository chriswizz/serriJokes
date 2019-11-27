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

  $allSerriJokes[] = [];
  while(sizeof($allSerriJokes)<77) {
    $url = "http://api.serri.codefactory.live/random/";
    $jokeJson = curl_get($url);
    $jokeObj = json_decode($jokeJson);
    $jokeArr = [$jokeObj->id_joke, $jokeObj->joke];

    if (!in_array($jokeArr, $allSerriJokes)) {
      $allSerriJokes[] = $jokeArr;
    }
  }
  $allSerriJokes[] = asort($allSerriJokes);
  // echo "Size: ".sizeof($allSerriJokes)."<br>";
  foreach ($allSerriJokes as $joke) {
    echo implode(", ", $joke)."<br>";
  }

?>
