<?php
session_start();
require ('general/include/config.php');
//Include Google client library 
require_once('general/libraries/Google/autoload.php');

//Insert your cient ID and secret
$client_id = GOOGLE_OAUTH_CLIENT_ID;
$client_secret = GOOGLE_OAUTH_CLIENT_SECRET;
$redirect_uri = GOOGLE_OAUTH_REDIRECT_URI;

  //incase of logout request, just unset the session var
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");

$service = new Google_Service_Oauth2($client);
?>