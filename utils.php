<?php
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

function load_posts(){
    $connection = new TumblrOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_secret);
    //hit tumblr 1 or 2 times (20 or 40 posts), depending on how long it takes
    //create js array posts with each having type, innerhtml
}

function get_access_tokens(){
}
?>
