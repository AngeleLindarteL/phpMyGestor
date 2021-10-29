<?php
    session_start();
    include("./conexion.php");
    $directory = "./img/users/";
    $uploaded_file = $directory.basename($_FILES["photo"]["name"]);
    if (getimagesize($_FILES["photo"]["tmp_name"]) == false){
        $_SESSION["error"] = "¡El tipo de archivo que intentas subir no esta soportado por la aplicación!";
        header("Location: ./loginphp.php");
        return;
    }
    if ($_FILES["photo"]["size"] > 2000000){
        $_SESSION["error"] = "¡El archivo que intentas subir es muy grande!";
        header("Location: ./loginphp.php");
        return;
    }
    if(move_uploaded_file($_FILES["photo"]["tmp_name"],$uploaded_file)){
        if (isset($_SESSION["pic"])) {
            unlink($_SESSION["pic"]);
        }
        $dir = $directory.$_FILES["photo"]["name"];
        try {
            $conn = mysqli_connect($host, $user, $password, $database);
            $query = "UPDATE usuarios SET pic='$dir' WHERE nomusuario = '$_SESSION[nombre]'";
            mysqli_query($conn, $query);
        } catch (Exception $th){
            throw new Exception ($th);
            $_SESSION["error"] = "¡Hubo un problema en el servidor porfavor intente más tarde!";
            header("Location: ./loginphp.php");
        }
        $_SESSION["pic"] = $dir;
        $_SESSION["msg"] = "¡Foto actualizada con éxito!";
        header("Location: ./loginphp.php");
    }else{
        $_SESSION["error"] = "¡Error al subir el archivo intentelo de nuevo!";
        header("Location: ./loginphp.php");
        return;
    }
    ?>