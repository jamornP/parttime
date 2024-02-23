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
                            $_POST['re_date'] = date("Y-m-d H:i:s");
                            $_POST['re_status'] = "register";
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
                                    echo "alertSuccess('{$msg}','index.php')";
                                    echo "</script>";
                                } else {
                                    $msg = "บันทึกข้อมูลไม่สำเร็จ !";
                                    echo "<script>";
                                    echo "alertError('{$msg}','index.php')";
                                    echo "</script>";
                                }
                            }
                            
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
                                        <h5 class="text-danger"><b><font>วันที่สอบสัมภาษณ์&nbsp;</font><font color="#ED2939">*</font></b></h5>
                                        <span style="font-size: 18px;"><b>
                                        <?php 
                                            if($data['interview_date']!='0000-00-00'){
                                                echo 'วันที่ '.datethai($data['interview_date']);
                                            }else{
                                                echo "-";
                                            }
                                        ?>        
                                        </b></span>
                                    </p>
                                    <p>
                                        <h5 class="text-danger"><b><font>สถานที่สอบสัมภาษณ์&nbsp;</font><font color="#ED2939"></font></b></h5>
                                        <span style="font-size: 18px;"><b><?php echo $data['in_location'];?></b></span>
                                    </p>
                                    <p>
                                        <h5 class="text-danger"><b><font>เวลาสอบสัมภาษณ์&nbsp;</font><font color="#ED2939"></font></b></h5>
                                        <span style="font-size: 18px;"><b><?php echo $data['in_time'];?></b></span>
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
                                        <span style="font-size: 18px;">สถานที่ติดต่อ : <?php echo $data['st_location'];?></span>
                                        <br style="font-size: 18px;">
                                    </p>
                                    
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="index.php" class="btn btn-primary "> <i class = "fas fa-reply"></i> ย้อนกลับ</a>
                                        </div>
                                        <?php
                                            $dateN = date("Y-m-d");
                                            if($dateN <= $data['regis_e_date'] AND $dateN >= $data['regis_s_date'] ){
                                                ?>
                                                    <div class="col-sm-6 d-flex flex-row-reverse bd-highlight">
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add">
                                                            <i class="far fa-id-badge"></i> ลงทะเบียนสมัครงานนี้
                                                        </button>
                                                    </div>
                                                <?php
                                            }
                                        ?>
                                        
                                    </div> 
                                </div>
                            </div>
                            
                        </div>
                    
                    </div>
                </div>
                <!-- modal -->
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
                                                <label for="stu_name">ชื่อ นามสกุล :<b class="text-danger">*</b></label>
                                                <input type="text" class="form-control" id="stu_name" placeholder=""  value="<?php echo $_SESSION['fullname'];?>" name="stu_name" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="stu_id">รหัสนักศึกษา :<b class="text-danger">*</b></label>
                                                <input type="text" class="form-control" id="stu_id" placeholder="66050501" value="<?php echo $_SESSION['stu_id'];?>" name="stu_id" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="stu_class">ชั้นปีที่ :<b class="text-danger">*</b></label>
                                                <input type="text" class="form-control" id="stu_class" placeholder="" name="stu_class" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="stu_sub_department">สาขาวิชา :<b class="text-danger">*</b></label>
                                                <input type="text" class="form-control" id="stu_sub_department" placeholder=""  name="stu_sub_department" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="stu_department">ภาควิชา :<b class="text-danger">*</b></label>
                                                <select class="form-control select2" style="width: 100%;" name="stu_department" id="stu_department">
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
                                                <label for="stu_tel">เบอร์โทร :<b class="text-danger">*</b></label>
                                                <input type="text" class="form-control" id="stu_tel" placeholder="0123456789"  name="stu_tel" required>
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
                                    <button type="submit" class="btn btn-primary" name="add">ยืนยันสมัครงานนี้</button>
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
</body>

</html>