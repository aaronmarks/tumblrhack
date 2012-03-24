<?php
include_once "../oauth-php/library/OAuthStore.php";
include_once "../oauth-php/library/OAuthRequester.php";
$key = "f9d9xnEI9NR0VbU5MPqQG0NPSjIqh3m7AR2IoM5k2P6TElQHER";
$secret = "rE1stBsW3zl9kq0lO6sY0jrKBc3oAVGZEaRuM9LOjsE6dR8n1s";

$options = array( 'consumer_key' => $key, 'consumer_secret' => $secret );
OAuthStore::instance("2Leg", $options );

$url = "http://www.tumblr.com/oauth/request_token"; // URL of request 
$method = "GET";  
$params = null;

try
{
    $request = new OAuthRequester($url, $method, $params);
    $result = $request->doRequest();
    $response = explode('=', $result['body']);
    $oauth_token = substr($response[1], 0, strpos($response[1], "&"));
    $oauth_token_secret = substr($response[2], 0, strpos($response[2], "&"));
}
catch(OAuthException2 $e)
{}

$authorize_url = "http://www.tumblr.com/oauth/authorize"; //send them to tumblr to authorize 
header('Location: ' . $authorize_url . '?oauth_token=' . $oauth_token . '&oauth_token_secret=' . $oauth_token_secret);
?>
