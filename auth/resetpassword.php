<?php session_start(); ?>
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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JobJobSci@KMITL</title>
  <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/link.php"; ?>
  
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <?php
    if (isset($_POST['change'])) {
      // print_r($_POST);
      if($_SESSION['role']=="studen"){
        if ($_POST['u_password'] == $_POST['confirm']) {
          $dataS['stu_email'] = $_SESSION['stu_email'];
          // $data['stu_email'] = "66050015@kmitl.ac.th";
          $dataS['password'] = $_POST['u_password'];
          // print_r($data);
          $ck = $authObj->ChangePassStudent($dataS);
          if ($ck) {
            $msg = "Change password success student";
            echo "<script>";
            echo "alertSuccess('{$msg}','index.php')";
            echo "</script>";
          } else {
            $msg = "Not success !";
            echo "<script>";
            echo "alertError('{$msg}','resetpassword.php')";
            echo "</script>";
          }
        } else {
          $msg = "รหัสไม่ถูกต้อง";
          echo "<script>";
          echo "alertError('{$msg}','resetpassword.php')";
          echo "</script>";
        }

      }else{
        if ($_POST['u_password'] == $_POST['confirm']) {
          $dataM['m_email'] = $_SESSION['m_email'];
          $dataM['password'] = $_POST['u_password'];
          $ck = $authObj->ChangePass($dataM);
          if ($ck) {
            $msg = "Change password success member";
            echo "<script>";
            echo "alertSuccess('{$msg}','index.php')";
            echo "</script>";
          } else {
            $msg = "Not success !";
            echo "<script>";
            echo "alertError('{$msg}','resetpassword.php')";
            echo "</script>";
          }
        } else {
          $msg = "รหัสไม่ถูกต้อง";
          echo "<script>";
          echo "alertError('{$msg}','resetpassword.php')";
          echo "</script>";
        }
      }
    }
    ?>
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
      <a href="" class="h5">
        <img src="/parttime/imges/logo.png" alt="AdminLTE Logo" class="" style="display:table; margin: 0 auto; max-width:200px;">
        <b>JobJobSci@KMITL</b>
    </a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Change password</p>
        <p class="login-box-msg">
          <?php
            if(isset($_SESSION['m_email'])){
              echo $_SESSION['m_email'];
            }
            if(isset($_SESSION['stu_email'])){
              echo $_SESSION['stu_email'];
            }
          ?>
        </p>
        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password New" name="u_password" autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block" name="change">Change password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mt-3 mb-1">
          <a href="index.php">Login</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- script -->
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/app-certificate/backend/component/script.php");   ?>
</body>

</html>