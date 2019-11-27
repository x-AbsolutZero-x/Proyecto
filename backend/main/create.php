<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


// Include config file
require_once "../../lib/config.php";
//CHecking session

// Define variables and initialize with empty values
$name = $descripcion = $categoria = $precio ="";
$name_err = $descripcion_err = $categoria_err = $precio_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Porfavor ingrese un nombre.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Porfavor ingrese un nombre valido.";
    } else{
        $name = $input_name;
    }    
    // Validate descripcion
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Porfavor ingrese una descripción.";     
    } else{
        $descripcion = $input_descripcion;
    }

    // Validate categoria
    $input_categoria = trim($_POST["categoria"]);
    if(empty($input_categoria)){
        $categoria_err = "Porfavor ingrese una categoría.";
    } elseif(!filter_var($input_categoria, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $categoria_err = "Porfavor seleccione una categoría.";
    } else{
        $categoria = $input_categoria;
    }
    
    // Validate precio
    $input_precio = trim($_POST["precio"]);
    if(empty($input_precio)){
        $precio_err = "Porfavor ingrese el precio.";     
    } elseif(!ctype_digit($input_precio)){
        $precio_err = "Porfavor ingrese un valor positivo.";
    } else{
        $precio = $input_precio;
    }
    // Validate image
    $target_dir = "../../images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "El archivo es una imagen - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Lo sentimos, el archivo no es una imagen.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Lo sentimos, el archivo ya existe.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 1000000) {
        echo "Lo sentimos, tu archivo es demasiado grande.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo " Lo sentimos, solo se aceptan archivos JPG, JPEG, PNG & GIF.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo " Su archivo no fue subido.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo " El archivo ". basename( $_FILES["fileToUpload"]["name"]). " ha sido subido.";
        } else {
            echo " Lo sentimos, hubo un error al subir su archivo.";
        }
    }
    // Check input errors before inserting in database
    if(empty($name_err) && empty($descripcion_err) && empty($categoria_err) && empty($precio_err) ){
        // Prepare an insert statement
        $sql = "INSERT INTO producto (name, descripcion, categoria, precio, imagen) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_descripcion, $param_categoria, $param_precio, $param_imagen);
            
            // Set parameters
            $param_name = $name;
            $param_descripcion = $descripcion;
            $param_categoria = $categoria;
            $param_precio = $precio;
            $param_imagen = $_FILES["fileToUpload"]["name"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: welcome.php");
                exit();
            } else{
                echo " Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
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
    <meta charset="UTF-8">
    <title>Añadir producto</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Añadir producto</h2>
                    </div>
                    <p>Complete este formulario y presione el botón de agregar para añadir el producto a la base de datos.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"  enctype="multipart/form-data">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Descripción</label>
                            <textarea name="descripcion" class="form-control"><?php echo $descripcion; ?></textarea>
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($categoria_err)) ? 'has-error' : ''; ?>">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Categoría</label>
                            </div>
                            <select name="categoria" class="custom-select" id="inputGroupSelect01">
                                <option selected>Seleccione una categoría...</option>
                                <option value="regulados">Mods Regulados</option>
                                <option value="mecanicos">Mods Mecánicos</option>
                                <option value="kits">Kits</option>
                                <option value="aio">AIO</option>
                                <option value="rda">Atomizadores RDA</option>
                                <option value="dta">Atomizadores DTA</option>
                                <option value="rdta">Atomizadores RDTA</option>
                                <option value="mtl">Atomizadores MTL</option>   
                                <option value="pod system">Pod System</option>   
                                <option value="algodon">Algodón</option>   
                                <option value="baterías">Baterías</option>
                                <option value="coils">Coils</option>
                                <option value="cargador">Cargador</option>   
                                <option value="drip tip">DRIP TIP</option>
                                <option value="doors">DOORS</option>
                                                             
                                <option value="drinks">Bebidas</option>
                                <option value="snacks">Snacks</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group <?php echo (!empty($precio_err)) ? 'has-error' : ''; ?>">
                            <label>Precio</label>
                            <input type="text" name="precio" class="form-control" value="<?php echo $precio; ?>">
                            <span class="help-block"><?php echo $precio_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($imagen_err)) ? 'has-error' : ''; ?>">
                            <label>Foto</label>
                            <input type="file" name="fileToUpload" classe ="form-control" id="fileToUpload" value="<?php echo $imagen; ?>">
                            <span class="help-block"><?php echo $imagen_err;?></span>
                        </div>
                        
                        <input type="submit" class="btn btn-primary" value="Agregar">
                        <a href="welcome.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>