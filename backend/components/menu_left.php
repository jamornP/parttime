<?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/vendor/autoload.php"; ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/function/function.php"; ?>
<?php

use App\Model\Parttime\Auth;
$authObj = new Auth;
use App\Model\Parttime\FunctionSql;
$sqlObj = new FunctionSql;

date_default_timezone_set('Asia/Bangkok');
?>
<?php 
if(isset($_SESSION['m_email'])){
  $dataJob = count($sqlObj->getJobByHEmail($_SESSION['m_email'])); 
  if($dataJob > 0){
    $text = "<span class='badge badge-danger right'>{$dataJob}</span>";
  }else{
    $text="";
  }
}
  
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1e1e34;">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="/parttime/imges/logo-jobjob.png" alt="Logo" class="" style="display:table; margin: 0 auto; max-width:200px;">
        <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo $_SESSION['img'];?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block fs-12"><?php echo $_SESSION['fullname'];?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  JobJobSci@KMITL
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" id="myDIV"> -->
                <?php
                  switch($_SESSION['role']){
                    case "superadmin" :
                      
                      echo "
                          <li class='nav-item menu-open'>
                            <a href='#' class='nav-link active'>
                              <i class='nav-icon fas fa-home'></i>
                              <p>
                                head
                                <i class='right fas fa-angle-left'></i>
                              </p>
                            </a>
                            <ul class='nav nav-treeview' id='myDIV'>
                      ";
                      echo "
                              <li class='nav-item'>
                                <a href='/parttime/backend/pages/head/index.php' class='nav-link'>
                                  <i class='nav-icon fas fa-marker'></i>
                                  <p> 
                                    พิจารณา 
                                    {$text}
                                  </p>
                                </a>
                              </li>
                      ";
                      echo "
                            </ul>
                          </li>
                      ";
                      echo "
                          <li class='nav-item menu-open'>
                            <a href='#' class='nav-link active'>
                              <i class='nav-icon fas fa-home'></i>
                              <p>
                                staff
                                <i class='right fas fa-angle-left'></i>
                              </p>
                            </a>
                            <ul class='nav nav-treeview' id='myDIV2'>
                      ";
                      echo "
                              <li class='nav-item'>
                                <a href='/parttime/backend/pages/staff/index.php' class='nav-link'>
                                  <i class='nav-icon fas fa-user-circle'></i>
                                  <p> งาน Part Time</p>
                                </a>
                              </li>
                      ";
                      echo "
                            </ul>
                          </li>
                      ";
                      echo "
                          <li class='nav-item menu-open'>
                            <a href='#' class='nav-link active'>
                              <i class='nav-icon fas fa-cogs'></i>
                              <p>
                                Superadmin
                                <i class='right fas fa-angle-left'></i>
                              </p>
                            </a>
                            <ul class='nav nav-treeview' id='myDIV'>
                      ";
                      echo "
                              <li class='nav-item'>
                                <a href='/parttime/backend/pages/admin/route.php' class='nav-link'>
                                  <i class='nav-icon fas fa-share-alt'></i>
                                  <p> เส้นทาง </p>
                                </a>
                              </li>
                      ";
                      echo "
                              <li class='nav-item'>
                                <a href='/parttime/backend/pages/admin/staff.php' class='nav-link'>
                                  <i class='nav-icon fas fa-user-alt'></i>
                                  <p> เจ้าหน้าที่ </p>
                                </a>
                              </li>
                      ";
                      echo "
                              <li class='nav-item'>
                                <a href='/parttime/backend/pages/admin/head.php' class='nav-link'>
                                  <i class='nav-icon fas fa-diagnoses'></i>
                                  <p> ผู้บริหาร </p>
                                </a>
                              </li>
                      ";
                      echo "
                              <li class='nav-item'>
                                <a href='/parttime/backend/pages/admin/resetpassword.php' class='nav-link'>
                                  <i class='nav-icon fas fa-undo-alt'></i>
                                  <p> ResetPassword </p>
                                </a>
                              </li>
                      ";
                      echo "
                            </ul>
                          </li>
                      ";
                    break;
                    case "admin" :
                     
                      echo "
                          <li class='nav-header fs-16'>เจ้าหน้าที่</li>
                          <li class='nav-item '>
                            <a href='/parttime/backend/pages/staff/index.php' class='nav-link active'>
                              <i class='nav-icon fas fa-user-circle'></i>
                              <p> งาน Part Time</p>
                            </a>
                          </li>
                      ";
                      echo "
                          <li class='nav-header fs-16'>ผู้บริหาร</li>
                          <li class='nav-item'>
                            <a href='/parttime/backend/pages/head/index.php' class='nav-link'>
                              <i class='nav-icon fas fa-marker'></i>
                              <p> 
                                พิจารณา
                                {$text} 
                              </p>
                            </a>
                          </li>
                      ";
                      echo "
                      <li class='nav-item'>
                        <a href='#' class='nav-link'>
                          <i class='nav-icon fas fa-cogs'></i>
                          <p>
                            Setup ระบบ
                            <i class='right fas fa-angle-left'></i>
                          </p>
                        </a>
                        <ul class='nav nav-treeview' id='myDIV'>
                  ";
                  
                  echo "
                          <li class='nav-item'>
                            <a href='/parttime/backend/pages/admin/route.php' class='nav-link'>
                              <i class='nav-icon fas fa-share-alt'></i>
                              <p> เส้นทาง </p>
                            </a>
                          </li>
                  ";
                  echo "
                          <li class='nav-item'>
                            <a href='/parttime/backend/pages/admin/staff.php' class='nav-link'>
                              <i class='nav-icon fas fa-user-alt'></i>
                              <p> เจ้าหน้าที่ </p>
                            </a>
                          </li>
                  ";
                  echo "
                          <li class='nav-item'>
                            <a href='/parttime/backend/pages/admin/head.php' class='nav-link'>
                              <i class='nav-icon fas fa-diagnoses'></i>
                              <p> ผู้บริหาร </p>
                            </a>
                          </li>
                  ";
                  echo "
                          <li class='nav-item'>
                            <a href='/parttime/backend/pages/admin/resetpassword.php' class='nav-link'>
                              <i class='nav-icon fas fa-undo-alt'></i>
                              <p> ResetPassword </p>
                            </a>
                          </li>
                  ";
                  echo "
                        </ul>
                      </li>
                  ";
                    break;
                    case "staff" :
                      echo "
                          <li class='nav-item'>
                            <a href='/parttime/backend/pages/staff/index.php' class='nav-link active'>
                              <i class='nav-icon fas fa-user-circle'></i>
                              <p> งาน Part Time</p>
                            </a>
                          </li>
                      ";
                    break;
                    case "head" :
                      echo "
                          <li class='nav-item'>
                            <a href='/parttime/backend/pages/head/index.php' class='nav-link' active>
                              <i class='nav-icon fas fa-marker'></i>
                              <p> 
                                พิจารณา
                                {$text} 
                              </p>
                            </a>
                          </li>
                      ";
                    break;
                  }
                ?>
            
            <li class="nav-header"></li>
            <li class="nav-header"></li>
            <li class="nav-header"></li>
            <li class="nav-header"></li>
            <li class="nav-header"></li>
            
            <li class="nav-item">
              <a href="/parttime/auth/resetpassword.php" class="nav-link">
                <i class="nav-icon fas fa-key"></i>
                <p>เปลี่ยน Password</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/parttime/auth/logout.php" class="nav-link text-danger">
                <i class="nav-icon fas fa-power-off"></i>
                <p>ออกจากระบบ</p>
              </a>
            </li>
        </nav>
        <br>
        <br>
    </div>
   
</aside>