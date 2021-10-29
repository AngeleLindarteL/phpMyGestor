<?php
session_start();
    if ($_SESSION["rol"] > 1 || !isset($_SESSION["rol"])){
        header("Location: loginphp.php");
        $_SESSION["error"] = "¡No estas autorizado para acceder a este modulo!";
        return;
    }else{
        if (
            isset($_POST["user"]) && !empty($_POST["user"]) &&
            isset($_POST["password"]) && !empty($_POST["password"]) &&
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["rol"]) && !empty($_POST["rol"]) &&
            isset($_POST["sex"]) && !empty($_POST["sex"])
        ){
            include("./conexion.php");
            $conn = mysqli_connect($host,$user,$password,$database)
            or die ("Error al conectar con la base de datos");
            $query = "INSERT INTO usuarios(nomusuario,clave,idrol,email,sex)
            VALUES('$_POST[user]','$_POST[password]','$_POST[rol]','$_POST[email]','$_POST[sex]')";
            mysqli_query($conn, $query) or die ("Hubo un error al ejecutar la query, intentalo de nuevo o contacta con soporte");
            $_SESSION["msg"] = "¡Perfecto! El usuario $_POST[user] se agrego con exito a la base de datos.";
            header('Location: ./loginphp.php');
            return;
        }else{
            $_SESSION["error"] = "¡Oops! Revisa los campos y que la información sea correcta.";
            header('Location: ./loginphp.php');
        }
    }
?>