<?php session_start(); ?>
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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JobJobSci@KMITL</title>
  <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/link.php"; ?>
  
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <?php
 
        if(isset($_POST['resetpass'])){
          if($_POST['status']=="member"){
            $data['m_email'] = $_POST['email'];
            $data['password'] = '123456';
            $ck = $authObj->ChangePass($data);
            if ($ck) {
              $msg = "Reset password success";
              echo "<script>";
              echo "alertSuccess('{$msg}','staff.php')";
              echo "</script>";
            } else {
              $msg = "Not success !";
              echo "<script>";
              echo "alertError('{$msg}','resetpassword.php')";
              echo "</script>";
            }
          }elseif($_POST['status']=="student"){
            
            $data['stu_email'] = $_POST['email'];
            $data['password'] = '123456';
            $ck = $authObj->ChangePassStudent($data);
            if ($ck) {
              $msg = "Reset password success";
              echo "<script>";
              echo "alertSuccess('{$msg}','staff.php')";
              echo "</script>";
            } else {
              $msg = "Not success !";
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
        <p class="login-box-msg">Reset password</p>
        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email" autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <select class="form-control" style="width: 100%;" name="status">
            <option value='member'>เจ้าหน้าที่</option>
            <option value='student'>นักศึกษา</option>
          </select>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block" name="resetpass">Reset password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

    <?php require $_SERVER['DOCUMENT_ROOT'] . "/parttime/backend/components/script.php"; ?>
</body>

</html>