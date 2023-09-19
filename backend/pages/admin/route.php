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

        .sbtn-remove,
        .sbtn-remove2,
        .tbtn-remove {
            display: none;
        }

        .dropzone .dz-preview .dz-remove {
            position: absolute;
            top: -10px;
            right: -10px;
            z-index: 999;
            color: rgba(200, 200, 200, 0.8);
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
                        $ro_num =0;
                        foreach($_POST['h_email'] as $h_email){
                            $ro_num++;
                            if($h_email != ""){
                                $data['h_email'] = $h_email;
                                $data['ro_num'] = $ro_num;
                                echo $h_email."<br>";
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
                                                <th class='text-center'>ผู้บริหาร</th>
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
                                                echo "
                                                        <tr class='fs-14'>
                                                            <td>{$i}</td>
                                                            <td>{$r['wu_name']}</td>
                                                            <td >{$r['m_email']}</td>
                                                            <td class='text-center'>{$r['ro_num']}</td>
                                                            <td >{$r['name_EN']}</td>
                                                            <td class='text-center'>
                                                                <i class='fas fa-eye text-primary'></i> 
                                                                <i class='fas fa-edit text-warning'></i> 
                                                                <i class='fas fa-trash-alt text-danger'></i>
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
                                        <div class="col-md-6">
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="h_email">ลำดับเส้นทางพิจารณา :<b class="text-danger">*</b></label>
                                                <ol>
                                                    
                                                    <?php
                                                        for($k=1;$k<=5;$k++){
                                                            echo "
                                                                <li>
                                                                    <select class='form-control select2' style='width: 100%;' name='h_email[{$k}]'>
                                                            ";
                                                                        $dataSt = $sqlObj->getStaffAll();
                                                                        $kk = 0;
                                                                        foreach ($dataSt as $St) {
                                                                            $kk++;
                                                                            $st_name = $St['title'] . $St['name'] . " " . $St['surname'];
                                                                            
                                                                            echo "
                                                                                <option value='{$St['email']}'>{$st_name}</option>
                                                                            ";
                                                                            if($kk==5){
                                                                                echo "
                                                                                    <option value=''>ไม่มี</option>
                                                                                ";
                                                                            }
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
        $(function() {
            let i = 1;

            $("body").on("click", ".sbtn-add", function(e) {

                if (i < 5) {
                    i++;
                    e.preventDefault();
                    let ol = $(this).closest("ol")
                    let li = $(this).closest("li").clone()
                    li.appendTo(ol)
                    li.find("input").val("")
                    li.find(".sbtn-remove").show()
                    li.find("[name='h_email[]']").focus()
                } else {

                }
                console.log(i);
            })

            $("body").on("click", ".sbtn-remove", function(e) {
                i = i - 1;
                e.preventDefault();
                $(this).closest("li").remove()
                console.log(i);
            })

            
        })
    </script>
</body>

</html>