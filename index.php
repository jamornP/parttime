<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>google login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="margin-top: 100px">
        <img src="imges/logo.png" alt="Logo" style="display:table; margin: 0 auto; max-width:300px;">
        <div class="mt-5" style="display:table; margin: 0 auto; max-width:300px;">
            <button onclick="window.location = '<?php echo $login_url;?>'" type="button" class="btn btn-primary d-flex justify-content-between align-items-center ">
                <div class=""><img src="imges/logo_google.png" alt="Logo" style="display:table; margin: 0 auto; max-width:50px;"> </div>
                <div class=""><b class="text-white">Login with Google</b></div>
            </button>
        </div>
        
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>