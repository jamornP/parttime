<?php 
    session_start();
    date_default_timezone_set('Asia/Bangkok');
?>
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
        
        <!-- ----- -->
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/load.php"; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/menu_left.php"; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/navbar.php"; ?>
       
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">เอกสาร Parttime Job</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">เอกสาร Parttime Job</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <?php
                        $j_id = $_GET['id'];
                        $ckUstatus = $sqlObj->updateStatus($j_id,"กำลังพิจารณา");
                        $data = $sqlObj->getJobById($j_id);
                        $ro_num=$sqlObj->getRoNumByMHemail($data['m_email'],$_SESSION['m_email']);
                        // $ro_num=$sqlObj->getRoNumByMHemail($data['m_email'],"prapaichit.yu@kmitl.ac.th");
                        // $ro_num=$sqlObj->getRoNumByMHemail($data['m_email'],"jatuporn.me@kmitl.ac.th");
                        // $ro_num=$sqlObj->getRoNumByMHemail($data['m_email'],"apiluck.ei@kmitl.ac.th");
                        // $ro_num=$sqlObj->getRoNumByMHemail($data['m_email'],"sutee.ch@kmitl.ac.th");
                        // print_r($ro_num);
                        $num = $data['js_id']+1;
                        if(isset($_POST['accept'])){
                            
                            $dataA['num']=$_POST['num'];
                            $dataA['m_email']=$_POST['h_email'];
                            $dataA['sta_name']=$_POST['sta_name'];
                            $dataA['j_sta_date']=date("Y-m-d H:i:s");
                            $dataA['remark']=$_POST['sta_name'];
                            $dataA['j_id']=$_POST['j_id'];
                            // print_r($dataA);
                            $ckA = $sqlObj->addDataJobSta($dataA);
                            if($ckA){
                                $dataU['j_id'] = $dataA['j_id'];
                                $dataU['js_id'] = $dataA['num'];
                                // print_r($dataU);
                                $ckU = $sqlObj->updateJobStatus($dataU);
                                if($ckU){
                                    if($_POST['sta_name']=="อนุมัติ"){
                                        $msgParttime = "คุณ".$data['name']." ".$data['surname']."\nอนุมัติแล้ว \nและระบบดำเนินการ เปิดรับสมัครให้แล้ว";
                                        $ckLine = SentLineBasic("3BeWp4Y3w1xVjRVuQFu3pJAVrws6nBcxSgMgjfq8E3R",$msgParttime);
                                    }else{
                                        $dataName = $sqlObj->getEmailByMEmailRo($data['m_email'],$dataU['js_id']);
                                        $msgParttime = "คุณ".$dataName['name']." ".$dataName['surname']."\nhttp://app.science.kmitl.ac.th/parttime";
                                        $ckLine = SentLineBasic("TguOefB2TCfmfcvmBjySvAQHoQw4FHCzgb1NbuSUvpp",$msgParttime);
                                    }
                                    $msg = "บันทึกข้อมูลเรียบร้อย";
                                    echo "<script>";
                                    echo "alertSuccess('{$msg}','index.php')";
                                    echo "</script>";
                                }else{
                                    $msg = "บันทึกข้อมูลไม่สำเร็จ !";
                                    echo "<script>";
                                    echo "alertError('{$msg}','index.php')";
                                    echo "</script>";
                                }
                            } else {
                                $msg = "บันทึกข้อมูลไม่สำเร็จ !";
                                echo "<script>";
                                echo "alertError('{$msg}','index.php')";
                                echo "</script>";
                            }
                        }
                        if(isset($_POST['reject'])){
                            print_r($_POST);
                            $j_idD = $_POST['j_id'];
                            $ckD = $sqlObj->delDJSById($j_idD);
                            $dataA['j_id'] = $_POST['j_id'];
                            $dataA['remark'] = $_POST['remark'];
                            $dataA['num'] = 99;
                            $dataA['sta_name'] = "ตีกลับ";
                            $dataA['j_sta_date'] = date("Y-m-d H:i:s");
                            $dataA['m_email'] = $_POST['h_email'];
                            $ckA = $sqlObj->addDataJobSta($dataA);
                            if($ckA){
                                $dataU['j_id'] = $dataA['j_id'];
                                $dataU['js_id'] = 99;
                                // print_r($dataU);
                                $ckU = $sqlObj->updateJobStatus($dataU);
                                if($ckU){
                                    $ckUstatus = $sqlObj->updateStatus($j_idD,"ตีกลับ");
                                    $msgParttime = "คุณ".$data['name']." ".$data['surname']."\nถูกตีกลับ \nเนื่องจาก :".$dataA['remark'];
                                    $ckLine = SentLineBasic("3BeWp4Y3w1xVjRVuQFu3pJAVrws6nBcxSgMgjfq8E3R",$msgParttime);
                                    
                                    $msg = "บันทึกข้อมูลเรียบร้อย";
                                    echo "<script>";
                                    echo "alertSuccess('{$msg}','index.php')";
                                    echo "</script>";
                                }else{
                                    $msg = "บันทึกข้อมูลไม่สำเร็จ !";
                                    echo "<script>";
                                    echo "alertError('{$msg}','index.php')";
                                    echo "</script>";
                                }
                            } else {
                                $msg = "บันทึกข้อมูลไม่สำเร็จ !";
                                echo "<script>";
                                echo "alertError('{$msg}','index.php')";
                                echo "</script>";
                            }
                        }
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
                                                $name = $h['title'].$h['name']." ".$h['surname']." &nbsp;&nbsp;&nbsp;<b><font color='#0000ff'>".$h['remark']."</font></b>";
                                                echo "
                                                    <span style='font-size: 18px;'>{$name}</span>
                                                    <br style='font-size: 18px;'>
                                                ";
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <?php
                                    if($data['js_id'] == $ro_num){
                                        ?>
                                            <form action="" method="post">
                                                <p><input type="text" class="form-control" id="remark" placeholder="พิจารณาให้ความเห็น" name="remark" autofocus></p>
                                                <input type="hidden" name="h_email" id="" value="<?php echo $_SESSION['m_email'];?>">
                                                <input type="hidden" name="j_id" id="" value="<?php echo $_GET['id'];?>">
                                                <input type="hidden" name="num" id="" value="<?php echo $num;?>">
                                                <?php 
                                                    if($_SESSION['m_email']=="sutee.ch@kmitl.ac.th"){
                                                        echo "
                                                            <input type='hidden' name='sta_name' id='' value='อนุมัติ'>
                                                            <button type='submit' class='btn btn-primary' name='accept'>อนุมัติ</button>
                                                        ";
                                                    }else{
                                                        echo "
                                                            <input type='hidden' name='sta_name' id='' value='เห็นชอบ'>
                                                            <button type='submit' class='btn btn-primary' name='accept'>เห็นชอบ</button>
                                                        ";
                                                    }
                                                ?>
                                                <button type="submit" class="btn btn-danger" name="reject">ตีกลับ</button>
                                            </form>
                                        <?php
                                    }
                                ?>
                                
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