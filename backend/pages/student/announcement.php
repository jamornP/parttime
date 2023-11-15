<?php 
    session_start();
    date_default_timezone_set('Asia/Bangkok');
?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/auth/auth.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobJobSci@KMITL</title>
    <!-- -------- -->
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/link.php"; ?>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        
        <!-- ----- -->
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/load.php"; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/menu_left.php"; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/navbar.php"; ?>
       
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">ประกาศผล</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">ประกาศผล</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
           
            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-6">
                        <div class="card card-widget widget-user">
                        <div class="widget-user-header text-white" style="background: url('/parttime/imges/bg.png') center center;">
                            <h3 class="widget-user-username text-right text-muted"><?php echo $_SESSION['fullname']; ?></h3>
                            <h5 class="widget-user-desc text-right text-muted"><?php echo $_SESSION['stu_email']; ?></h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle" src="/parttime/backend/images/logo/user.png" alt="User Avatar">
                        </div>
                        <?php 
                            $job = $sqlObj->getJob($_GET['id']);
                            $ckAcc = $sqlObj->getRegisByJidStu($_GET['id'],$_SESSION['stu_email']);
                            // print_r($ckAcc);
                            if(count($ckAcc)> 0){
                                if($ckAcc[0]['re_status']=="accept"){
                                    echo "
                                        <div class='card-footer bg-success'>
                                            <div class='text-center'>
                                                <h4 class = 'text-center '>Job : {$job['j_name']}</h4><br>
                                                <h2 class = 'text-center '>คุณได้รับการคัดเลือก</h2>
                                                <h3 class = 'text-center'>กรุณาติดต่อ</h3>
                                                <h5 class = 'fs-20'>คุณ{$ckAcc[0]['st_name']}</h5>
                                                <h5 class = 'fs-20'>เบอร์โทร : {$ckAcc[0]['st_tel']}</h5>
                                                <h5 class = 'fs-20'>email : {$ckAcc[0]['st_email']}</h5>
                                                <h5 class = 'fs-20'>line : {$ckAcc[0]['st_line']}</h5>
                                            </div>
                                        </div>
                                    ";
                                }else{
                                    echo "
                                        <div class='card-footer bg-danger'>
                                            <div class='text-center'>
                                                <h4 class = 'text-center '>Job : {$job['j_name']}</h4><br>
                                                <h2 class = 'text-center '>คุณยังไม่ได้รับการคัดเลือก<br></h2>
                                            </div>
                                        </div>
                                    ";
                                }
                            }else{
                                echo "
                                <div class='card-footer bg-danger'>
                                    <div class='text-center'>
                                        <h4 class = 'text-center '>Job : {$job['j_name']}</h4><br>
                                        <h2 class = 'text-center '>คุณยังไม่ได้รับการคัดเลือก<br></h2>
                                    </div>
                                </div>
                            ";
                            }
                           
                        ?>
                        <br>
                        <p class="text-center">
                            <a href="work.php" class="btn btn-primary">ย้อนกลับ</a>
                        </p>
                    </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    
                </div>
            </section>
           
        </div>
        <aside class="control-sidebar control-sidebar-dark">
           
        </aside>
       
    </div>
    <!-- ---------  -->
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/footer.php"; ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/script.php"; ?>
</body>

</html>