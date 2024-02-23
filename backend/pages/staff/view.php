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
                            <h1 class="m-0">เอกสาร JobJobSci@KMITL</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">เอกสาร JobJobSci@KMITL</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <?php
                        $j_id = $_GET['id'];
                        $data = $sqlObj->getJobById($j_id);
                        // print_r($data);
                        if(isset($_POST['add'])){
                            unset($_POST['add']);
                            $dataStu = $sqlObj->getStuByEmail($_POST['stu_email']);
                            $_POST['stu_name'] = $dataStu['stu_fullname'];
                            $_POST['stu_id'] = $dataStu['stu_id'];
                            $_POST['re_date'] = date("Y-m-d H:i:s");
                            $_POST['re_status'] = "accept";
                            // echo "<pre>"; 
                            // print_r($_POST);
                            // echo"</pre>";
                            $dataD['j_id'] = $_POST['j_id'];
                            $dataD['stu_email'] = $_POST['stu_email'];
                            // print_r($dataD);
                            $ckD = $sqlObj->countRegisByJidStu($dataD);
                            if($ckD>0){
                                $msg = "เคยลงทะเบียนไว้แล้ว";
                                echo "<script>";
                                echo "alertSuccess('{$msg}','index.php')";
                                echo "</script>";
                            }else{
                                $ck = $sqlObj->addRegister($_POST);
                                if($ck){
                                    $msg = "บันทึกข้อมูลเรียบร้อย";
                                    echo "<script>";
                                    echo "alertSuccess('{$msg}','view.php?id={$dataD['j_id']}')";
                                    echo "</script>";
                                } else {
                                    $msg = "บันทึกข้อมูลไม่สำเร็จ !";
                                    echo "<script>";
                                    echo "alertError('{$msg}','view.php?id={$dataD['j_id']}')";
                                    echo "</script>";
                                }
                            }
                            
                        }
                        if(isset($_POST['edit'])){
                            unset($_POST['edit']);
                            $_POST['m_email'] = $_SESSION['m_email'];
                            $_POST['js_id'] = 1;
                            $_POST['status'] = "ส่งเรื่อง";
                            $_POST['date_add']=date("Y-m-d H:i:s");
                            // echo "<pre>";
                            // print_r($_POST);
                            // echo "</pre>";
                            $ck =$sqlObj->updateJob($_POST);
                            // echo $ck;
                            if ($ck) {
                                $udata['j_id'] = $j_id;
                                $udata['num'] = 1;
                                $ckUdata = $sqlObj->countDataJobStaByIdNum($udata);
                                if($ckUdata){
                                    $msg = "แก้ไขข้อมูลเรียบร้อย";
                                    echo "<script>";
                                    echo "alertSuccess('{$msg}','index.php')";
                                    echo "</script>";
                                }else{
                                    $dataJ['num']=1;
                                    $dataJ['j_id']=$j_id;
                                    $dataJ['sta_name']="ส่งเรื่อง";
                                    $dataJ['j_sta_date']=$_POST['date_add'];
                                    $dataJ['m_email']=$_POST['m_email'];
                                    $dataJ['remark']="แก้ไขแล้ว";
                                    $ckS = $sqlObj->addDataJobSta($dataJ);
                                    $dataHemail = $sqlObj->getEmailByMEmailRo($dataJ['m_email'],$dataJ['num']);
                                    $msgParttime = $dataHemail['title'].$dataHemail['name']." ".$dataHemail['surname']."\nเรื่อง{$_POST['j_name']}\n " ;
                                    $ckLine = SentLineBasic("TguOefB2TCfmfcvmBjySvAQHoQw4FHCzgb1NbuSUvpp",$msgParttime);
                                    $msg = "แก้ไขข้อมูลเรียบร้อย";
                                    echo "<script>";
                                    echo "alertSuccess('{$msg}','index.php')";
                                    echo "</script>";
                                }
                               
                            } else {
                            $msg = "แก้ไขข้อมูลไม่สำเร็จ !";
                            echo "<script>";
                            echo "alertError('{$msg}','index.php')";
                            echo "</script>";
                            }
                        }
                        if(isset($_POST['select'])){
                            if(isset($_POST['stu_id'])){
                                foreach($_POST['stu_id'] as $st){
                                    $dataSt['re_status']="accept";
                                    $dataSt['re_id'] = $st;
                                    $dataStuRe = $sqlObj->updateStatusRegis($dataSt);
                                    // print_r($dataSt);
                                }
                                if($dataStuRe){
                                    $msg = "เรียบร้อย";
                                    echo "<script>";
                                    echo "alertSuccess('{$msg}','index.php')";
                                    echo "</script>";
                                }else{
                                    $msg = "ไม่สำเร็จ !";
                                    echo "<script>";
                                    echo "alertError('{$msg}','index.php')";
                                    echo "</script>";
                                }
                            }else{
                                $msg = "กรุณาเลือกคนก่อน !";
                                    echo "<script>";
                                    echo "alertError('{$msg}','index.php')";
                                    echo "</script>";
                            }
                            // $dataSt['re_id'] = 
                            // $dataStuRe = $sqlObj->updateStatusRegis($dataSt);
                            // echo "<pre>";
                            // print_r($_POST);
                            // echo"</pre>";
                        }
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
                                    <!-- <p>
                                        <h5 class=""><b><font color="#0000ff">รายละเอียดงาน&nbsp;</font></b></h5>
                                        <span style="font-size: 18px;"><?php echo $data['j_detail'];?></span>
                                        <br style="font-size: 18px;">
                                    </p>
                                    <p>
                                        <h5 class=""><b><font color="#0000ff">คุณสมบัติของผู้สมัคร&nbsp;</font></b></h5>
                                        <span style="font-size: 18px;"><?php echo $data['j_detail_two'];?></span>
                                        <br style="font-size: 18px;">
                                    </p> -->
                                    <p>
                                        <?php echo $data['j_detail'];?>
                                    </p>
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
                                        <h5 class="text-success"><b><font>วันที่รับสมัคร&nbsp;</font><font color="#ED2939">*</font></b></h5>
                                        <span style="font-size: 18px;"><b>วันที่ 
                                            <?php
                                                $dateRegister = datethai($data['regis_s_date'])." - ".datethai($data['regis_e_date']); 
                                                echo $dateRegister;
                                            ?>
                                            </b>
                                        </span>
                                    </p>
                                    <p>
                                        <h5 class="text-danger"><b><font>วันที่สอบสัมภาษณ์&nbsp;</font></b></h5>
                                        <span style="font-size: 18px;"><b>
                                        <?php 
                                            if($data['interview_date']!='0000-00-00'){
                                                echo 'วันที่ '.datethai($data['interview_date']);
                                            }else{
                                                echo "-";
                                            }
                                        ?>
                                        </b></span>
                                        <br style="font-size: 18px;">
                                        <span style="font-size: 18px;"><b>สถานที่ <?php echo $data['in_location'];?></b></span>
                                        <br style="font-size: 18px;">
                                        <span style="font-size: 18px;"><b>เวลา <?php echo $data['in_time'];?></b></span>
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
                                        <span style="font-size: 18px;">สถานที่ : <?php echo $data['st_location'];?></span>
                                        <br style="font-size: 18px;">
                                    </p>
                                    <hr>
                                    <p>
                                        <h5 class=""><b><font color="#0000ff">พิจารณา&nbsp;&nbsp;&nbsp;&nbsp;สถานะปัจจุบัน :</font><font color="#ED2939">&nbsp;<?php echo $data['status'];?></font></b></h5>
                                        <?php
                                            $dataH = $sqlObj->getCountDataJobStaById("data",$j_id);
                                            // print_r($dataH);
                                            foreach($dataH as $h){
                                                if($h['num']<> 1 AND $h['num'] <> 0){
                                                    if($h['sta_name']=="เห็นชอบ" OR $h['sta_name']=="อนุมัติ"){
                                                        $remark = "";
                                                        if($h['sta_name']=="อนุมัติ"){
                                                            $color = "#008000";
                                                        }else{
                                                            $color = "#0000ff";
                                                        }
                                                    }else{
                                                        $color = "#ED2939";
                                                        $remark = "&nbsp;&nbsp;&nbsp;เหตุผล :&nbsp;&nbsp;&nbsp;<b><font color='#0000ff'>".$h['remark']."</font></b>";
                                                    }
                                                    $name = $h['title'].$h['name']." ".$h['surname']." &nbsp;&nbsp;&nbsp;<b><font color='{$color}'>{$h['sta_name']}</font></b>{$remark}";
                                                    echo "
                                                        <span style='font-size: 18px;'>{$name}</span>
                                                        <br style='font-size: 18px;'>
                                                    ";
                                                }
                                            }
                                            if($data['js_id']== 0 OR $data['status']== "ส่งเรื่อง" OR $data['status']== "ตีกลับ"){
                                                echo  "
                                                    <button type='button' class='btn btn-warning text-white mt-5' data-toggle='modal' data-target='#modal-edit'>
                                                        <i class='fas fa-magic'></i> แก้ไข
                                                    </button>
                                                ";
                                            }
                                        ?>
                                    </p>
                                    <hr>
                                    <?php
                                    if($h['sta_name']=="อนุมัติ"){
                                    ?>
                                        <p>
                                            <h5 class=""><b><font color="#0000ff">นักศึกษาที่สมัคร&nbsp;</font></b></h5>
                                            <form action="" method="post">
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
                                                                <th>เลือก</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $dataRegis = $sqlObj->getRegisByJid($j_id);
                                                                $i = 0;
                                                                foreach($dataRegis as $re){
                                                                    $i++;
                                                                    $checked = ($re['re_status']=="accept" ? "checked" :"" );
                                                                    echo "
                                                                        <tr>
                                                                            <td>{$i}</td>
                                                                            <td>{$re['stu_id']}</td>
                                                                            <td><a href='check.php?id={$re['stu_id']}&j={$j_id}'>{$re['stu_fullname']}</a></td>
                                                                            <td>{$re['stu_email']}</td>
                                                                            <td>{$re['stu_class']}</td>
                                                                            <td>{$re['stu_sub_department']}</td>
                                                                            <td>{$re['stu_department']}</td>
                                                                            <td>{$re['stu_tel']}</td>
                                                                            <td>{$re['stu_line']}</td>
                                                                            <td>
                                                                                <div class='form-group clearfix'>
                                                                                    <div class='icheck-success d-inline '>
                                                                                        <input type='checkbox' id='checkboxSuccess{$i}' name='stu_id[]' value='{$re['re_id']}' {$checked}>
                                                                                        <label for='checkboxSuccess{$i}' class='fs-14'>
                                                                                            เลือก
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    ";
                                                                }
                                                            ?>      
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <hr>
                                                <div class="d-flex justify-content-end">
                                                            <div class="col-sm-6 d-flex flex-row-reverse bd-highlight">
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
                                                                    <i class="far fa-id-badge"></i> เพิ่มผู้สมัครเอง
                                                                </button>
                                                            </div>
                                                <?php
                                                    if(count($dataRegis)>0){
                                                    ?>
                                                        
                                                            <a href="excel.php?action=select&id=<?php echo $j_id;?>" class="btn btn-info mr-2" ><i class="far fa-sticky-note"></i> คนที่ถูกเลือก</a>
                                                            <a href="excel.php?action=all&id=<?php echo $j_id;?>" class="btn btn-info mr-2" ><i class="far fa-sticky-note"></i> ผู้สมัครทั้งหมด</a>
                                                            <button type="submit" class="btn btn-success" name="select">Submit</button>
                                                        
                                                    <?php  
                                                    }
                                                ?>
                                                </div>
                                            </form>
                                        </p>
                                    <?php
                                     }
                                     ?>
                                </div>
                                <div class="card-footer">
                                    <a href="index.php" class="btn btn-primary">ย้อนกลับ</a>
                                </div>
                            </div>
                            
                        </div>
                    
                    </div>
                </div>
                 <!-- edit -->
                 <div class="modal fade" id="modal-edit">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">แก้ไขข้อมูลงาน</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data" id="from-post">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="j_name">ชื่องาน :<b class="text-danger">*</b></label>
                                                <input type="text" class="form-control" id="j_name" placeholder="ชื่องาน" name="j_name" required value="<?php echo $data['j_name'];?>">
                                                <input type="hidden" class="form-control" id="j_id"  name="j_id" required value="<?php echo $data['j_id'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="summernote">รายละเอียดงาน :<b class="text-danger">*</b></label>
                                                <textarea class="summernote" name="j_detail" required>
                                                <?php echo $data['j_detail'];?>
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="datepicker">วันที่เริ่มงาน :<b class="text-danger">*</b></label>
                                                <input type="text" id="datepicker" class="form-control" name="j_s_date" required autocomplete="off" value="<?php echo $data['j_s_date'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="datepicker2">วันที่สิ้นสุด :<b class="text-danger">*</b></label>
                                                <input type="text" id="datepicker2" class="form-control" name="j_e_date" required autocomplete="off" value="<?php echo $data['j_e_date'];?>" min="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="time">ช่วงเวลา :<b class="text-danger">*</b></label>
                                                <input type="text" id="time" class="form-control" name="j_time_work" required  placeholder="12.00 - 16.00" value="<?php echo $data['j_time_work'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="position">สถานที่ทำงาน เช่น อาคาร ชั้น ห้อง :<b class="text-danger">*</b></label>
                                                <textarea class="form-control" rows="3" placeholder="Enter ..." id="position"  name="j_location" required><?php echo $data['j_location'];?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="datepicker3">วันที่เปิดรับสมัคร :<b class="text-danger">*</b></label>
                                                <input type="text" id="datepicker3" class="form-control" name="regis_s_date" required autocomplete="off" value="<?php echo $data['regis_s_date'];?>" min="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="datepicker4">วันที่ปิดรับสมัคร :<b class="text-danger">*</b></label>
                                                <input type="text" id="datepicker4" class="form-control" name="regis_e_date" required autocomplete="off" value="<?php echo $data['regis_e_date'];?>" min="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="datepicker5">วันที่สอบสัมภาษณ์(ใช้เวลา 1 วัน) :<b class="text-danger">*</b></label>
                                                <input type="text" id="datepicker5" class="form-control" name="interview_date" required autocomplete="off" value="<?php echo $data['interview_date'];?>" min="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="in_location">สถานที่สัมภาษณ์ :<b class="text-danger">*</b></label>
                                                <input type="text" id="in_location" class="form-control" name="in_location" required  value="<?php echo $data['in_location'];?>" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="in_time">เวลาสัมภาษณ์ :<b class="text-danger">*</b></label>
                                                <input type="text" id="in_time" class="form-control" name="in_time" required  value="<?php echo $data['in_time'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="datepicker6">วันที่ประกาศผล(หลังวันสัมภาษณ์ 2 วัน) :<b class="text-danger">*</b></label>
                                                <input type="text" id="datepicker6" class="form-control" name="announcement_date" required autocomplete="off" value="<?php echo $data['announcement_date'];?>" min="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="j_pay">รายละเอียดค่าตอบแทน :<b class="text-danger">*</b></label>
                                                <select class="form-control select2" style="width: 100%;" name="pay_id">
                                                    <?php 
                                                        $dataPay = $sqlObj->getPayAll();
                                                        foreach($dataPay as $p){
                                                            $select = ($data['pay_id']==$p['pay_id'] ? "selected" : ""); 
                                                            echo "
                                                                <option {$select} value='{$p['pay_id']}'>{$p['pay_name']}</option>
                                                            ";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="count_student">จำนวน นักศึกษาที่รับ :<b class="text-danger">*</b></label>
                                                <input type="number" class="form-control" id="count_student" placeholder="2" name="count_student" required value="<?php echo $data['count_student'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                        <hr>
                                        <b><p>รายละเอียดผู้รับผิดชอบ / ผู้ติดต่อ</p></b>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="st_name">ชื่อ - นามสกุล :<b class="text-danger">*</b></label>
                                                <input type="text" class="form-control" id="st_name" placeholder="ชื่อ - นามสกุล" name="st_name" required value="<?php echo $data['st_name'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="st_tel">เบอร์โทร :<b class="text-danger">*</b></label>
                                                <input type="text" class="form-control" id="st_tel" placeholder="เบอร์โทร" name="st_tel" required value="<?php echo $data['st_tel'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="st_email">email :<b class="text-danger">*</b></label>
                                                <input type="text" class="form-control" id="st_email" placeholder="email" name="st_email" required value="<?php echo $data['st_email'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="st_line">line ID :</label>
                                                <input type="text" class="form-control" id="st_line" placeholder="lind ID" name="st_line" value="<?php echo $data['st_line'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="st_location">สถานที่ติดต่อ :</label>
                                                <input type="text" class="form-control" id="st_location" placeholder="" name="st_location" value="<?php echo $data['st_location'];?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="edit">ยืนยันแก้ไข</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- modal add STUDENT-->
                <div class="modal fade" id="modal-add">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">กรอกข้อมูลการสมัคร</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data" id="from-post">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" style="width: 100%;" value="<?php echo $j_id;?>" name="j_id">
                                            <input type="hidden" style="width: 100%;" value="<?php echo $_SESSION['stu_email'];?>" name="stu_email">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="stu_email">ชื่อนักศึกษา :<b class="text-danger">*</b></label>
                                                <select class="form-control select2" style="width: 100%;" name="stu_email" id="stu_email">
                                                    <?php
                                                    $dataSt = $sqlObj->getSudentAll();
                                                    foreach ($dataSt as $St) {
                                                        $st_name = $St['stu_fullname'];
                                                        echo "
                                                                <option value='{$St['stu_email']}'>{$st_name}</option>
                                                            ";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="stu_class">ชั้นปีที่ :<b class="text-danger"></b></label>
                                                <input type="text" class="form-control" id="stu_class" placeholder="" name="stu_class" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="stu_sub_department">สาขาวิชา :<b class="text-danger"></b></label>
                                                <input type="text" class="form-control" id="stu_sub_department" placeholder=""  name="stu_sub_department" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="stu_department">ภาควิชา :<b class="text-danger">*</b></label>
                                                <select class="form-control select2" style="width: 100%;" name="stu_department" id="stu_department" required>
                                                    <option value='ภาควิชาสถิติ'>ภาควิชาสถิติ</option>
                                                    <option value='ภาควิชาวิทยาการคอมพิวเตอร์'>ภาควิชาวิทยาการคอมพิวเตอร์</option>
                                                    <option value='ภาควิชาคณิตศาสตร์'>ภาควิชาคณิตศาสตร์</option>
                                                    <option value='ภาควิชาฟิสิกส์'>ภาควิชาฟิสิกส์</option>
                                                    <option value='ภาควิชาชีววิทยา'>ภาควิชาชีววิทยา</option>
                                                    <option value='ภาควิชาเคมี'>ภาควิชาเคมี</option>
                                                    <option value='ศูนย์ K-DAI'>ศูนย์ K-DAI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="stu_tel">เบอร์โทร :<b class="text-danger"></b></label>
                                                <input type="text" class="form-control" id="stu_tel" placeholder="0123456789"  name="stu_tel" >
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="stu_email">Email :</label>
                                                <input type="text" class="form-control" id="stu_email" placeholder="" value="" name="stu_email">
                                            </div>
                                        </div> -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="stu_line">line :</label>
                                                <input type="text" class="form-control" id="stu_line" placeholder=""  name="stu_line">
                                            </div>
                                        </div>
                                        <!-- </div><div class="col-md-6">
                                            <div class="form-group">
                                                <label for="stu_sub_department">สาขาวิชา :<b class="text-danger">*</b></label>
                                                <input type="text" class="form-control" id="stu_sub_department" placeholder=""  name="stu_sub_department" required>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="add">ยืนยัน</button>
                                </div>
                            </form>
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
    <script>
        $('#modal-edit').on('shown.bs.modal', function () {
            $('#j_name').focus()
        })
    </script>
    <script type="text/javascript">
        
        $(function(){
            $("#datepicker").datepicker({
                language:'th-en',
                format: 'yyyy-mm-dd',
                minDate: 0,
                autoclose: true
                
            });
            $("#datepicker2").datepicker({
                language:'th-en',
                format:'yyyy-mm-dd',
                autoclose: true
            });
            $("#datepicker3").datepicker({
                language:'th-en',
                format:'yyyy-mm-dd',
                autoclose: true
            });
            $("#datepicker4").datepicker({
                language:'th-en',
                format:'yyyy-mm-dd',
                autoclose: true
            });
            $("#datepicker5").datepicker({
                language:'th-en',
                format:'yyyy-mm-dd',
                autoclose: true
            });
            $("#datepicker6").datepicker({
                language:'th-en',
                format:'yyyy-mm-dd',
                autoclose: true
            });
            
        });
       
    </script>
</body>

</html>