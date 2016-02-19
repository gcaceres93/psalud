<!DOCTYPE html>
<html dir="ltr">
<head>
	<?php
    session_start();
    if(isset($_SESSION['usuario'])){

	?>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0">
	<title>Home</title>
		<!-- Start css3menu.com HEAD section -->
	<link rel="stylesheet" href="CSS3 Meeenu.css3prj_files/css3menu1/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
	<meta charset="utf-8"> 
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<!-- End css3menu.com HEAD section -->
	 <style type="text/css">
    .container {
        width: 500px;
        clear: both;
    }
    .container input {
        width: 100%;
        clear: both;
    }

    </style>
</head>
	
</head>
<body ontouchstart="" style="background-color:#A7C8FE">
<!-- Start css3menu.com BODY section -->
<?php include 'menu.php';?>
<div style="text-align:center;">
	<fieldset style = "display: inline-block;">
  <div class="container">
           <h2>BIENVENIDO A P-SALUD  </h2><br/>
		   <img src="./psa.png" height="480px" width="480px">
	
</div>

       </fieldset> 
	</div>	
</div>
<?php
}else{
	echo "Favor iniciar sesion para acceder al sistema";
}
?>
</body>

</html>
