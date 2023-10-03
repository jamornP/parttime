<?php 
if(isset($_SESSION['login_parttime']) AND $_SESSION['login_parttime']==true){

}else{
    header("location: /parttime/auth");
}

?>