<?php
require_once('googleapi/vendor/autoload.php');
session_start();
$client = new Google_Client();
$client->setAuthConfig('client_2.json');
// $client->addScope(Google\Service\Oauth2);
// $client->setRedirectUri("");
print_r($client);
?>