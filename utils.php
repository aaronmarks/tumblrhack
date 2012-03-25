<?php
session_start();
function query($query) {
    $username = tumblr;
    $password = hackny2012isgreat;

    mysql_connect("localhost", $username, $password) or die(mysql_error());
    mysql_select_db("tumblrhack") or die(mysql_error());
    $result = mysql_query($query);
    $row = mysql_fetch_array( $result );
    mysql_close();

    return $row;
}

function get_gif_urls() {
    $url = "http://api.tumblr.com/v2/tagged?tag=gif&api_key=f9d9xnEI9NR0VbU5MPqQG0NPSjIqh3m7AR2IoM5k2P6TElQHER";
    $result = json_decode(file_get_contents($url));
    foreach($result->response as $response) {
        $gif_urls[] = $response->photos[0]->original_size->url;
    }

    return $gif_urls;
}

function post_array_from_gifs($urls) {
    $i = 0;
    foreach($urls as $url) {
        $posts[$i]["author"] = "THE INTERNET";
        $posts[$i++]["content"] = "<img src='$url' />";
    }

    return $posts;
}

function load_post_xml($type){
    $access_token = $_SESSION['access_token']['oauth_token'];
    $access_secret = $_SESSION['access_token']['oauth_token_secret'];
    $connection = new TumblrOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_secret);

    $params = array('num' => 50, 'type' => $type);
    $dash = $connection->dashboard($params);
    $xml = simplexml_load_string($dash);  //simplexml w/ 50 dash posts
    return $xml;
}

function post_array_from_xml($post_xml) {
    $i = 0;
    foreach($post_xml->posts->post as $post) {
        if ($post->attributes()->{'direct-video'}) { continue; } //cant display videos directly uploaded to tumblr...
        $type = $post->attributes()->type;
        $posts[$i]["type"] = $type;
        $author = $post->attributes()->tumblelog;
        $posts[$i]["author"] = $author;

        if($type == "photo") {
            $posts[$i]['content'] = addslashes("<img src='".$post->{'photo-url'}[1]."' />");
        }
        if($type == "video") {
            $base_content = addslashes($post->{'video-player'}[1]);
            if (strpos($base_content, "youtube")) { // handle youtube
                $q = strpos($base_content, "?");
                $first_half = substr($base_content, 0, $q+1);
                $second_half = substr($base_content, $q+1);
                $new_content = $first_half . "autoplay=1&amp;" . $second_half;
            } else { //handle vimeo
                $q = strpos($base_content, "width");
                $first_half = substr($base_content, 0, $q-3);
                $second_half = substr($base_content, $q-3);
                $new_content = $first_half . "?autoplay=1" . $second_half;
            }
            $posts[$i]['content'] = $new_content;
        }
        if($type == "regular") {
            $title = $post->{'regular-title'};
            $text = $post->{'regular-body'};
            $text = preg_replace('/[^(\x20-\x7F)]*/','', $text);
            $posts[$i]['content'] = addslashes("<h2>$title</h2><p>$text</p>");
        }

        $i++;
    }

    return $posts;
}

?>
