<?php 
    session_start();
    date_default_timezone_set('Asia/Bangkok');
?>
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
                            <h1 class="m-0">เพิ่มข้อมูล JobJobSci@KMITL</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Register</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if(isset($_POST['add'])){
                unset($_POST['add']);
                $_POST['m_email'] = $_SESSION['m_email'];
                $_POST['js_id'] = 1;
                $_POST['status'] = "ส่งเรื่อง";
                $_POST['date_add']=date("Y-m-d H:i:s");
                echo "<pre>";
                print_r($_POST); 
                echo"</pre>";
                $job_id = $sqlObj->addJob($_POST);
                if ($job_id) {
                    $dataJ['num']=1;
                    $dataJ['j_id']=$job_id;
                    $dataJ['sta_name']="ส่งเรื่อง";
                    $dataJ['j_sta_date']=$_POST['date_add'];
                    $dataJ['m_email']=$_POST['m_email'];
                    $dataJ['remark']="";
                    $ckS = $sqlObj->addDataJobSta($dataJ);
                    $dataHemail = $sqlObj->getEmailByMEmailRo($dataJ['m_email'],$dataJ['num']);
                    $msgParttime = $dataHemail['name']." ".$dataHemail['surname']."\nเรื่อง{$_POST['j_name']}\n http://app.science.kmitl.ac.th/parttime" ;
                    $ckLine = SentLineBasic("TguOefB2TCfmfcvmBjySvAQHoQw4FHCzgb1NbuSUvpp",$msgParttime);
                    $msg = "บันทึกข้อมูลเรียบร้อย";
                    echo "<script>";
                    echo "alertSuccess('{$msg}','index.php')";
                    echo "</script>";
                  } else {
                    $msg = "บันทึกข้อมูลไม่สำเร็จ !";
                    echo "<script>";
                    echo "alertError('{$msg}','index.php')";
                    echo "</script>";
                  }
                // echo $job_id;
            }
            ?>
            <section class="content">
                <div class="container-fluid">
                <form action="" method="post" enctype="multipart/form-data" id="from-post">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="j_name">ชื่องาน :<b class="text-danger">*</b></label>
                                                <input type="text" class="form-control" id="j_name" placeholder="ชื่องาน" name="j_name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="summernote">รายละเอียดงาน :<b class="text-danger">*</b></label>
                                                <textarea class="summernote" name="j_detail" required>
                                               
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="summernote">คุณสมบัติของผู้สมัคร :<b class="text-danger">*</b></label>
                                                <textarea class="summernote" name="j_detail" required>
                                                
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="datepicker">วันที่เริ่มงาน :<b class="text-danger">*</b></label>
                                                <input type="text" id="datepicker" class="form-control" name="j_s_date" required autocomplete="off" value="<?php echo date("Y-m-d");?>" min="<?php echo date("Y-m-d");?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="datepicker2">วันที่สิ้นสุด :<b class="text-danger">*</b></label>
                                                <input type="text" id="datepicker2" class="form-control" name="j_e_date" required autocomplete="off" value="" min="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="time">ช่วงเวลา :<b class="text-danger">*</b></label>
                                                <input type="text" id="time" class="form-control" name="j_time_work" required  placeholder="12:00 - 16:00" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="position">สถานที่ทำงาน เช่น อาคาร ชั้น ห้อง :<b class="text-danger">*</b></label>
                                                <textarea class="form-control" rows="3" placeholder="Enter ..." id="position"  name="j_location" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="datepicker3">วันที่เปิดรับสมัคร :<b class="text-danger">*</b></label>
                                                <input type="text" id="datepicker3" class="form-control" name="regis_s_date" required autocomplete="off" value="" min="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="datepicker4">วันที่ปิดรับสมัคร :<b class="text-danger">*</b></label>
                                                <input type="text" id="datepicker4" class="form-control" name="regis_e_date" required autocomplete="off" value="" min="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="datepicker5">วันที่สอบสัมภาษณ์(ใช้เวลา 1 วัน) :<b class="text-danger">*</b></label>
                                                <input type="text" id="datepicker5" class="form-control" name="interview_date" required autocomplete="off" value="" min="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="datepicker6">วันที่ประกาศผล(หลังวันสัมภาษณ์ 2 วัน) :<b class="text-danger">*</b></label>
                                                <input type="text" id="datepicker6" class="form-control" name="announcement_date" required autocomplete="off" value="" min="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="j_pay">รายละเอียดค่าตอบแทน :<b class="text-danger">*</b></label>
                                                <select class="form-control select2" style="width: 100%;" name="pay_id">
                                                    <?php 
                                                        $dataPay = $sqlObj->getPayAll();
                                                        foreach($dataPay as $p){
                                                            echo "
                                                                <option value='{$p['pay_id']}'>{$p['pay_name']}</option>
                                                            ";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="count_student">จำนวน นักศึกษาที่รับ :<b class="text-danger">*</b></label>
                                                <input type="number" class="form-control" id="count_student" placeholder="2" name="count_student" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                        <hr>
                                        <b><p>รายละเอียดผู้รับผิดชอบ / ผู้ติดต่อ</p></b>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="st_name">ชื่อ - นามสกุล :<b class="text-danger">*</b></label>
                                                <input type="text" class="form-control" id="st_name" placeholder="ชื่อ - นามสกุล" name="st_name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="st_tel">เบอร์โทร :<b class="text-danger">*</b></label>
                                                <input type="text" class="form-control" id="st_tel" placeholder="เบอร์โทร" name="st_tel" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="st_email">email :<b class="text-danger">*</b></label>
                                                <input type="text" class="form-control" id="st_email" placeholder="email" name="st_email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="st_line">line ID :</label>
                                                <input type="text" class="form-control" id="st_line" placeholder="lind ID" name="st_line">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                    <button type="submit" class="btn btn-primary" name="add">บันทึก</button>
                                </div>
                            </form>
                </div>
            </section>
           
        </div>
        <aside class="control-sidebar control-sidebar-dark">
           
        </aside>
       
    </div>
    <!-- ---------  -->
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/footer.php"; ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/script.php"; ?>
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