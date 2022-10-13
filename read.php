<?php
// Verifique la existencia del parámetro id antes de continuar con el procesamiento
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Incluir archivo de configuración
    require_once "config.php";
    
    // Preparar una declaración selecta
    $sql = "SELECT * FROM employees WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Vincular variables a la declaración preparada como parámetros
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Establecer parámetros
        $param_id = trim($_GET["id"]);
        
        // Intento de ejecutar la declaración preparada
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Obtenga la fila de resultados como una matriz asociativa. Dado que el conjunto de resultados
                contiene solo una fila, no necesitamos usar while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Recuperar valor de campo individual
                $name = $row["name"];
                $address = $row["address"];
                $salary = $row["salary"];
            } else{
                // La URL no contiene un parámetro de identificación válido. Redirigir a la página de error
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Cerrar declaración
    mysqli_stmt_close($stmt);
    
    // Conexión cercana
    mysqli_close($link);
} else{
    // La URL no contiene el parámetro de identificación. Redirigir a la página de error
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Empleado</title>
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
                        <h1>Ver Empleado</h1>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <p class="form-control-static"><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <p class="form-control-static"><?php echo $row["address"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Sueldo</label>
                        <p class="form-control-static"><?php echo $row["salary"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Volver</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>