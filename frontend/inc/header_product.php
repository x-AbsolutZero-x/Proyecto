<?php 
session_start();
if($_SESSION) 
{ 
    $client = $_SESSION['username'];
    $iduser =$_SESSION["id"];
}
else{
    $client = null;
}
?>

<!-- Header Product -->
<!DOCTYPE HTML>
<!--
	Helios by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Capitan Vape by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="icon" href="../images/logo.ico" title="CapitanVape">
		<link rel="stylesheet" href="../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
	</head>
	<body class="left-sidebar is-preload">
		<div id="page-wrapper">

			<!-- Header -->
			<div id="header" >
				<img src="../images/Gallery/gal2.png" alt="fondo" />
                      <!-- Inner -->
						<div class="inner">
							<header>
								<h1><a href="#" id="logo"> <?php $categoria = $_GET["categoria"]; echo $categoria; ?> </a></h1>
							</header>
						</div>

					
					<!-- Nav -->
					<nav id="nav">
							<ul>
								<li><a href="index.php">Inicio</a></li>
								<li>
									<a href="#">Productos</a>
									<ul>
										<li>
											<a href="#">MODS</a>
											<ul>
												<li><a href="M_Regulados.php?categoria=regulados">Regulados</a></li>
												<li><a href="M_Mecanicos.php?categoria=mecanicos">Mecánicos</a></li>
											</ul>
										</li>
										<li><a href="Kits.php?categoria=kits">Kits</a></li>
										<li><a href="AIO.php?categoria=aio">AIO</a></li>
										<li>
											<a href="#">Atomizadores</a>
											<ul>
												<li><a href="A_rda.php?categoria=rda">rda</a></li>
												<li><a href="A_dta.php?categoria=dta">dta</a></li>
												<li><a href="A_rdta.php?categoria=rdta">rdta</a></li>
												<li><a href="A_mtl.php?categoria=mtl">mtl</a></li>
											</ul>
										</li>
										<li>
											<a href="#">Componentes</a>
											<ul>
												<li><a href="C_PodSys.php?categoria=pod system">Pod System</a></li>
												<li><a href="C_Algodon.php?categoria=algodon">Algodón</a></li>
												<li><a href="C_Baterias.php?categoria=baterias">Baterías</a></li>
												<li><a href="C_Coils.php?categoria=coils">Coils</a></li>
												<li><a href="C_Cargador.php?categoria=cargador">Cargador</a></li>
												<li><a href="C_DripTip.php?categoria=drip tip">DRIP TIP</a></li>
												<li><a href="C_Doors.php?categoria=doors">DOORS</a></li>
											</ul>
										</li>
										
									</ul>
								</li>
								<!--<li><a href="left-sidebar.php">Left Sidebar</a></li>-->
										
								<li>
									<a href="#">Bar</a>
									<ul>
										<li><a href="Bar_snacks.php?categoria=snacks">Snacks</a></li>
										<li><a href="Bar_drinks.php?categoria=drinks">Bebidas</a></li>										
									</ul>
								</li>
								<li><a href="right-sidebar.php?categoria=rsidebar">Right Sidebar</a></li>
								<li><a href="login.php">Iniciar sesion</a></li>
								<li><a href="register.php">Registrarse</a></li>
							</ul>
						</nav>

				</div>