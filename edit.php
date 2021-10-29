<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./normalize.css">
    <link rel="stylesheet" href="./edit.css">
</head>
<?php
    session_start();
    include("./conexion.php");
    if (
        !isset($_POST["user"]) && empty($_POST["user"]) &&
        !isset($_POST["email"]) && empty($_POST["email"]) &&
        !isset($_POST["rol"]) && empty($_POST["rol"]) &&
        !isset($_POST["password"]) && empty($_POST["password"]) &&
        !isset($_POST["id"]) && empty($_POST["id"]) &&
        !isset($_POST["rol"]) && empty($_POST["rol"]) &&
        !isset($_POST["sex"]) && empty($_POST["sex"])
    ){      
        header("Location: loginphp.php");
        $_SESSION["error"] = "Hubo un problema al comprobar los campos intente de nuevo o contacte con soporte";
        return;
    }else{
        if ($_SESSION["rol"] > 2 || !isset($_SESSION["rol"])){
            header("Location: loginphp.php");
            $_SESSION["error"] = "No estas autorizado para acceder a esta información";
            return;
        }
    }
?>
<body>
    <a href="./loginphp.php" class="backBtn">Regresar</a>
    <form method="POST" action="./editSentence.php">
        <img src="<?php
            $conn = mysqli_connect($host, $user, $password, $database);
            $query = "SELECT pic,id FROM usuarios WHERE nomusuario = '$_POST[user]'"; 
            $imgExecuted = mysqli_query($conn,$query);
            $imgExecuted = mysqli_fetch_array($imgExecuted);
            $imgExecuted = $imgExecuted["pic"];
            $_SESSION["tmp_id"] = $_POST["id"];
            if (!empty($imgExecuted)){
                echo $imgExecuted;
            }else{
                echo "./img/noimg.png";
            }
        ?>" alt="User Image">
        <label for="nuser">Nombre</label>
        <input type="text" name="nuser" required value="<?php echo $_POST["user"] ?>">
        <label for="nemail">Correo</label>
        <input type="email" name="nemail" required value="<?php echo $_POST["email"] ?>">
        <label for="nrol">Rol</label>
        <input type="text" name="nrol" required value="<?php echo $_POST["rol"] ?>">
        <label for="npassword">contraseña</label>
        <input type="text" name="npassword" required value="<?php echo $_POST["password"] ?>">
        <label for="nsex">Sexo</label>
        <select name="nsex" required>
            <?php
            if ($_POST["sex"] == "hombre") {
                echo "
                   <option value='hombre' selected>hombre</option>
                   <option value='mujer'>mujer</option>
                   <option value='nobinario'>nobinario</option>
                ";
            }else if($_POST["sex"] == "mujer"){
                echo "
                   <option value='hombre'>hombre</option>
                   <option value='mujer' selected>mujer</option>
                   <option value='nobinario'>nobinario</option>
                ";
            }else{
                echo "
                   <option value='hombre'>hombre</option>
                   <option value='mujer'>mujer</option>
                   <option value='nobinario' selected>nobinario</option>
                ";
            }
            ?>
        </select>
        <input type="submit" name="edit" value="Editar">
    </form>
</body>
</html>