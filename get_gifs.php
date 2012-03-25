<?php
$url = "http://api.tumblr.com/v2/tagged?tag=gif&api_key=f9d9xnEI9NR0VbU5MPqQG0NPSjIqh3m7AR2IoM5k2P6TElQHER";
$result = json_decode(file_get_contents($url));
foreach($result->response as $response) {
    $gif_urls[] = $response->photos[0]->original_size->url;
}

print_r($gif_urls);
?>
