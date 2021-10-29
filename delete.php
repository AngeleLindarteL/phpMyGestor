<?php 
    session_start();
    if (
        isset($_POST["user"]) && !empty($_POST["user"])
    ){
        include("./conexion.php");
        $conn = mysqli_connect($host,$user,$password,$database)
        or die ("Problemas de Conexión con la base de datos");
        $query = "DELETE FROM usuarios WHERE nomusuario = '$_POST[user]'";
        mysqli_query($conn,$query) or die ("Problemas con la query de actualización: ".mysqli_error($conn));
        $_SESSION["msg"] = "¡Usuario $_POST[user] eliminado exito!";
        header("Location: ./loginphp.php");
        return;
    }else{
        $_SESSION["error"] = "¡Error en la consulta! recarga la pagina e intentalo de nuevo.";
        header("Location: ./loginphp.php");
        return;
    }
?>