<!DOCTYPE html>
<html dir="ltr">
<head>


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
<?php


//session_start();
//$rol=$_SESSION['rol'];
$rol=2;



?>
<!-- Start css3menu.com BODY section -->

<?php if ($rol==1) { ?> <input type="checkbox" id="css3menu-switcher" class="c3m-switch-input">

<ul id="css3menu1" class="topmenu">
    <li class="switch"><label onclick="" for="css3menu-switcher"></label></li>
    <li class="topfirst"><a href="home.php" style="width:120px;"><img src="CSS3 Meeenu.css3prj_files/css3menu1/home.png" alt=""/>Home</a></li>
    <li class="topmenu"><a href="#" style="width:120px;"><span><img src="CSS3 Meeenu.css3prj_files/css3menu1/register.png" alt=""/>Login</span></a>
        <ul>
            <li ><a href="login2.php">Admin</a></li>
            <li><a href="login2.php">Usuarios</a></li>
            <li><a href="logout.php">Cerrar sesión</a></li>
        </ul></li>
    <li class="topmenu"><a href="#"><span><img src="CSS3 Meeenu.css3prj_files/css3menu1/find.png" alt=""/>Consultorio</span></a>
        <ul>
            <li ><a href="registrar%20consultorio.html">Registrar Consultorio</a></li>
            <li ><a href="registrar_consulta.php">Agendar Consulta</a></li>
        </ul></li>
    <li class="topmenu"><a href="#"><span><img src="CSS3 Meeenu.css3prj_files/css3menu1/eye.png" alt=""/>Tratamiento</span></a>
        <ul>
            <li ><a href="abm_diagnostico.php">Realizar Diagnostico</span></a>
            <li ><a href="registrar Tratamiento.html">Registrar Tratamiento</span></a></li>
            <li ><a href="registrar_seguimiento.html">Registrar Seguimiento</span></a></li>
            <li><a href="./historico_paciente.php">Historico Paciente</span></a></li>
        </ul></li>
    <li class="topmenu" ><a href="#"><span><img src="CSS3 Meeenu.css3prj_files/css3menu1/service1.png" alt=""/>Persona</span></a>
        <ul>
            <li ><a href="#"><span>Medicos</span></a>
                <ul>
                    <li><a href="addmedico.php">Agregar Medico</a></li>
                    <li><a href="modificar_medico.php">Modificar Medico</a></li>
                </ul></li>
            <li><a href="#"><span>Paciente</span></a>
                <ul>
                    <li><a href="addpersona2.php">Agregar Paciente</a></li>
                    <li  ><a href="modificar_paciente.php">Modificar Paciente</a></li>
                </ul></li>
        </ul></li>
    <li class="toplast" ><a href="#"><span><img src="CSS3 Meeenu.css3prj_files/css3menu1/download.png" alt=""/>Facturación</span></a>
        <ul>
            <li ><a href="facturacion.php">Generar Costo Consulta</a></li>
            <li ><a href="facturacion.php">Cancelar Factura</a></li>
        </ul></li>
</ul><br/>
<?php } else { if ($rol==2){  ?>
<ul id="css3menu1" class="topmenu">
    <li class="switch"><label onclick="" for="css3menu-switcher"></label></li>
    <li class="topfirst"><a href="home.php" style="width:120px;"><img src="CSS3 Meeenu.css3prj_files/css3menu1/home.png" alt=""/>Home</a></li>
    <li class="topmenu"><a href="#" style="width:120px;"><span><img src="CSS3 Meeenu.css3prj_files/css3menu1/register.png" alt=""/>Login</span></a>
        <ul>
            <li ><a href="login2.php">Admin</a></li>
            <li><a href="login2.php">Usuarios</a></li>
            <li><a href="logout.php">Cerrar sesión</a></li>
        </ul></li>
    <li class="topmenu"><a href="#"><span><img src="CSS3 Meeenu.css3prj_files/css3menu1/find.png" alt=""/>Consultorio</span></a>
        <ul>
            <li ><a href="registrar%20consultorio.html">Registrar Consultorio</a></li>
            <li ><a href="registrar_consulta.php">Agendar Consulta</a></li>
        </ul></li>
    <li class="topmenu"><a href="#"><span><img src="CSS3 Meeenu.css3prj_files/css3menu1/eye.png" alt=""/>Tratamiento</span></a>
        <ul>
            <li ><a href="abm_diagnostico.php">Realizar Diagnostico</span></a>
            <li ><a href="registrar Tratamiento.html">Registrar Tratamiento</span></a></li>
            <li ><a href="registrar_seguimiento.html">Registrar Seguimiento</span></a></li>
            <li><a href="./historico_paciente.php">Historico Paciente</span></a></li>
        </ul></li>
    <li class="topmenu" ><a href="#"><span><img src="CSS3 Meeenu.css3prj_files/css3menu1/service1.png" alt=""/>Persona</span></a>
        <ul>
            <li ><a href="#"><span>Medicos</span></a>
                <ul>
                    <li><a href="addmedico.php">Agregar Medico</a></li>
                    <li><a href="modificar_medico.php">Modificar Medico</a></li>
                </ul></li>
            <li><a href="#"><span>Paciente</span></a>
                <ul>
                    <li><a href="addpersona2.php">Agregar Paciente</a></li>
                    <li  ><a href="modificar_paciente.php">Modificar Paciente</a></li>
                </ul></li>
        </ul></li>
    <li class="toplast" ><a href="#"><span><img src="CSS3 Meeenu.css3prj_files/css3menu1/download.png" alt=""/>Facturación</span></a>
        <ul>
            <li ><a href="facturacion.php">Generar Costo Consulta</a></li>
            <li ><a href="facturacion.php">Cancelar Factura</a></li>
        </ul></li>
</ul><br/>

<?php } else {   ?>
<ul id="css3menu1" class="topmenu">
    <li class="switch"><label onclick="" for="css3menu-switcher"></label></li>
    <li class="topfirst"><a href="home.php" style="width:120px;"><img src="CSS3 Meeenu.css3prj_files/css3menu1/home.png" alt=""/>Home</a></li>
    <li class="topmenu"><a href="#" style="width:120px;"><span><img src="CSS3 Meeenu.css3prj_files/css3menu1/register.png" alt=""/>Login</span></a>
        <ul>
            <li ><a href="login2.php">Admin</a></li>
            <li><a href="login2.php">Usuarios</a></li>
            <li><a href="logout.php">Cerrar sesión</a></li>
        </ul></li>
    <li class="topmenu"><a href="#"><span><img src="CSS3 Meeenu.css3prj_files/css3menu1/find.png" alt=""/>Consultorio</span></a>
        <ul>
            <li ><a href="registrar%20consultorio.html">Registrar Consultorio</a></li>
            <li ><a href="registrar_consulta.php">Agendar Consulta</a></li>
        </ul></li>
    <li class="topmenu"><a href="#"><span><img src="CSS3 Meeenu.css3prj_files/css3menu1/eye.png" alt=""/>Tratamiento</span></a>
        <ul>
            <li ><a href="abm_diagnostico.php">Realizar Diagnostico</span></a>
            <li ><a href="registrar Tratamiento.html">Registrar Tratamiento</span></a></li>
            <li ><a href="registrar_seguimiento.html">Registrar Seguimiento</span></a></li>
            <li><a href="./historico_paciente.php">Historico Paciente</span></a></li>
        </ul></li>
    <li class="topmenu" ><a href="#"><span><img src="CSS3 Meeenu.css3prj_files/css3menu1/service1.png" alt=""/>Persona</span></a>
        <ul>
            <li ><a href="#"><span>Medicos</span></a>
                <ul>
                    <li><a href="addmedico.php">Agregar Medico</a></li>
                    <li><a href="modificar_medico.php">Modificar Medico</a></li>
                </ul></li>
            <li><a href="#"><span>Paciente</span></a>
                <ul>
                    <li><a href="addpersona2.php">Agregar Paciente</a></li>
                    <li  ><a href="modificar_paciente.php">Modificar Paciente</a></li>
                </ul></li>
        </ul></li>
    <li class="toplast" ><a href="#"><span><img src="CSS3 Meeenu.css3prj_files/css3menu1/download.png" alt=""/>Facturación</span></a>
        <ul>
            <li ><a href="facturacion.php">Generar Costo Consulta</a></li>
            <li ><a href="facturacion.php">Cancelar Factura</a></li>
        </ul></li>
</ul><br/>
<?php } } ?>



</div>

</body>

</html>
