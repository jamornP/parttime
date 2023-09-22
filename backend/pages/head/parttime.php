<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Part Time Job</title>
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
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="/parttime/imges/logo.png" alt="Science" height="70" width="360">
        </div>
        <!-- ----- -->
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/load.php"; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/menu_left.php"; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/navbar.php"; ?>
       
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Parttime Job ทั้งหมด</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Parttime Job ทั้งหมด</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ข้อมูลงาน</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class='text-center'>ที่</th>
                                            <th class='text-center'>ชื่องาน</th>
                                            <th class='text-center'>วันที่เริ่มงาน</th>
                                            <th class='text-center'>ค่าตอบแทน</th>
                                            <th class='text-center'>รับ/สมัคร</th>
                                            <th class='text-center'>ผู้รับผิดชอบ</th>
                                            <th class='text-center'>เบอร์โทร</th>
                                            <th class='text-center'>สถานะ</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?PHP 
                                            $dataJob = $sqlObj->getJobAll();
                                            // $dataJob = $sqlObj->getJobByEmail('akarit.ta@kmitl.ac.th');
                                            $i = 0;
                                            foreach($dataJob as $j){
                                                $stu = $sqlObj->countStuRegisByJId($j['j_id']);
                                                $i++;
                                                $dateWork = datethai($j['j_s_date'])." - ".datethai($j['j_e_date']); 
                                                echo "
                                                    <tr class='fs-14'>
                                                        <td>{$i}</td>
                                                        <td>{$j['j_name']}</td>
                                                        <td class='text-center'>{$dateWork}</td>
                                                        <td>{$j['pay']}</td>
                                                        <td class='text-center'>{$j['count_student']}/{$stu}</td>
                                                        <td class='text-center'>{$j['st_name']}</td>
                                                        <td class='text-center'>{$j['st_tel']}</td>
                                                        <td class='text-center'>{$j['status']}</td>
                                                        <td class='text-center'>
                                                            <a href='view.php?id={$j['j_id']}' target='_blank'><i class='fas fa-eye text-primary'></i> </a>
                                                        </td>
                                                    </tr>
                                                ";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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