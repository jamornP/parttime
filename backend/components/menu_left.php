<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1e1e34;">
    <!-- Brand Logo -->
    <a href="index.html" class="brand-link">
        <img src="/parttime/imges/logo-white.png" alt="Logo" class="" style="display:table; margin: 0 auto; max-width:200px;">
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
                <a href="#" class="d-block"><?php echo $_SESSION['fullname'];?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <!-- <a href="#" class="nav-link active"> -->
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" id="myDIV">
              <?php
                switch($_SESSION['role']){
                  case "staff" || "superadmin":
                    echo "
                      <li class='nav-item'>
                        <a href='/parttime/backend/pages/staff/index.php' class='nav-link'>
                          <i class='nav-icon far fa-image'></i>
                          <p> งาน Parttime</p>
                        </a>
                      </li>
                    ";
                  break;
                }
              ?>
            </ul>
          </li>
              <!-- <li class="nav-item">
                <a href="/app-certificate/backend/pages/management/ca.php" class="nav-link">
                  <i class="nav-icon fas fa-pen-fancy"></i>
                  <p> CA</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/app-certificate/backend/pages/management/event.php" class="nav-link">
                  <i class="nav-icon fas fa-bullhorn"></i>
                  <p> Event</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/app-certificate/backend/pages/admin/ma-cer.php" class="nav-link">
                  <i class="nav-icon fas fa-search"></i>
                  <p> Check ซ้ำ</p>
                </a>
              </li> -->
             
          
      
          <li class="nav-header"></li>
          <li class="nav-header"></li>
          <li class="nav-header"></li>
          <li class="nav-header"></li>
          <li class="nav-header"></li>
          
          <li class="nav-item">
            <a href="/app-certificate/backend/auth/resetpassword.php" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>เปลี่ยน Password</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/app-certificate/backend/auth/logout.php" class="nav-link text-danger">
              <i class="nav-icon fas fa-power-off"></i>
              <p>ออกจากระบบ</p>
            </a>
          </li>
        
      </nav>
        <br>
        <br>
    </div>
   
</aside>