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
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/menu_left.php"; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/navbar.php"; ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">เส้นทางการพิจารณา</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">เส้นทางการพิจารณา</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <?php
                    if(isset($_POST['add'])){
                        // echo "<pre>"; 
                        // print_r($_POST);
                        // echo "</pre>";
                        $dataMember = $sqlObj->getMemberByWu($_POST['wu_id']);
                        if(count($dataMember) > 0 ){
                            if(count($dataMember) < 2){
                                $data['m_email']=$dataMember[0]['m_email'];
                                $data['wu_id']=$_POST['wu_id'];
                                $ck = $sqlObj->delRouteByEmail($data['m_email']);
                                $ro_num =0;
                                foreach($_POST['h_email'] as $h_email){
                                    $ro_num++;
                                    if($h_email != ""){
                                        $data['h_email'] = $h_email;
                                        $data['ro_num'] = $ro_num;
                                        // echo $h_email."<br>";
                                        $ck = $sqlObj->addRoute($data);
                                    }
                                    if($ck){
                                        $msg = "บันทึกข้อมูลเรียบร้อย";
                                        echo "<script>";
                                        echo "alertSuccess('{$msg}','route.php')";
                                        echo "</script>";
                                    } else {
                                        $msg = "บันทึกข้อมูลไม่สำเร็จ !";
                                        echo "<script>";
                                        echo "alertError('{$msg}','route.php')";
                                        echo "</script>";
                                    }
                                }
                            }else{
                                foreach($dataMember as $member){
                                    $data['m_email']=$member['m_email'];
                                    $data['wu_id']=$_POST['wu_id'];
                                    $ck = $sqlObj->delRouteByEmail($data['m_email']);
                                    $ro_num =0;
                                    foreach($_POST['h_email'] as $h_email){
                                        $ro_num++;
                                        if($h_email != ""){
                                            $data['h_email'] = $h_email;
                                            $data['ro_num'] = $ro_num;
                                            // echo $h_email."<br>";
                                            $ck = $sqlObj->addRoute($data);
                                        }
                                        if($ck){
                                            $msg = "บันทึกข้อมูลเรียบร้อย";
                                            echo "<script>";
                                            echo "alertSuccess('{$msg}','route.php')";
                                            echo "</script>";
                                        } else {
                                            $msg = "บันทึกข้อมูลไม่สำเร็จ !";
                                            echo "<script>";
                                            echo "alertError('{$msg}','route.php')";
                                            echo "</script>";
                                        }
                                    }
                                }
                                
                            }
                        }
                        
                    }
                    ?>
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6 d-flex flex-row-reverse bd-highlight">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
                                <i class="fas fa-plus"></i> Add เส้นทาง
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
                                                <th class='text-center'>หน่วยงาน</th>
                                                <th class='text-center'>เจ้าหน้าที่</th>
                                                <th class='text-center'>ลำดับที่</th>
                                                <th class='text-center'>เส้นทางการพิจารณา</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?PHP
                                            $dataRoute = $sqlObj->getRoute();
                                            // $dataJob = $sqlObj->getJobByEmail('akarit.ta@kmitl.ac.th');
                                            $i = 0;
                                            foreach ($dataRoute as $r) {
                                                $i++;
                                                $dero_id = sent($r['dero_id']);
                                                echo "
                                                    <tr class='fs-14'>
                                                        <td>{$i}</td>
                                                        <td>{$r['wu_name']}</td>
                                                        <td >{$r['m_email']}</td>
                                                        <td class='text-center'>{$r['ro_num']}</td>
                                                        <td >{$r['name_EN']}</td>
                                                        <td class='text-center'>
                                                            <a href='action.php?action=del&m={$dero_id}&page=route'><i class='fas fa-trash-alt text-danger'></i></a>
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

               
                <div class="modal fade" id="modal-add">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">ข้อมูล</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data" id="from-post">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="wu_id">หน่วยงาน :<b class="text-danger">*</b></label>
                                                <select class="form-control select2" style="width: 100%;" name="wu_id" id="wu_id">
                                                    <?php
                                                    $dataWU = $sqlObj->getWorkUnit();
                                                    foreach ($dataWU as $wu) {
                                                        echo "
                                                                <option value='{$wu['wu_id']}'>{$wu['wu_name']}</option>
                                                            ";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="m_email">เจ้าหน้าที่รับผิดชอบ :<b class="text-danger">*</b></label>
                                                <select class="form-control select2" style="width: 100%;" name="m_email" id="m_email">
                                                    <?php
                                                    // $dataSt = $sqlObj->getStaffAll();
                                                    // foreach ($dataSt as $St) {
                                                    //     $st_name = $St['title'] . $St['name'] . " " . $St['surname'];
                                                    //     echo "
                                                    //             <option value='{$St['email']}'>{$st_name}</option>
                                                    //         ";
                                                    // }
                                                    ?>
                                                </select>
                                            </div>
                                        </div> -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="h_email">ลำดับเส้นทางพิจารณา :<b class="text-danger">*</b></label>
                                                <ol>
                                                    
                                                    <?php
                                                        $hname[1] = "prapaichit.yu@kmitl.ac.th";
                                                        $hname[2] = "";
                                                        $hname[3] = "apiluck.ei@kmitl.ac.th";
                                                        $hname[4] = "sutee.ch@kmitl.ac.th";
                                                        for($k=1;$k<=4;$k++){
                                                            echo "
                                                                <li>
                                                                    <select class='form-control select2' style='width: 100%;' name='h_email[{$k}]'>
                                                            ";
                                                                    $dataSt = $sqlObj->getStaffAll();
                                                                    $kk = 0;
                                                                    echo "
                                                                            <option value=''>ไม่มี</option>
                                                                        ";
                                                                    foreach ($dataSt as $St) {
                                                                        
                                                                        $kk++;
                                                                        $st_name = $St['title'] . $St['name'] . " " . $St['surname'];
                                                                        $select = ($St['email'] == $hname[$k] ? "selected":"");
                                                                        echo "
                                                                            <option value='{$St['email']}' {$select}>{$st_name}</option>
                                                                        ";
                                                                        
                                                                    }
                                                                    echo "
                                                                    </select>
                                                                </li>
                                                            ";
                                                        }
                                                    ?>
                                                </ol>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="add">เพิ่ม</button>
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
       
    </script>
</body>

</html>