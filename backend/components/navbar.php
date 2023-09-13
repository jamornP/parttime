<?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/vendor/autoload.php"; ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/function/function.php"; ?>
<?php

use App\Model\Parttime\Auth;
$authObj = new Auth;
use App\Model\Parttime\FunctionSql;
$sqlObj = new FunctionSql;

date_default_timezone_set('Asia/Bangkok');
?>
<nav class="main-header navbar navbar-expand navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="" class="nav-link"><i class="fas fa-home"></i> Parttime Job</a>
        </li>
        
    </ul>
    <ul class="navbar-nav ml-auto">
        
        <li class="nav-item ">
            <div class = "nav-link text-warning"><?php echo " (".$_SESSION['role'].")";?></div>
        </li>
        <li class="nav-item ">
            <a href="/parttime/auth/logout.php" class="nav-link text-danger">
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