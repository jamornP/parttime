<?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/vendor/autoload.php"; ?>
<?php


//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('584689131463-qgtl775eq4d7ql9murb4kchhudr0lck4.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/parttime/pages/auth/index.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();
?>