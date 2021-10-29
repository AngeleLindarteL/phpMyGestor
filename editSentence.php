<?php 
    session_start();
    if (isset($_POST["edit"])){
        if (
            isset($_POST["nuser"]) && !empty($_POST["nuser"]) &&
            isset($_POST["nemail"]) && !empty($_POST["nemail"]) &&
            isset($_POST["nrol"]) && !empty($_POST["nrol"]) &&
            isset($_POST["npassword"]) && !empty($_POST["npassword"]) &&
            isset($_POST["nsex"]) && !empty($_POST["nsex"])
        ){
            include("./conexion.php");
            $conn = mysqli_connect($host,$user,$password,$database)
            or die ("Problemas de Conexión con la base de datos");
            $id = $_SESSION["tmp_id"];
            $query = "UPDATE usuarios SET nomusuario = '$_POST[nuser]', clave = '$_POST[npassword]', 
            idrol = '$_POST[nrol]', email = '$_POST[nemail]', sex = '$_POST[nsex]' WHERE id = $id";
            mysqli_query($conn,$query) or die ("Problemas con la query de actualización: ".mysqli_error($conn));
            $_SESSION["msg"] = "¡Usuario $_POST[nuser] con ID $_SESSION[tmp_id] actualizado con exito!";
            unset($_SESSION["tmp_id"]);
            header("Location: ./loginphp.php");
            return;
        }else{
            $_SESSION["error"] = "¡Error en los datos! comprueba que estan bien e intentalo de nuevo.";
            header("Location: ./loginphp.php");
            return;
        }
    }
?>