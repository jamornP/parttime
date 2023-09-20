<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] .'/parttime/auth/config.php');
?>
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
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
      
        <a href="" class="h5">
          <img src="/parttime/imges/logo.png" alt="AdminLTE Logo" class="" style="display:table; margin: 0 auto; max-width:200px;">
          <b>Parttime</b>
      </a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in for application</p>
        <?php
          if(isset($_POST['login'])){
            // print_r($_POST);
            $data['m_email'] = $_POST['email'];
            $data['password'] = $_POST['password'];
            $ck = $authObj->checkUser($data);
            if($ck){
              $msg = "Sign In success";
               echo "<script>";
               echo "alertSuccess('{$msg}','/parttime/backend/pages/staff/index.php')";
               echo "</script>";
            }else{
              $dataS['stu_email'] = $_POST['email'];
              $dataS['password'] = $_POST['password'];
              $ckS = $authObj->checkUserStudent($dataS);
              if($ckS){
                $msg = "Sign In success";
                 echo "<script>";
                 echo "alertSuccess('{$msg}','/parttime/backend/pages/student/index.php')";
                 echo "</script>";
              }else{
                $msg = "Email Password ไม่ถูกต้อง";
                 echo "<script>";
                 echo "alertError('{$msg}','/parttime/auth')";
                 echo "</script>";
              }
            }

          }
        ?>
        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
          
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mt-2 mb-3">
          <a href="<?php echo $login_url;?>" class="btn btn-block btn-danger">
            <i class="fab fa-google mr-2"></i> Sign in using Google+
          </a>
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="">I forgot my password</a>
        </p>
        
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
