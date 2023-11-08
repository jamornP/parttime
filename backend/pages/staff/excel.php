<?php
$name = "รายชื่อ.xls";
header("Content-Type: application/xls;  charset=utf-8");
header("Content-Disposition: attachment; filename=".$name."; worksheet1=".$_GET['name']);
header("Pragma: no-cache");
header("Expires: 0");
?>
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobJobSciSci@KMITL</title>

</head>

<body class="font-kanit">
    
    <?php 
    if($_GET['action']=='select'){
        $data = $sqlObj->getRegisByJidStExcel($_GET['id']);
        // print_r($data);
        ?>
            <table class="table table-hover text-nowrap fs-14">
                <thead>
                    <tr>
                        <th>ที่</th>
                        <th>รหัสนักศึกษา</th>
                        <th>ชื่อ นามสกุล</th>
                        <th>ปี</th>
                        <th>สาขา</th>
                        <th>ภาควิชา</th>
                        <th>เบอร์โทร</th>
                        <th>Email</th>
                        <th>Line</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                   foreach($data as $re){
                    $i++;
                    echo "
                        <tr>
                            <td>{$i}</td>
                            <td>{$re['stu_id']}</td>
                            <td>{$re['stu_fullname']}</td>
                            <td>{$re['stu_class']}</td>
                            <td>{$re['stu_sub_department']}</td>
                            <td>{$re['stu_department']}</td>
                            <td>{$re['stu_tel']}</td>
                            <td>{$re['stu_email']}</td>
                            <td>{$re['stu_line']}</td>
                        </tr>
                    ";
                   }
                    ?>
                </tbody>
            </table>
        <?php
    }
    if($_GET['action']=='all'){
        $data = $sqlObj->getRegisByJidAllExcel($_GET['id']);
        // print_r($data);
        ?>
            <table class="table table-hover text-nowrap fs-14">
                <thead>
                    <tr>
                        <th>ที่</th>
                        <th>รหัสนักศึกษา</th>
                        <th>ชื่อ นามสกุล</th>
                        <th>ปี</th>
                        <th>สาขา</th>
                        <th>ภาควิชา</th>
                        <th>เบอร์โทร</th>
                        <th>Email</th>
                        <th>Line</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                   foreach($data as $re){
                    $i++;
                    echo "
                        <tr>
                            <td>{$i}</td>
                            <td>{$re['stu_id']}</td>
                            <td>{$re['stu_fullname']}</td>
                            <td>{$re['stu_class']}</td>
                            <td>{$re['stu_sub_department']}</td>
                            <td>{$re['stu_department']}</td>
                            <td>{$re['stu_tel']}</td>
                            <td>{$re['stu_email']}</td>
                            <td>{$re['stu_line']}</td>
                        </tr>
                    ";
                   }
                    ?>
                </tbody>
            </table>
        <?php
    }
    ?>
   
</body>

</html>