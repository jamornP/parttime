<?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/vendor/autoload.php"; ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/function/function.php"; ?>
<?php

use App\Model\Parttime\Auth;
$authObj = new Auth;

date_default_timezone_set('Asia/Bangkok');
?>
<nav class="main-header navbar navbar-expand navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/parttime/backend/pages" class="nav-link"><i class="fas fa-home"></i> Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/parttime/backend/pages/certificate" class="nav-link"><i class="far fa-id-card"></i>  Create Certificate</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/parttime/backend/pages/certificate/template-excel.php" class="nav-link"><i class="far fa-file-excel"></i>  Themplate Excel</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item ">
            <a class="nav-link">
                <i class="far fa-bell"></i> 
                <?php 
                    if(isset($_SESSION['certificate-login'])){
                        if(isset($_SESSION['linux'])){
                            if($_SESSION['linux']){
                                echo "Linux";
                            }else{
                                echo "Windows";
                            }
                        }else{
                            echo "ยังไม่ได้เลือกระบบ";
                        }
                    }
                ?>
            </a>
        </li>
        <li class="nav-item ">
            <a href="/parttime/backend/auth/logout.php" class="nav-link text-danger">
            <i class="fa fa-power-off"></i> Logout
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li> -->
    </ul>
</nav>