<?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/vendor/autoload.php"; ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/function/function.php"; ?>
<?php

use App\Model\Parttime\Auth;
$authObj = new Auth;
use App\Model\Parttime\FunctionSql;
$sqlObj = new FunctionSql;

date_default_timezone_set('Asia/Bangkok');
?>
<?php
if(isset($_GET['action'])=="del"){
    echo "
        <script type='text/javascript'>
            let isExecuted = confirm('คุณแน่ใจว่าต้องการลบข้อมูลรายการนี้ ?');
            if (isExecuted == true) {
                location.href='action.php?ck_del=ok&m_id={$_GET['m']}&p={$_GET['page']}';
            } else {
                location.href='staff.php';
            }
            console.log(isExecuted);
        </script>
    ";
}
if(isset($_GET['ck_del'])=="ok"){
    if($_GET['p']=="route"){
        $id = resive($_GET['m_id']);
        $page = $_GET['p'];
        $ck = $sqlObj->delDeRouteById($id);
        if($ck){
            echo "
                <script type='text/javascript'>
                    location.href='{$page}.php';
                </script>
            ";
        }else{
            echo "
                <script type='text/javascript'>
                    location.href='{$page}.php';
                </script>
            ";
        }
    }else{
        $id = resive($_GET['m_id']);
        $page = $_GET['p'];
        $ck = $sqlObj->delMemberById($id);
        if($ck){
            echo "
                <script type='text/javascript'>
                    location.href='{$page}.php';
                </script>
            ";
        }else{
            echo "
                <script type='text/javascript'>
                    location.href='{$page}.php';
                </script>
            ";
        }
    }
    
}
?>