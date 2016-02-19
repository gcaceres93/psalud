<!DOCTYPE html>
<html dir="ltr">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0">
	<title>Historico Paciente</title>
		<!-- Start css3menu.com HEAD section -->
	<link rel="stylesheet" href="CSS3 Meeenu.css3prj_files/css3menu1/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
	<link rel="stylesheet" type="text/css" href="estilos.css" media="screen" />
	<meta charset="utf-8"> 
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<!-- End css3menu.com HEAD section -->
	 <style type="text/css">
    .container {
        width: 800px;
        clear: both;
    }
    .container input {
        width: 100%;
        clear: both;
    }

    </style>
	<script type="text/javascript">
		
	
	</script>
</head>
	
</head>
<body ontouchstart="" style="background-color:#A7C8FE">
<?php
session_start();
if(isset($_SESSION['usuario'])){

?>
<?php include 'menu.php'; ?>
<!-- Start css3menu.com BODY section -->


		<div style="text-align:center;">
  <fieldset style = "display: inline-block;">
  <div class="container">
           <h2 >Historico Paciente <img src="letter.png" height="64px" width="64px"> </h2>
		   <br><br>
<form class="form-horizontal" method="post" action="./insertar.php" id="guardarPaciente" action="PacienteServlet">


<div class="form-group">
<label class="control-label col-xs-3"></label>
<div class="col-xs-9">

</div>
</div>

<div id="Tabs">
	<ul>
		<li id="li_tab1" onclick="tab('tab1')" ><a>Diagnostico</a></li>
		<li id="li_tab2" onclick="tab('tab2')"><a>Tratamiento</a></li>
		<li id="li_tab3" onclick="tab('tab3')"><a>Seguimiento</a></li>
		<li id="li_tab4" onclick="tab('tab4')"><a>Estado Actual</a></li>
		<li id="li_tab5" onclick="tab('tab5')"><a>Antecedentes</a></li>
		
	</ul>
	<div class="form-group">
		<label class="control-label col-xs-3"></label>
		<div class="col-xs-9">

		</div>
		</div>
	<div id="Content_Area">
		<div id="tab1">
			<div class="form-group">
			<label class="control-label col-xs-3">Diagnostico:</label>
			<div class="col-xs-9">
			<textarea style="width:500px" rows="7" class="form-control" placeholder="Diagnostico" name="diagnostico"></textarea>
			</div>
			</div>
		</div>

		<div id="tab2" style="display: none;"> 
			
			<!--  We set its display as none because we don’t want to make this tab visible by default. 
			The only visible/active tab should be Tab 1 until the visitor clicks on Tab 2.  -->
			<div class="form-group">
			<label class="control-label col-xs-3">Tratamiento:</label>
			<div class="col-xs-9">
			<textarea style="width:500px" rows="7" class="form-control" placeholder="Tratamiento" name="tratamiento"></textarea>
			</div>
			</div>	
		</div>
		
		<div id="tab3" style="display: none;"> 
			
			
			<div class="form-group">
			<label class="control-label col-xs-3">Seguimiento:</label>
			<div class="col-xs-9">
			<textarea style="width:500px" rows="7" class="form-control" placeholder="Seguimineto" name="seguimiento"></textarea>
			</div>
			</div>	
		</div>
		
		<div id="tab4" style="display: none;"> 
			
			
			<div class="form-group">
			<label class="control-label col-xs-3">Estado Actual:</label>
			<div class="col-xs-9">
			<textarea style="width:500px" rows="7" class="form-control" placeholder="Estado Actual" name="estado_actual"></textarea>
			</div>
			</div>	
		</div>
		
		<div id="tab5" style="display: none;"> 
			
			<div class="form-group">
			<label class="control-label col-xs-3">Antecedentes Familiares:</label>
			<div class="col-xs-9">
			<textarea style="width:500px" rows="7" class="form-control" placeholder="Antecedentes Familiares" name="antecedentes"></textarea>
			</div>
			</div>	
		</div>
		
		
		
		
	</div> 
</div> 


<br/>

<br/>

<div class="form-group">
<div class="col-xs-offset-3 col-xs-9">

<br>
<input type="submit" class="btn btn-success" id="guardar" value="Registrar" >
<input type="reset" class="btn btn-default" value="Limpiar">
</div>
</div>
</form>
       </fieldset> 
	</div>	
</div>
<script type="text/javascript"”>
function tab(tab) {
document.getElementById('tab1').style.display = 'none';
document.getElementById('tab2').style.display = 'none';
document.getElementById('tab3').style.display = 'none';
document.getElementById('tab4').style.display = 'none';
document.getElementById('tab5').style.display = 'none';
document.getElementById('li_tab1').setAttribute("class", "");
document.getElementById('li_tab2').setAttribute("class", "");
document.getElementById('li_tab3').setAttribute("class", "");
document.getElementById('li_tab4').setAttribute("class", "");
document.getElementById('li_tab5').setAttribute("class", "");
document.getElementById(tab).style.display = 'block';
document.getElementById('li_'+tab).setAttribute("class", "active");
}
</script>
</body>
<?php
}else{
	echo "Favor iniciar sesion para acceder al sistema";
}
?>
</html>
