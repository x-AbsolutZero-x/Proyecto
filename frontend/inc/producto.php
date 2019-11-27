<!--Categorias-->
<?php
    // Include config file
    require_once "../lib/config.php";
    $categoria = $_GET["categoria"];
    $id = $_GET["id"];
    // Attempt select query execution
    $sql = "SELECT * FROM producto WHERE categoria = '".$categoria."' && id =  ";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
                    
                while($row = mysqli_fetch_array($result)){
                    echo "<a href='producto.php?id=".$row['id']."'>";
                    echo "<div class='caja producto'>";
                    echo '<div class="imagen"> . <img class="activator" src="../images/'.$row['imagen'].'" "></div>';
                    echo "<div class='info'><div class='caja-title'><header class='title' '><h3>" . $row['name'] . "</h3></header></div>";
                    echo "<div class='text'><ul>";
                    echo "<li>Descripción: " . $row['descripcion'] . "</li>";
                    echo "<li>Categoría: " . $row['categoria'] . "</li>";
                    echo "<li>Precio: $" . $row['precio'] . "</li>";
                    echo "</ul></div>";
                    echo "</div></div>";
                    echo "</a>";
                    
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