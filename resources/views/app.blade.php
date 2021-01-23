<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ACERVO</title>
    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" /> -->

    <?php
    $link = '';
    $script = '';
    if(strpos($_SERVER["REQUEST_URI"],'publico')){
         echo $link = '<link href="https://framework-gb.cdn.gob.mx/qa/assets/styles/main.css" rel="stylesheet">';;
    }else{ echo $link = ''; }
    ?>

</head>
<body>
<div id="app"></div>

<!-- JS -->
<script src="{{ URL::asset(mix('js/app.js')) }}"></script>
<?php
if(strpos($_SERVER["REQUEST_URI"],'publico')){
    echo $script = '<script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>';
}else{ $script = ''; }
?>
<!-- <link rel="stylesheet" href="{{URL::asset('css/app.css')}}"> -->
<!-- <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}"> -->
</body>
</html>
