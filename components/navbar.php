<nav class="navbar navbar-expand-lg navbar-dark bg-312">
    <div class="container-fluid">
    <a class="navbar-brand d-flex justify-content-start align-items-center" href="#"><img src="imges/logo.png" alt="Logo" style="display:table; margin: 0 auto; max-width:200px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        
      </ul>
      <div class="" style="display:table; max-width:300px;">
          <button onclick="window.location = '<?php echo $login_url;?>'" type="button" class="btn bg-22 d-flex justify-content-between align-items-center ">
              <div class=""><img src="imges/logo_google.png" alt="Logo" style="display:box; margin: 0 auto; max-width:40px;"> </div>
              <div class=""><b class="">Login with Google</b></div>
          </button>
      </div>
    </div>
  </div>
</nav>
