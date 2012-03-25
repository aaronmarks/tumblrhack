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

function load_post_xml(){
    $access_token = $_SESSION['access_token']['oauth_token'];
    $access_secret = $_SESSION['access_token']['oauth_token_secret'];
    $connection = new TumblrOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_secret);

    $dash = $connection->dashboard(null);
    $xml = simplexml_load_string($dash);  //simplexml w/ 10 dash posts
   
    return $xml;
}

function post_array_from_xml($post_xml) {
    $i = 0;
    foreach($post_xml->posts->post as $post) {
        $type = $post->attributes()->type;
        $posts[$i]["type"] = $type;

        if($type == "photo") {
            $posts[$i]['content'] = "<img src='".$post->{'photo-url'}[0]."' />";
        }
        if($type == "video") {
            $posts[$i]['content'] = $post->{'video-player'}[1];
        }
        if($type == "regular") {
            $title = $post->{'regular-title'};
            $text = $post->{'regular-body'};
            $posts[$i]['content'] = "<h2>$title</h2><p>$text</p>";
        }

        $i++;
    }

    return $posts;
}

?>
