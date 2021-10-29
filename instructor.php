<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprendiz</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<?php 
    $conn = mysqli_connect("localhost","root","","crud") or die ("problemas en la conexión");
    session_start();
    $rol = $_SESSION["rol"];
    if(!isset($rol)){
        $_SESSION["error"] = "¡Alto ahí rufian! Debes iniciar sesión primero.";
        header('Location: loginphp.php');
        return;
    }else{
        if($rol != 2){
            $_SESSION["error"] = "Unauthorized";
            header('Location: loginphp.php');
            return;
        }
    }
?>
<body id="admin">
    <?php 
        if (isset($_SESSION["error"])){
            echo "<div class=\"notification error\"><img src=\"./img/error.png\"><p>$_SESSION[error]</p></div>";
            unset($_SESSION["error"]);
        }
        if (isset($_SESSION["msg"])) {
            echo "<div class=\"notification msg\"><img src=\"./img/check.png\"><p>$_SESSION[msg]</p></div>";            
            unset($_SESSION["msg"]);
        }
    ?>
    <div class="presentation administrador">
        <h1>
            <?php 
                if($_SESSION["sex"] == "mujer"){
                    echo "¡Bienvenida ".$_SESSION["nombre"]."!";
                }
                else if($_SESSION["sex"] == "nobinario"){
                    echo "¡Bienvenidx ".$_SESSION["nombre"]."!";
                }
                else if($_SESSION["sex"] == "hombre"){
                    echo "¡Bienvenido ".$_SESSION["nombre"]."!";
                }
            ?>
        </h1>
        <?php
            if (isset($_SESSION["pic"]) && !empty($_SESSION["pic"])){
                $picroute = $_SESSION["pic"];
                echo "<img src=\"$picroute\">";
            }else{
                echo "<img src=\"./img/noimg.png\">";
            }
        ?>
        <form action="loginphp.php" method="POST" class="logout">
            <input type="submit" name="cerrar_sesion" value="Cerrar Sesión"> 
        </form>
        <p class="changetext">Cambia tu imagen de Perfil</p>
        <form action="updatePic.php" method="POST" enctype="multipart/form-data" class="image-update">
            <input type="file" name="photo" required accept="image/png, image/jpeg, image/jpg, image/gif">
            <input type="submit" name="actualizar">
        </form>
    </div>
    <div class="user-table-container admin-table">
        <table class="users-table" border="0">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Usuarios</th>
                    <th>Email</th>
                    <th>acciones</th>
                </tr>
            </thead>
            <?php 
                $consulta = "SELECT * FROM usuarios";
                $eject = mysqli_query($conn,$consulta);
                while($obj = mysqli_fetch_array($eject)){
                    $usuario = $obj["nomusuario"];
                    $email = $obj["email"];
                    $idrol = $obj["idrol"];
                    $clave = $obj["clave"];
                    $pic = $obj["pic"];
                    $sex = $obj["sex"];
                    $id = $obj["id"];
                    if ($idrol > 2) {
                        echo "<tr>";
                            if (!empty($pic)) {
                                echo "<td class='pic-table'><img src='$pic'></td>";
                            }else{
                                echo "<td class='pic-table'><img src='./img/noimg.png'></td>";
                            }
                            echo "<td>".$usuario."</td>";
                            echo "<td>".$email."</td>";
                            echo "
                                <td class='actions-container'>
                                    <div class='actions'>
                                        <form method='POST' action='./delete.php'>
                                            <input type='text' style='display: none' value='$usuario' name='user'>
                                            <input type='submit' class='actionBtn deleteBtn' value=''>
                                        </form>
                                    </div>
                                </td>
                            ";
                        echo "</tr>";
                    }
                }
            ?>
        </table>
    </div>
    <script src="./notification.js"></script>
</body>
</html>