<?php
require_once('vendor/autoload.php');
require_once('config.php');
if(isset($_GET["code"])){
    $toke = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);

}else{
    header('location: index.php');
    exit();
}

if(isset($toke["error"]) != "invalid_grant"){
    $oAuth = new Google_Service_Oauth2($gClient);
    $userData = $oAuth->userinfo_v2_me->get();
    
    echo $userData['email'];
    // echo "<pre>";
    // var_dump($userData);
    // echo "</pre>";
}else{
    header('Location: index.php');
    exit();
}

?>