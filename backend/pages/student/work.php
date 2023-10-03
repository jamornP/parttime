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
                            <h1 class="m-0">งานที่สมัคร</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">งานที่สมัคร</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class='text-center'>ที่</th>
                                <th class='text-center'>ชื่องาน</th>
                                <th class='text-center'>วันที่เริ่มงาน</th>
                                <th class='text-center'>วันที่รับสมัคร</th>
                                <th class='text-center'>วันที่สอบสัมภาษณ์</th>
                                <th class='text-center'>ค่าตอบแทน</th>
                                <th class='text-center'>รับ/สมัคร</th>
                                <th class='text-center'>ผู้รับผิดชอบ</th>
                                <th class='text-center'>เบอร์โทร</th>
                                <th class='text-center'>ประกาศผล</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?PHP 
                                $dataJob = $sqlObj->getJobAccept();
                                $i = 0;
                                foreach($dataJob as $j){
                                    $stu = $sqlObj->countStuRegisByJId($j['j_id']);
                                    $i++;
                                    $dateWork = datethai($j['j_s_date'])." - ".datethai($j['j_e_date']); 
                                    $dateRegister = datethai($j['regis_s_date'])." - ".datethai($j['regis_e_date']); 
                                    $dateInterview = datethai($j['interview_date']); 
                                    
                                    $dateN = date("Y-m-d");
                                    if($dateN > $j['announcement_date']){
                                        $dateAnnouncement = "<a href='announcement.php?id={$j['j_id']}'><i class='fas fa-bell text-danger'></i> ประกาศผล</a>";
                                        $color ="";
                                    }else{
                                        $dateAnnouncement = datethai($j['announcement_date']); 
                                        $color ="text-warning";
                                    }
                                    echo "
                                        <tr class='fs-14'>
                                            <td>{$i}</td>
                                            <td><a href='register.php?id={$j['j_id']}'>{$j['j_name']}</a></td>
                                            <td class='text-center'>{$dateWork}</td>
                                            <td class='text-center text-success'>{$dateRegister}</td>
                                            <td class='text-center text-danger'>{$dateInterview}</td>
                                            <td>{$j['pay']}</td>
                                            <td class='text-center'>{$j['count_student']}/{$stu}</td>
                                            <td class='text-center'>{$j['st_name']}</td>
                                            <td class='text-center'>{$j['st_tel']}</td>
                                            <td class='text-center {$color}'><b>{$dateAnnouncement}</b></td>
                                            
                                        </tr>
                                    ";
                                }
                            ?>
                        </tbody>
                    </table>
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