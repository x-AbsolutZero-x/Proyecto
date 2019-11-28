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
$client = $_SESSION['username'];
$id_prod = $_GET["id_producto"];
$id_user = $_SESSION["id"];
$name = $_GET["nombre"];
$link = $_GET["categoria"];
// Include config file
require_once "../../lib/config.php";
//CHecking session
// Define variables and initialize with empty values
$comentario ="";
$comentario_err = "";
 // Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
      // Validate descripcion
    $input_comentario = trim($_POST["comentario"]);
    if(empty($input_comentario)){
        $comentario_err = "Please enter a comment.";     
    } else{
        $comentario = $input_comentario;
    }
    if(empty($comentario_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO calificacion (id_cliente,id_producto,username ,puntuacion,comentario) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_user, $param_prod,$param_username, $param_punt, $param_coment);
            
            // Set parameters
            $param_user = $id_user;
			$param_prod = $id_prod;
			$param_username = $client;
            $param_punt = $id_prod;
            $param_coment = $comentario;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
				// Records created successfully. Redirect to landing page
				header("Refresh:0");
            } else{
                //echo (mysqli_error($link));
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
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
		<link rel="icon" href="../../images/logo.ico" title="CapitanVape">
		<link rel="stylesheet" href="../../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
	</head>
	<body class="left-sidebar is-preload">
		<div id="page-wrapper">

			<!-- Header -->
			<div id="header" >
				<img src="../../images/Gallery/gal2.png" alt="fondo" />
                      <!-- Inner -->
						<div class="inner">
							<header>
								<h1><a href="#" id="logo"> <?php $categoria = $_GET["categoria"]; echo $categoria; ?> </a></h1>
							</header>
						</div>

					
					<!-- Nav -->
					<nav id="nav">
							<ul>
								<li><a href="../index.php">Inicio</a></li>
								<li>
									<a href="#">Productos</a>
									<ul>
										<li>
											<a href="#">MODS</a>
											<ul>
												<li><a href="../M_Regulados.php?categoria=regulados">Regulados</a></li>
												<li><a href="../M_Mecanicos.php?categoria=mecanicos">Mecánicos</a></li>
											</ul>
										</li>
										<li><a href="../Kits.php?categoria=kits">Kits</a></li>
										<li><a href="../AIO.php?categoria=aio">AIO</a></li>
										<li>
											<a href="#">Atomizadores</a>
											<ul>
												<li><a href="../A_rda.php?categoria=rda">rda</a></li>
												<li><a href="../A_dta.php?categoria=dta">dta</a></li>
												<li><a href="../A_rdta.php?categoria=rdta">rdta</a></li>
												<li><a href="../A_mtl.php?categoria=mtl">mtl</a></li>
											</ul>
										</li>
										<li>
											<a href="#">Componentes</a>
											<ul>
												<li><a href="../C_PodSys.php?categoria=pod system">Pod System</a></li>
												<li><a href="../C_Algodon.php?categoria=algodon">Algodón</a></li>
												<li><a href="../C_Baterias.php?categoria=baterias">Baterías</a></li>
												<li><a href="../C_Coils.php?categoria=coils">Coils</a></li>
												<li><a href="../C_Cargador.php?categoria=cargador">Cargador</a></li>
												<li><a href="../C_DripTip.php?categoria=drip tip">DRIP TIP</a></li>
												<li><a href="../C_Doors.php?categoria=doors">DOORS</a></li>
											</ul>
										</li>
										
									</ul>
								</li>
								<!--<li><a href="left-sidebar.php">Left Sidebar</a></li>-->
										
								<li>
									<a href="#">Bar</a>
									<ul>
										<li><a href="../Bar_snacks.php?categoria=snacks">Snacks</a></li>
										<li><a href="../Bar_drinks.php?categoria=drinks">Bebidas</a></li>										
									</ul>
								</li>
								<?php
                                    if($client !=null){
                                        echo "<li><a>".$_SESSION["username"]."</a></li>";
                                        echo "<li><a href='../logout.php'>Cerrar Sesion</a></li>";
                                    }
                                    else{
                                        echo "<li><a href='../login.php'>Iniciar sesion</a></li>";
								        echo "<li><a href='../register.php'>Registrarse</a></li>";
                                    }   
                                ?>
							</ul>
						</nav>

				</div>
			<!-- Main -->
				<div class="wrapper style1">

					<div class="container">
						<div class="row gtr-200">
							<div class="col-4 col-12-mobile" id="sidebar">
								<hr class="first" />
								
								<hr />

								<?php include("seccion_instagram_producto.php");?>
									
								<hr />
								
							</div>
							<div class="col-8 col-12-mobile imp-mobile" id="content">
								<article id="main">
									<header>
										</header>
							
										<!--Productos-->	
                                        <?php
                                        // Include config file
                                        require_once "../../lib/config.php";
                                        $id_prod = $_GET["id_producto"];
                                        // Attempt select query execution
                                        $sql2 = "SELECT * FROM producto WHERE id = '".$id_prod."' ";
                                        
                                        if($result = mysqli_query($link, $sql2)){
                                            if(mysqli_num_rows($result) > 0){
                                                        
                                                    while($row = mysqli_fetch_array($result)){
                                                        
                                                        echo "<div class='caja producto'>";
                                                        echo '<div class="imagen"> . <img class="activator" src="../../images/'.$row['imagen'].'" "></div>';
                                                        echo "<div class='info'><div class='caja-title'><header class='title' '><h3>" . $row['name'] . "</h3></header></div>";
                                                        echo "<div class='text'><ul>";
                                                        echo "<li>Descripción: " . $row['descripcion'] . "</li>";
                                                        echo "<li>Categoría: " . $row['categoria'] . "</li>";
                                                        echo "<li>Precio: $" . $row['precio'] . "</li>";
                                                        echo "</ul></div>";
                                                        echo "</div>";
                                                        echo "</div>";

                                                        
                                                    }  
                                                // Free result set
                                                mysqli_free_result($result);
                                            } else{
                                                //echo "<p class='lead'><em>No records were found.</em></p>";
                                            }
                                        }
                                        
                                        
                                        $sql ="SELECT * FROM calificacion WHERE id_producto = '".$id_prod."'";
                                        if($result = mysqli_query($link, $sql)){
                                            if(mysqli_num_rows($result) > 0){
                                                        
                                                    while($row = mysqli_fetch_array($result)){
                                                        
                                                        echo "<div>";
                                                        echo "<div class='commentbox'>";
                                                        echo "<p>Usuario: ".$row['username']."</p>";
                                                        echo "<p>" . $row['comentario'] . "</p>";
                                                        echo "</div>";
                                                        
                                                    }  
                                                // Free result set
                                                mysqli_free_result($result);
                                            } else{
                                                echo "<p class='lead'><em>No records were found.</em></p>";
                                                echo "<div>";
                                                echo "<div class='commentbox'>";
                                                echo "</div>";
                                            }
                                        } else{
                                            //echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                        }

                                        echo "</div>";
                                        // Close connection
                                        mysqli_close($link);
                                        ?>
										<div class="wrapper">
                                        
                                        
                                        <h2>Agregar un comentario</h2>
                                        <form method="post" >
                                            
                                            <div class="form-group">
                                                <label>Comentario</label>
                                                <textarea name="comentario" class="form-control"><?php ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="text" class="form-control" value="<?php echo $_SESSION["id"]; ?>">
                                                <input type="hidden" name="text" class="form-control" value="<?php echo $id_prod; ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary" value="Comentar">
                                            </div>
                                        </form>
                                        </div>
                                        </div> 
										</div>
                                        
																	
									</article>
							</div>
						</div>
						<hr />
				<?php 
				include("features.php");
				?>			
	</div>
</div>

<!-- Footer -->
<div id="footer">
				<div class="container">
					<div class="row">

						<!-- Facebooks -->
						<section class="col-4 col-12-mobile">
								<header>
									<h2 class="icon brands fa-facebook-f circled"><span class="label">Facebook</span></h2>
								</header>
								<ul class="divided">
									<li>
										<article class="face">
											<a href="https://www.facebook.com/350309472151681/photos/a.356387268210568/744518482730776/?type=3&theater">DOTMOD 200w with the dot RDA 1,5!!! always available in capitanvape @dotmod</a>
											<br>
											<span class="timestamp">8 de noviembre a las 18:52</span>
										</article>
									</li>
									<li>
										<article class="face">
											<a href="https://www.facebook.com/350309472151681/photos/a.356387268210568/727572551092036/?type=3&theater">Asvape MICRO is in @capitanvapesv...</a>
											<br>
											<span class="timestamp">19 de octubre</span>
										</article>
									</li>
									<li>
										<article class="face">
											<a href="https://www.facebook.com/350309472151681/photos/a.356387268210568/726651931184098/?type=3&theater">Black DOTAIO IS BACK!!!</a>
											<br>
											<span class="timestamp">18 de octubre a las 16:52</span>
										</article>
									</li>
									<li>
										<article class="face">
											<a href="https://www.facebook.com/350309472151681/photos/a.356387268210568/718053615377263/?type=3&theater">Nuevos horarios de atención</a>
											<br>
											<span class="timestamp">7 de octubre</span>
										</article>
									</li>
								</ul>
							</section>

						<!-- Posts -->
							<section class="col-4 col-12-mobile">
								<header>
									<h2 class="icon solid fa-map circled"><span class="label">Posts</span></h2>
								</header>
								<section>
									<div class="map-ubi">
										<div style="width: 100%"><iframe width="100%" height="300" src="https://maps.google.com/maps?width=100%&height=300&hl=es&q=Capitan%Vape%20Nuevo%20Cuscatlan+(Capit%C3%A1n%20Vape)&ie=UTF8&t=h&z=16&iwloc=A&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.mapsdirections.info/calcular-ruta.html">Mapa de Ruta</a></iframe></div><br />
									</div>
									<div class="info">
										
											<h3><a href="../index.html">Capitan Vape</a></h3>
										<p>Boulevard Cuscatlán, Plaza Paradiso Local 3 Nuevo Cuscatlán, CP</p>
									</div>
									<footer class="ubi-link">
										<a href="https://www.google.com/maps?ll=13.652227,-89.263816&z=16&t=h&hl=es&gl=US&mapclient=embed&cid=18265157331667945363" class="button">Ver ubicación...</a>
									</footer>
								</section>
							</section>

						<!-- Photos -->
							<section class="col-4 col-12-mobile">
								<header>
									<h2 class="icon solid fa-camera circled"><span class="label">Photos</span></h2>
								</header>
								<div class="row gtr-25">
									<div class="col-6">
										<a href="https://www.instagram.com/p/Bo0OxEJBaPToOjfICRu_4XpjXr47aTbUE9-NbY0/" class="image fit"><img src="../../images/Gallery/gal1.png" alt="gal1" /></a>
									</div>
									<div class="col-6">
										<a href="https://www.instagram.com/p/B0UT0walwoA04IucBGYJ0iw-cJQClOfIPinCJM0/" class="image fit"><img src="../../images/Gallery/gal2.png" alt="gal2" /></a>
									</div>
									<div class="col-6">
										<a href="https://www.instagram.com/p/B2kTiOQFYk1zm2crjqWU1vKDGIhTI0YYpbsH6Y0/" class="image fit"><img src="../../images/Gallery/gal3.png" alt="gal3" /></a>
									</div>
									<div class="col-6">
										<a href="https://www.instagram.com/p/ByoIq1QFQgEHHFJJIz4CPFc-fb4P7cRKb2YYSQ0/" class="image fit"><img src="../../images/Gallery/gal4.png" alt="gal4" /></a>
									</div>
									<div class="col-6">
										<a href="https://www.instagram.com/p/BtLtbsvnwbnRVQ9HidKbxmRgElPa06Wtc_ffn80/" class="image fit"><img src="../../images/Gallery/gal5.png" alt="gal5" /></a>
									</div>
									<div class="col-6">
										<a href="https://www.instagram.com/p/BsWdCF6Huudpxisd0sQ5BDSK3NSUnTkIxaxixg0/" class="image fit"><img src="../../images/Gallery/gal6.png" alt="gal6" /></a>
									</div>
								</div>
							</section>

					</div>
					<hr />
					<div class="row">
						<div class="col-12">

							<!-- Contact -->
								<section class="contact">
									<header>
										<h3>¿Quieres saber más acerca de nuestros productos?</h3>
									</header>
									<p>Visita nuestrar redes sociales Facebook e Instagram.</p>
									<ul class="icons">
										<li><a href="https://www.facebook.com/Capitan-vapesv-350309472151681/" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
										<li><a href="https://www.instagram.com/capitanvapesv/?hl=es-la" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
									<!-- se pueden añadir mas enlaces -->
									</ul>
								</section>

							<!-- Copyright -->
								<div class="copyright">
									<ul class="menu">
										<li>&copy; Capitan Vape. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
									</ul>
								</div>

						</div>

					</div>
				</div>
			</div>

	</div>

	<!-- Scripts -->
		<script src="../../assets/js/jquery.min.js"></script>
		<script src="../../assets/js/jquery.dropotron.min.js"></script>
		<script src="../../assets/js/jquery.scrolly.min.js"></script>
		<script src="../../assets/js/jquery.scrollex.min.js"></script>
		<script src="../../assets/js/browser.min.js"></script>
		<script src="../../assets/js/breakpoints.min.js"></script>
		<script src="../../assets/js/util.js"></script>
		<script src="../../assets/js/main.js"></script>

</body>
</html>