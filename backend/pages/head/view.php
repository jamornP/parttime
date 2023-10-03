<?php 
    session_start();
    date_default_timezone_set('Asia/Bangkok');
?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/auth/auth.php"; ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/vendor/autoload.php"; ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/function/function.php"; ?>
<?php

use App\Model\Parttime\Auth;
$authObj = new Auth;
use App\Model\Parttime\FunctionSql;
$sqlObj = new FunctionSql;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobJobSci@kmitl.ac.th</title>
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
        <?php //require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/menu_left.php"; ?>
        <?php //require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/navbar.php"; ?>
       
        <div class="content-wrapper mt-3">
            <!-- <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">เอกสาร JobJobSci@kmitl.ac.th</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">เอกสาร JobJobSci@kmitl.ac.th</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div> -->
            <section class="content">
                <div class="container-fluid">
                    <?php
                        $j_id = $_GET['id'];
                        $data = $sqlObj->getJobById($j_id);
                        // print_r($data);
                    ?>
                    <div class="col-12" id="accordion">
                        <div class="card card-primary card-outline shadow">
                            <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                <div class="card-header">
                                    <h3 class="card-title w-100 fs-22">
                                        ชื่องาน <?php echo $data['j_name'];?>
                                    </h3>
                                </div>
                            </a>
                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                <div class="card-body fs-18">
                                    <p>
                                        <h5 class=""><b><font color="#0000ff">ชื่องาน&nbsp;</font></b></h5>
                                        <span style="font-size: 18px;"><?php echo $data['j_name'];?></span>
                                        <br style="font-size: 18px;">
                                    </p>
                                    <?php echo $data['j_detail'];?>
                                    <p>
                                        <h5 class=""><b><font color="#0000ff">วันทำงาน&nbsp;</font></b></h5>
                                        <span style="font-size: 18px;">วันที่ <?php echo datethai($data['j_s_date'])." ถึง ".datethai($data['j_e_date']);?></span>
                                        <br style="font-size: 18px;">
                                        
                                    </p>
                                    <p>
                                        <h5 class=""><b><font color="#0000ff">เวลาทำงาน&nbsp;</font></b></h5>
                                        <span style="font-size: 18px;">เวลา <?php echo $data['j_time_work'];?></span>
                                    </p>
                                    <p>
                                        <h5 class=""><b><font color="#0000ff">ค่าตอบแทน&nbsp;</font></b></h5>
                                        <span style="font-size: 18px;"><?php echo $data['pay'];?></span>
                                    </p>
                                    <p>
                                        <h5 class="text-danger"><b><font>วันที่สอบสัมภาษณ์&nbsp;</font></b></h5>
                                        <span style="font-size: 18px;">วันที่ <?php echo datethai($data['announcement_date']);?></span>
                                    </p>
                                    <hr>
                                    <p>
                                        <h5 class=""><b><font color="#0000ff">ติดต่อสอบถามรายละเอียด&nbsp;</font></b></h5>
                                        <span style="font-size: 18px;"><?php echo $data['st_name'];?></span>
                                        <br style="font-size: 18px;">
                                        <span style="font-size: 18px;">Email : <?php echo $data['st_email'];?></span>
                                        <br style="font-size: 18px;">
                                        <span style="font-size: 18px;">Tel : <?php echo $data['st_tel'];?></span>
                                        <br style="font-size: 18px;">
                                        <span style="font-size: 18px;">Line ID : <?php echo $data['st_line'];?></span>
                                        <br style="font-size: 18px;">
                                    </p>
                                    <hr>
                                    <p>
                                        <h5 class=""><b><font color="#0000ff">พิจารณา&nbsp;</font></b></h5>
                                        <?php
                                            $dataH = $sqlObj->getCountDataJobStaById("data",$j_id);
                                            // print_r($dataH);
                                            foreach($dataH as $h){
                                                if($h['num']<>0){
                                                    $name = $h['title'].$h['name']." ".$h['surname']." &nbsp;&nbsp;&nbsp;<b><font color='#0000ff'>".$h['remark']."</font></b>";
                                                    echo "
                                                        <span style='font-size: 18px;'>{$name}</span>
                                                        <br style='font-size: 18px;'>
                                                    ";

                                                }else{
                                                    $name = $h['title'].$h['name']." ".$h['surname']." &nbsp;&nbsp;&nbsp;<b><font color='#ED2939'>{$h['sta_name']}</font></b>&nbsp;&nbsp;&nbsp;<b><font color='#0000ff'>".$h['remark']."</font></b>";
                                                    echo "
                                                        <span style='font-size: 18px;'>{$name}</span>
                                                        <br style='font-size: 18px;'>
                                                    ";
                                                }

                                                
                                            }
                                        ?>
                                    </p>
                                    <hr>
                                    <p>
                                        <h5 class=""><b><font color="#0000ff">รายชื่อนักศึกษาที่ได้รับคัดเลือก&nbsp;</font></b></h5>
                                       
                                             <div class="row table-responsive">
                                                
                                             <table class="table table-hover text-nowrap fs-14">
                                                 
                                                 <thead>
                                                     <tr>
                                                         <th>ที่</th>
                                                         <th>รหัสนักศึกษา</th>
                                                         <th>ชื่อ นามสกุล</th>
                                                         <th>Email</th>
                                                         <th>ปี</th>
                                                         <th>สาขา</th>
                                                         <th>ภาควิชา</th>
                                                         <th>เบอร์โทร</th>
                                                         <th>Line</th>
                                                     </tr>
                                                 </thead>
                                                 <tbody>
                                                         <?php
                                                             $dataRegis = $sqlObj->getRegisByJidSt($j_id);
                                                             $i = 0;
                                                             foreach($dataRegis as $re){
                                                                 $i++;
                                                                 $checked = ($re['re_status']=="accept" ? "checked" :"" );
                                                                 echo "
                                                                     <tr>
                                                                         <td>{$i}</td>
                                                                         <td>{$re['stu_id']}</td>
                                                                         <td>{$re['stu_fullname']}</td>
                                                                         <td>{$re['stu_email']}</td>
                                                                         <td>{$re['stu_class']}</td>
                                                                         <td>{$re['stu_sub_department']}</td>
                                                                         <td>{$re['stu_department']}</td>
                                                                         <td>{$re['stu_tel']}</td>
                                                                         <td>{$re['stu_line']}</td>
                                                                         
                                                                     </tr>
                                                                 ";
                                                             }
                                                         ?>      
                                                     
                                                 </tbody>
                                             </table>
                                         </div>
                                         <?php
                                        ?>
                                    </P>
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
    <?php //require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/footer.php"; ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/script.php"; ?>
</body>

</html>