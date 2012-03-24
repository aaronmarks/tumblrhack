<?php
include_once "../oauth-php/library/OAuthStore.php";
include_once "../oauth-php/library/OAuthRequester.php";
$key = "f9d9xnEI9NR0VbU5MPqQG0NPSjIqh3m7AR2IoM5k2P6TElQHER";
$secret = "rE1stBsW3zl9kq0lO6sY0jrKBc3oAVGZEaRuM9LOjsE6dR8n1s";
$oauth_token = $_GET['oauth_token'];
$oauth_verifier = $_GET['oauth_verifier'];

$options = array( 'consumer_key' => $key, 'consumer_secret' => $secret);
OAuthStore::instance("2Leg", $options );

$url = "http://www.tumblr.com/oauth/access_token"; // URL of request 
$method = "GET"; 
$params = null;

try
{
    $request = new OAuthRequester($url, $method, $params);
    $result = $request->doRequest();
    print_r($result);
}
catch(OAuthException2 $e)
{ echo "nogo";}
?>
