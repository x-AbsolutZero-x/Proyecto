<script>
var x = "Bebidas";
</script>

<?php 
  include("inc/header_product.php");
?>
			<!-- Main -->
				<div class="wrapper style1">

					<div class="container">
						<div class="row gtr-200">
							<div class="col-4 col-12-mobile" id="sidebar">
								<hr class="first" />
								
								<hr />

								<?php include("inc/seccion_instagram.php");?>	

								<hr />
								<section>
									<header>
										<h3><a href="#">Sed lorem etiam consequat</a></h3>
									</header>
									<p>
										Tempus cubilia ultrices tempor sagittis. Nisl fermentum consequat integer interdum.
									</p>
										<div class="col-4">
											<h3 class="header left-align hide-on-med-and-down">'.$row["nombre_menu"].'</h3>
											<a href="#" class="image fit"><img src="../images/pic10.jpg" alt="pic10" /></a>
										</div>
										<div class="col-8">
											<h4>Nibh sed cubilia</h4>
											<p>
												Amet nullam fringilla nibh nulla convallis tique ante proin.
											</p>
										</div>
										<!---->
										

									<div class="row gtr-50">
										<div class="col-4">
											<a href="#" class="image fit"><img src="../images/pic10.jpg" alt="pic10" /></a>
										</div>
										<div class="col-8">
											<h4>Nibh sed cubilia</h4>
											<p>
												Amet nullam fringilla nibh nulla convallis tique ante proin.
											</p>
										</div>
										<div class="col-4">
											<a href="#" class="image fit"><img src="../images/pic11.jpg" alt="pic11" /></a>
										</div>
										<div class="col-8">
											<h4>Proin sed adipiscing</h4>
											<p>
												Amet nullam fringilla nibh nulla convallis tique ante proin.
											</p>
										</div>
										<div class="col-4">
											<a href="#" class="image fit"><img src="../images/pic12.jpg" alt="pic12" /></a>
										</div>
										<div class="col-8">
											<h4>Lorem feugiat magna</h4>
											<p>
												Amet nullam fringilla nibh nulla convallis tique ante proin.
											</p>
										</div>
										<div class="col-4">
											<a href="#" class="image fit"><img src="../images/pic13.jpg" alt="pic13" /></a>
										</div>
										<div class="col-8">
											<h4>Sed tempus fringilla</h4>
											<p>
												Amet nullam fringilla nibh nulla convallis tique ante proin.
											</p>
										</div>
										<div class="col-4">
											<a href="#" class="image fit"><img src="../images/pic14.jpg" alt="pic14" /></a>
										</div>
										<div class="col-8">
											<h4>Malesuada fermentum</h4>
											<p>
												Amet nullam fringilla nibh nulla convallis tique ante proin.
											</p>
									
									</div>
									<footer>
										<a href="#" class="button">Magna Adipiscing</a>
									</footer>
								</section>
							</div>
							<div class="col-8 col-12-mobile imp-mobile" id="content">
								<article id="main">
									<header>
										<h2><a href="#">Bebidas</a></h2> <!-- Header pagina (categoria)-->
										<p>
											Morbi convallis lectus malesuada sed fermentum dolore amet
										</p>
									</header>
							
							<!--Productos-->	
									<div class="caja producto">	
											<div class="imagen">
												<a href="#" class="image kit"><img src="images/Bar_gal/dummy.jpg" alt="" /></a>
											</div>
											<div class="info">
											<?php
											// Include config file
											require_once "../lib/config.php";
											
											// Attempt select query execution
											$sql = "SELECT * FROM producto";
											if($result = mysqli_query($link, $sql)){
												if(mysqli_num_rows($result) > 0){
													echo "<table class='table table-bordered table-striped'>";
														echo "<thead>";
															echo "<tr>";
																echo "<th>#</th>";
																echo "<th>Name</th>";
																echo "<th>Address</th>";
																echo "<th>Salary</th>";
																echo "<th>Action</th>";
															echo "</tr>";
														echo "</thead>";
														echo "<tbody>";
														while($row = mysqli_fetch_array($result)){
															echo "<tr>";
																echo "<td>" . $row['nombre_producto'] . "</td>";
																echo "<td>" . $row['precio'] . "</td>";
																echo "<td>" . $row['descripcion'] . "</td>";
																echo "<td>" . $row['categoria'] . "</td>";
																echo "<td>" . $row['imagen'] . "</td>";
																;
														}
														echo "</tbody>";                            
													echo "</table>";
													// Free result set
													mysqli_free_result($result);
												} else{
													echo "<p class='lead'><em>No records were found.</em></p>";
												}
											} else{
												echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
											}
						
											// Close connection
											mysqli_close($link);
											?>
											</div>
										
									</div>
									<div class="caja producto">	
                                        <div class="imagen">
                                            <a href="#" class="image kit"><img src="images/Bar_gal/dummy.jpg" alt="" /></a>
                                        </div>
                                        <div class="info">
                                            <div class="caja-title">
                                                <header class="title">
                                                        <h3>Drink2</h3>
                                                </header>
                                            </div>
                                            <div class="text">
                                                <ul>
                                                    <p>Dummy description for drinks</p>
                                                </ul>
                                            </div>	
                                        </div>
                                    
                                </div>
                                <div class="caja producto">	
                                    <div class="imagen">
                                        <a href="#" class="image kit"><img src="images/Bar_gal/dummy.jpg" alt="" /></a>
                                    </div>
                                    <div class="info">
                                        <div class="caja-title">
                                            <header class="title">
                                                    <h3>Drink3</h3>
                                            </header>
                                        </div>
                                        <div class="text">
                                            <ul>
                                                <p>Dummy description for drinks</p>
                                            </ul>
                                        </div>	
                                    </div>
                                
                            </div>
                                
                            </div>
									
									</div>
																
								</article>
							</div>
						</div>
						<hr />
				<?php 
				include("inc/features.php");
				?>			
	</div>
</div>

<?php 
  include("inc/footer.php");
?>