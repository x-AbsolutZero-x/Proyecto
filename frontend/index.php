<?php 
  include("inc/header.php");
?>

    <!-- Banner -->
    <section id="banner">
					<header>
						<h2>Te damos la bienvenida a <strong>Capitan Vape</strong>.</h2>
						<p>
							Tenemos variedades en productos de vapeo y otra gama de productos de calidad. Además poseemos diversos menús alimenticios, acompañados con bebidas y un servicio con total amabilidad.						</p>
					</header>
				</section>

			<!-- Carousel -->
				<section class="carousel">
					<div class="reel">

					<?php
					// Include config file
					require_once "../lib/config.php";
					$categoria = $_GET["categoria"];
					// Attempt select query execution
					$sql = "SELECT * FROM producto";
					if($result = mysqli_query($link, $sql)){
						if(mysqli_num_rows($result) > 0){
									
								while($row = mysqli_fetch_array($result)){
									echo "<article>";
									echo	'<a href="#" class="image featured"><img src="../images/'.$row['imagen'].'" alt="" /></a>';
									echo	"<header>";
									echo		'<h3><a href="#">'.$row['name'].'</a></h3>';
									echo	"</header>";
									echo	"<p>$" . $row['precio'] . "</p>";
									echo "</article>";

								}  
							// Free result set
							mysqli_free_result($result);
						} else{
							echo "<p class='lead'><em>No records were found.</em></p>";
						}
					} else{
						echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
					}
					echo "</div>";
					// Close connection
					mysqli_close($link);
					?>


					</div>
				</section>

			<!-- Main -->
				<div class="wrapper style2">

					<article id="main" class="container special">
						<a href="#" class="image restaurant"><img src="../images/Restaurante/rest3.png" alt="rest" /></a>
						<header>
							<h2><a href="#">Variedad en nuestros menús, preparados con productos de alta calidad.</a></h2>
							
						</header>
					
					</article>

				</div>

<?php 
  include("inc/footer.php");
?>