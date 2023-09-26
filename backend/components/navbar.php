
<nav class="main-header navbar navbar-expand navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        
        <?php
            if(isset($_SESSION['role']) AND ($_SESSION['role']=='head' OR $_SESSION['role'] == 'superadmin' OR $_SESSION['role'] == 'admin')){
                echo "
                    <li class='nav-item d-none d-sm-inline-block'>
                        <a href='/parttime/backend/pages/head/parttime.php' class='nav-link'><i class='fas fa-home'></i> Part Time Job ผู้บริหาร</a>
                    </li>
                ";
                if($_SESSION['role'] == 'superadmin'){
                    echo "
                    <li class='nav-item d-none d-sm-inline-block'>
                        <a href='/parttime/backend/pages/student' class='nav-link'><i class='fas fa-home'></i> Part Time Job Student</a>
                    </li>
                ";
                }
            }elseif(isset($_SESSION['role']) AND $_SESSION['role']=='student'){
                echo "
                    <li class='nav-item d-none d-sm-inline-block'>
                        <a href='/parttime/backend/pages/student' class='nav-link'><i class='fas fa-home'></i> Part Time Job</a>
                    </li>
                ";
            }
        ?>
        
    </ul>
    <ul class="navbar-nav ml-auto">
        
        <li class="nav-item ">
            <div class = "nav-link text-warning">
                <?php 
                    if(isset($_SESSION['m_email'])){
                        echo $_SESSION['m_email']." (".$_SESSION['role'].")";
                    }else{
                        echo $_SESSION['stu_email']." (".$_SESSION['role'].")";
                    }
                    
                ?>
            </div>
        </li>
        <li class="nav-item ">
            <a href="/parttime/auth/logout.php" class="nav-link text-danger">
            <i class="fa fa-power-off"></i> Logout
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>            </a>
        </li> -->
    </ul>
</nav>