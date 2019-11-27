<!--Categorias-->
<?php
    // Include config file
    require_once "../lib/config.php";
    $categoria = $_GET["categoria"];
    // Attempt select query execution
    $sql = "SELECT * FROM producto WHERE categoria = '".$categoria."' ";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
                    
                while($row = mysqli_fetch_array($result)){
                    
                    echo "<div class='caja producto'>";
                    echo "<a class = 'imagen'  href='inc/producto.php?id=".$row['id']."'>";
                    echo '<div class="imagen"> . <img class="activator" src="../images/'.$row['imagen'].'" "></div>';
                    echo "<div class='info'><div class='caja-title'><header class='title' '><h3>" . $row['name'] . "</h3></header></div>";
                    echo "</a>";
                    echo "<div class='text'><ul>";
                    echo "<li>Descripción: " . $row['descripcion'] . "</li>";
                    echo "<li>Categoría: " . $row['categoria'] . "</li>";
                    echo "<li>Precio: $" . $row['precio'] . "</li>";
                    echo "<li><a href='inc/producto.php?id_producto=".$row['id']."&categoria=".$row["categoria"]."&nombre=".$row['name']."'>Agregar un comentario</a></li>";
                    echo "</ul></div>";
                    echo "</div></div>";
                    
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