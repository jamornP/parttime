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
                            <h1 class="m-0">ตรวจสอบข้อมูลการสมัครของนักศึกษา</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Check student</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <?php

            ?>
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary card-outline shadow">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                            <div class="card-header">
                                <h3 class="card-title w-100 fs-22">
                                    ข้อมูลนักศึกษา
                                </h3>
                            </div>
                        </a>
                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <div class="card-body fs-18">
                                <?php
                                $dataRegis = $sqlObj->getJobByStu($_GET['id']);
                                ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- Widget: user widget style 1 -->
                                        <div class="card card-widget widget-user">
                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                            <div class="widget-user-header text-white" style="background: url('/parttime/imges/bg.png') center center;">
                                                <h3 class="widget-user-username text-right text-muted"><?php echo $dataRegis[0]['stu_fullname']; ?></h3>
                                                <h5 class="widget-user-desc text-right text-muted"><?php echo $dataRegis[0]['stu_department']; ?></h5>
                                            </div>
                                            <div class="widget-user-image">
                                                <img class="img-circle" src="/parttime/backend/images/logo/user.png" alt="User Avatar">
                                            </div>
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header"><?php echo $sqlObj->countStuRe($_GET['id']); ?></h5>
                                                            <span class="description-text fs-14">สมัครแล้ว</span>
                                                        </div>
                                                        <!-- /.description-block -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header"><?php echo $sqlObj->countStuReAccept($_GET['id']); ?></h5>
                                                            <span class="description-text fs-14">ได้รับเลือก</span>
                                                        </div>
                                                        <!-- /.description-block -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-sm-4">
                                                        <div class="description-block">
                                                            <h5 class="description-header"><?php echo $sqlObj->countStuReDate($_GET['id']); ?></h5>
                                                            <span class="description-text fs-14">รอพิจารณา</span>
                                                        </div>
                                                        <!-- /.description-block -->
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                        </div>
                                        <!-- /.widget-user -->
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">ข้อมูลการสมัคร</h3>

                                                
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr class='fs-14'>
                                                            <th>ที่</th>
                                                            <th>งาน</th>
                                                            <th>วันที่เริ่มงาน</th>
                                                            <th>วันที่สินสุด</th>
                                                            <th>สถานะ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $dataRegis = $sqlObj->getJobByStu($_GET['id']);
                                                        // echo "<pre>";
                                                        // print_r($dataRegis);
                                                        // echo "</pre>";
                                                        $i = 0;
                                                        foreach($dataRegis AS $re){
                                                            $i++;
                                                            $dateS = datethai($re['j_s_date']);
                                                            $dateE = datethai($re['j_e_date']);
                                                            $sta = ($re['re_status'] == "register" ? "รอพิจารณา":"ได้รับเลือก");
                                                            echo "
                                                                <tr class='fs-14'>
                                                                    <td>{$i}</td>
                                                                    <td>{$re['j_name']}</td>
                                                                    <td>{$dateS}</td>
                                                                    <td>{$dateE}</td>
                                                                    <td>{$sta}</td>
                                                                </tr>
                                                            ";
                                                        }

                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                   
                                </div>


                            </div>
                            <div class="card-footer">
                                <a href="view.php?id=<?php echo $_GET['j']; ?>" class="btn btn-primary">ย้อนกลับ</a>
                            </div>
                        </div>
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