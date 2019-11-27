<?php
// Initialize the session
session_start();
 // Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location:../index.php");
    exit;
}
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
        $sql = "INSERT INTO calificacion (id_usuario,id_producto,puntuacion,comentario) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_user, $param_prod, $param_punt, $param_coment);
            
            // Set parameters
            $param_user = $id_user;
            $param_prod = $id_prod;
            $param_punt = $id_prod;
            $param_coment = $comentario;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: ../index.php");
            } else{
                echo (mysqli_error($link));
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Capitan Vape by HTML5 UP</title>
    <meta charset="utf-8" />
    <link id="icon" rel="icon" href="../../images/logo.ico" title="CapitanVape">
    <link rel="stylesheet" href="../../assets/css/access.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<div class="caja">
    <div class="wrapper">
        <h2>Agregar un comentario</h2>
        <form method="post" >
            <div class="form-group  ">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control" value="<?php echo $_SESSION["username"]; ?>"readonly>
            </div>    
            <div class="form-group">
                <label>Producto</label>
                <input type="text" name="text" class="form-control" value="<?php echo $name; ?>"readonly>
            </div>
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
</body>
</html>