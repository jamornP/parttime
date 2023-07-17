<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>google login</title>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/parttime/components/link.php'; ?>

<body class="font-kanit">
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/parttime/components/navbar.php'; ?>
    <div class="row">
        <br>
        <br>
        <br>
        <br>
    </div>
    <div class="container-fluid">
    <div class="row">
        
        <div class="col-md-5 col-lg-4  vh-100 overflow-auto b-2">
        <table class="table table-hover">
            <tbody>
                <?php
                    for($i=1;$i<=40;$i++){
                ?>
                <tr>
                    <td>
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $i;?></php>. Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <u class="text-warning">เอกสาร</u>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                            <div class="card-footer text-muted">
                            <div class="d-flex justify-content-between">
                                <b>
                                    <p>09.30 - 16.00</p>
                                </b>
                                <b>
                                    <p>50 บาท/ชั่วโมง</p>
                                </b>
                            </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php }?>
            </tbody> 
            
        </table>
        </div>
        <div class="col-md-7 col-lg-8 vh-100 overflow-auto fs-18">
            <div class="d-flex justify-content-between">
                <div class=""><h4>ชื่องาน Special title treatment</h4></div>
                <div class="">
                <button type="button" class="btn btn-outline-primary" style="--bs-btn-hover-color: #fff;">สมัคร</button>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="">
                    <u class="text-warning">เอกสาร</u>
                </div>
                <div class="">
                    <div class="row mt-2">
                        <div class="d-flex justify-content-end">
                            <b class="text-end fs-14">สมัครแล้ว: 3</b>
                        </div>    
                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <b class="text-end fs-14">รับแล้ว: 0/3</b>
                        </div>    
                    </div>
                </div>
            </div>
            <h5>รายละเอียด</h5>
            <div class="row mt-3">
                <div class="col-12 fs-18">
                    1.ช่วยงานลงทะเบียน พัสดุไปรษณีย์<br>
                    2.สนับสนุนตอบคำถาม เกี่ยวกับหอพักนักศึกษา<br>
                    3.สนับสนุนการพิมพ์เอกสาร
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-3">
                    <b>เงื่อนไขการสมัคร : </b>
                </div>
                <div class="col-9">
                    - รับนักศึกษา ทุกคณะ/ทุกชั้นปี<br>
                    - ทำงานเวลา 16.30 - 20.00 น.
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-3">
                    <b>วันทำงาน : </b>
                </div>
                <div class="col-9">
                    สามารถเลือกงานทำเองได้
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-3">
                    <b>เวลาทำงาน : </b>
                </div>
                <div class="col-9">
                    16.30 - 20.00 น.
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-3">
                    <b>ติดต่อสอบถามรายละเอียด : </b>
                </div>
                <div class="col-9">
                    คุณหนึ่ง สำนักงานหอพักนักศึกษา สจล. โทร. 02-329-8000 ต่อ 3330
                </div>
            </div>

        </div>
    </div>
    
    </div>
    <!-- <div class="container" style="margin-top: 100px">
        <img src="imges/logo.png" alt="Logo" style="display:table; margin: 0 auto; max-width:300px;">
        <div class="mt-5" style="display:table; margin: 0 auto; max-width:300px;">
            <button onclick="window.location = '<?php echo $login_url; ?>'" type="button" class="btn btn-primary d-flex justify-content-between align-items-center ">
                <div class=""><img src="imges/logo_google.png" alt="Logo" style="display:table; margin: 0 auto; max-width:50px;"> </div>
                <div class=""><b class="text-white">Login with Google</b></div>
            </button>
        </div>
        
    </div> -->



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>