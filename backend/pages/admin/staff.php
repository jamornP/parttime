<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
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
                        $data['m_email']=$_POST['m_email'];
                        $data['wu_id']=$_POST['wu_id'];
                        $data['d_id']=$_POST['d_id'];
                        $data['role']="staff";
                        $ck = $sqlObj->addMember($data);
                        if($ck){
                            $msg = "บันทึกข้อมูลเรียบร้อย";
                            echo "<script>";
                            echo "alertSuccess('{$msg}','staff.php')";
                            echo "</script>";
                        } else {
                            $msg = "บันทึกข้อมูลไม่สำเร็จ !";
                            echo "<script>";
                            echo "alertError('{$msg}','staff.php')";
                            echo "</script>";
                        }
                        
                    }
                    ?>
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6 d-flex flex-row-reverse bd-highlight">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
                                <i class="fas fa-plus"></i> Add เจ้าหน้าที่
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
                                                <th class='text-center'>email</th>
                                                <th class='text-center'>สังกัด</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?PHP
                                            $dataM = $sqlObj->getMemberByRole("staff");
                                            $i = 0;
                                            foreach ($dataM as $m) {
                                                $staff = $m['title'].$m['name']." ".$m['surname'];
                                                $i++;
                                                $m_id = sent($m['id']);
                                                echo "
                                                    <tr class='fs-16'>
                                                        <td>{$i}</td>
                                                        <td>{$m['wu_name']}</td>
                                                        <td>{$staff}</td>
                                                        <td >{$m['m_email']}</td>
                                                        <td class='text-center'>{$m['d_name']}</td>
                                                        <td class='text-center'>
                                                            <a href='action.php?action=del&m={$m_id}&page=staff'><i class='fas fa-trash-alt text-danger'></i></a>
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
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="m_email">เจ้าหน้าที่รับผิดชอบ :<b class="text-danger">*</b></label>
                                                <select class="form-control select2" style="width: 100%;" name="m_email" id="m_email">
                                                    <?php
                                                    $dataSt = $sqlObj->getStaffAll();
                                                    foreach ($dataSt as $St) {
                                                        $st_name = $St['title'] . $St['name'] . " " . $St['surname'];
                                                        echo "
                                                                <option value='{$St['email']}'>{$st_name}</option>
                                                            ";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="d_id">สังกัด :<b class="text-danger">*</b></label>
                                                <select class="form-control select2" style="width: 100%;" name="d_id" id="d_id">
                                                    <?php
                                                    $dataDe = $sqlObj->getDepartmentAll();
                                                    foreach ($dataDe as $de) {
                                                        echo "
                                                                <option value='{$de['d_id']}'>{$de['d_name']}</option>
                                                            ";
                                                    }
                                                    ?>
                                                </select>
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