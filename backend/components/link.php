<link rel="icon" type="image/png" sizes="16x16" href="/parttime/favicons/favicon-16x16.png">
<link rel="icon" type="image/png" sizes="32x32" href="/parttime/favicons/favicon-32x32.png">
<link rel="apple-touch-icon" sizes="57x57" href="/parttime/favicons/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/parttime/favicons/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/parttime/favicons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/parttime/favicons/apple-touch-icon-76x76.png">
<link rel="icon" type="image/png" sizes="96x96" href="/parttime/favicons/apple-touch-icon-96x96.png">
<link rel="apple-touch-icon" sizes="114x114" href="/parttime/favicons/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/parttime/favicons/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/parttime/favicons/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/parttime/favicons/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/parttime/favicons/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192" href="/parttime/favicons/android-icon-192x192.png">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300&display=swap">
<!-- Font Awesome -->
<link rel="stylesheet" href="/parttime/plugins/fontawesome-free/css/all.min.css">

<!-- Fonts -->
<link rel="stylesheet" href="/parttime/css/font.css">
<!-- summernote -->
<link rel="stylesheet" href="/parttime/plugins/summernote/summernote-bs4.min.css">

<!-- DataTables -->
<link rel="stylesheet" href="/parttime/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/parttime/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/parttime/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- daterange picker -->
<link rel="stylesheet" href="/parttime/plugins/daterangepicker/daterangepicker.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="/parttime/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="/parttime/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="/parttime/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/parttime/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- BS Stepper -->
<link rel="stylesheet" href="/parttime/plugins/bs-stepper/css/bs-stepper.min.css">

<!-- SweetAlert2 -->
<link rel="stylesheet" href="/parttime/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Toastr -->
<link rel="stylesheet" href="/parttime/plugins/toastr/toastr.min.css">


<!-- Theme style -->
<link rel="stylesheet" href="/parttime/dist/css/adminlte.min.css">

 <!-- overlayScrollbars -->
 <link rel="stylesheet" href="/parttime/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

 <!-- Style -->
 <link rel="stylesheet" href="/parttime/backend/components/style.css">


 <!-- jQuery -->
<script src="/parttime/plugins/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="/parttime/plugins/toastr/toastr.min.css">
<script src="/parttime/plugins/toastr/toastr.min.js"></script>
<script>
  function alertSuccess(massage, url) {
    $(function() {
      toastr.options.onHidden = function() {
        window.location.href = url;
      }
      toastr.success(massage, 'Success', {
        timeOut: 500
      })
    })
  }
  function alertError(massage) {
    $(function() {
      toastr.error(massage, 'Error', {
        timeOut: 500
      })
    })
  }
</script>