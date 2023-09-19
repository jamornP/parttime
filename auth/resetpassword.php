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
  <title>Parttime | Sci@kmitl</title>
  <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/link.php"; ?>
  
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <?php
    if (isset($_POST['change'])) {
      // print_r($_POST);
      if($_SESSION['role']=="student"){
        if ($_POST['u_password'] == $_POST['confirm']) {
          $data['stu_email'] = $_SESSION['stu_email'];
          // $data['stu_email'] = "66050015@kmitl.ac.th";
          $data['password'] = $_POST['u_password'];
          $ck = $authObj->ChangePassStudent($data);
          if ($ck) {
            $msg = "Change password success";
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
          $data['m_email'] = $_SESSION['m_email'];
          $data['password'] = $_POST['u_password'];
          $ck = $authObj->ChangePass($data);
          if ($ck) {
            $msg = "Change password success";
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
        <b>Parttime</b>
    </a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Change password</p>
        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="u_password" autofocus>
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