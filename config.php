<?php
    require_once('google-api/vendor/autoload.php');
    $gClient = new Google_Client();
    $gClient->setClientId("584689131463-qgtl775eq4d7ql9murb4kchhudr0lck4.apps.googleusercontent.com");
    $gClient->setClientSecret("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");
    $gClient->setApplicationName("Part Time Job");
    $gClient->setRedirectUri("http://localhost/parttime/controller.php");
    $gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

    $login_url = $gClient->createAuthUrl();

?>