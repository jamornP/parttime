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
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>ข้อมูล JobJobSci@KMITL</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">ข้อมูล JobJobSci@KMITL</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <?php
            if(isset($_POST['add'])){
                unset($_POST['add']);
                $_POST['m_email'] = $_SESSION['m_email'];
                $_POST['js_id'] = 1;
                $_POST['status'] = "ส่งเรื่อง";
                $_POST['date_add']=date("Y-m-d H:i:s");
                if($_POST['interview_date']==""){
                    $_POST['interview_date']="0000-00-00";
                }
                // echo "<pre>";
                // print_r($_POST); 
                // echo"</pre>";
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
                    $msgParttime = $dataHemail['title'].$dataHemail['name']." ".$dataHemail['surname']."\nเรื่อง{$_POST['j_name']}\n " ;
                    $ckLine = SentLineBasic("TguOefB2TCfmfcvmBjySvAQHoQw4FHCzgb1NbuSUvpp",$msgParttime);
                    // $ckLine = SentLineBasic("NEBJNOEsOZKaHi0CtH5DxutkPV9HNGinPgxZTEsrY1W",$msgParttime); // test
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
                echo $job_id;
            }
            ?>
            <section class="content">
                <!-- <div class="container-fluid"> -->
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6 d-flex flex-row-reverse bd-highlight">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
                            <i class="fas fa-plus"></i> Add งาน
                        </button>
                    </div>
                    
                </div>
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
                                            $dataJob = $sqlObj->getJobByEmail($_SESSION['m_email']);
                                            // echo "<pre>";
                                            // print_r($dataJob);
                                            // echo "</pre>";
                                            // $dataJob = $sqlObj->getJobByEmail('akarit.ta@kmitl.ac.th');
                                            $i = 0;
                                            foreach($dataJob as $j){
                                                $stu = $sqlObj->countStuRegisByJId($j['j_id']);
                                                $i++;
                                                $dateWork = datethai($j['j_s_date'])." - ".datethai($j['j_e_date']); 
                                                if($j['js_id']== 99 OR $j['status']== "ส่งเรื่อง" OR $j['status']== "ตีกลับ"){
                                                    $edit = "
                                                        <i class='fas fa-trash-alt text-danger'></i>
                                                    ";
                                                }else{
                                                    $edit = "";
                                                }
                                                echo "
                                                    <tr class='fs-14'>
                                                        <td>{$i}</td>
                                                        <td><a href='view.php?id={$j['j_id']}'>{$j['j_name']}</a></td>
                                                        <td class='text-center'>{$dateWork}</td>
                                                        <td>{$j['pay']}</td>
                                                        <td class='text-center'>{$j['count_student']}/{$stu}</td>
                                                        <td class='text-center'>{$j['st_name']}</td>
                                                        <td class='text-center'>{$j['st_tel']}</td>
                                                        <td class='text-center'>{$j['status']}</td>
                                                        <td class=''>
                                                            <a href='view.php?id={$j['j_id']}'><i class='fas fa-eye text-primary mr-2'></i> </a> 
                                                            {$edit}
                                                            
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
                
                <!-- add -->
                <div class="modal fade" id="modal-add">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">ข้อมูลงาน</h4>
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
                                                <input type="text" class="form-control" id="j_name" placeholder="ชื่องาน" name="j_name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="summernote">รายละเอียดงาน :<b class="text-danger">*</b></label>
                                                <textarea id="summernote" class="summernote" name="j_detail" required>
                                                <p>
                                                    <h5 class=""><b><font color="#0000ff">รายละเอียดงาน&nbsp;</font></b></h5>
                                                    <span style="font-size: 18px;">1.ช่วยงานลงทะเบียน พัสดุไปรษณีย์</span>
                                                    <br style="font-size: 18px;">
                                                    <span style="font-size: 18px;">2.สนับสนุนตอบคำถาม เกี่ยวกับหอพักนักศึกษา</span>
                                                    <br style="font-size: 18px;">
                                                    <span style="font-size: 18px;">3.สนับสนุนการพิมพ์เอกสาร</span>
                                                </p>
                                                <p>
                                                    <h5 class=""><b><font color="#0000ff">คุณสมบัติของผู้สมัคร&nbsp;</font></b></h5>
                                                    <span style="font-size: 18px;">- รับนักศึกษา ทุกคณะ/ทุกชั้นปี</span>
                                                </p>
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
                                                <label for="datepicker5">วันที่สอบสัมภาษณ์(ใช้เวลา 1 วัน) :<b class="text-danger"></b></label>
                                                <input type="text" id="datepicker5" class="form-control" name="interview_date"  autocomplete="off" value="" min="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="in_location">สถานที่สัมภาษณ์ :<b class="text-danger"></b></label>
                                                <input type="text" id="in_location" class="form-control" name="in_location"  >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="in_time">เวลาสัมภาษณ์ :<b class="text-danger"></b></label>
                                                <input type="text" id="in_time" class="form-control" name="in_time"  >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="datepicker6">วันที่ประกาศผล(หลังวันสัมภาษณ์ 1 วัน) :<b class="text-danger">*</b></label>
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
                                                <input type="number" class="form-control" id="count_student" placeholder="0" name="count_student" required>
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="st_location">สถานที่ :</label>
                                                <input type="text" class="form-control" id="st_location" placeholder="สถานที่" name="st_location">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="add">บันทึก</button>
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
        $('#modal-add').on('shown.bs.modal', function () {
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