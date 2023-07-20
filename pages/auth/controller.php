<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/parttime/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/parttime/google-api/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/parttime/pages/auth/config.php');
use App\Model\Parttime\Auth;
$authObj = new Auth;

if(isset($_GET["code"])){
    $toke = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);

}else{
    header('location: index.php');
    exit();
}

if(isset($toke["error"]) != "invalid_grant"){
    $oAuth = new Google_Service_Oauth2($gClient);
    $userData = $oAuth->userinfo_v2_me->get();
    
    // echo $userData['email'];
    // echo $userData['picture'];
    $data = $authObj->checkUserGoogle($userData['email'],$userData['picture']);
    if($data){
        echo $data;
        header('Location: /parttime/backend/pages/index.php');
        exit();
    }else{
        $dataS = $authObj->checkUserGoogleStudent($userData['email'],$userData['picture']);
        if($dataS){
            header('Location: /parttime/index.php');
            exit();
        }else{
            header('Location: /parttime/index.php');
            exit();
        }
    }
    // echo "<pre>";
    // var_dump($userData );
    // echo "</pre>";
}else{
    header('Location: index.php');
    exit();
}

?>