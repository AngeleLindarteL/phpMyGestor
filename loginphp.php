<html>
	<head>
		<title>Logeo</title>
		<link rel="stylesheet" href="./normalize.css">
		<link rel="stylesheet" href="./login.css">
	</head>
	<body>
		<form method="POST" autocomplete="off">
			<h1>Inicio de Sesion</h1>
			<input type="text" name="user" placeholder="Nombre de usuario" autocomplete="off"><br><br>
			<input type="password" name="pass" placeholder="Ingrese su Clave" autocomplete="off"><br><br>
			<input type="submit" value="Iniciar Sesion" name="">
		</form>
<?php
include_once 'conexionPDO.php';
session_start();

if(isset($_POST['cerrar_sesion']))
	{

		include_once 'cerrar.php';
		/*session_unset();
		session_destroy();*/
	}

if(isset($_SESSION['rol']))
	{
		switch ($_SESSION['rol']) 
		{
			case 1:
				header('Location: administrador.php');
				return;
				break;
			case 2:
				header('Location: instructor.php');
				return;
				break;
			case 3:
				header('Location: aprendiz.php');
				return;
				break;
			case 4:
				header('Location: invitado.php');
				return;
				break;
			default:
				echo "Este rol no existe dentro de las opciones";
				return;
				break;
		}
	}
if (isset($_SESSION["error"])) {
	echo "<div class=\"notification error\"><img src=\"./img/error.png\"><p>$_SESSION[error]</p></div>";
	unset($_SESSION["error"]);
}
if (isset($_POST['user']) && isset($_POST['pass']))
	{
		$username=$_POST['user'];
		$password=$_POST['pass'];

		$db=new Database();
		$query=$db->connectar()->prepare('SELECT * FROM usuarios WHERE nomusuario=:user AND clave=:pass');
		$query->execute(['user'=>$username,'pass'=>$password]);
		$arreglofila=$query->fetch(PDO::FETCH_NUM);

		if ($arreglofila == true ) 
			{
				$rol = $arreglofila[3];
				$_SESSION['nombre'] = $arreglofila[1];
				$_SESSION['rol'] = $rol;
				$_SESSION['pic'] = $arreglofila[5];
				$_SESSION['sex'] = $arreglofila[6];
				switch ($rol)
					{
						case 1:
							header('Location: administrador.php');
							break;
						case 2:
							header('Location: instructor.php');
							break;
						case 3:
							header('Location: aprendiz.php');
							break;
						case 4:
							header('Location: invitado.php');
							break;
						default:
							echo "Este rol no existe dentro de las opciones";
							break;
					}
			}
			else
			{
				echo "<div class=\"notification error\"><img src=\"./img/error.png\"><p>Nombre de usuario o contraseña incorrecto</p></div>";
			}
	}
?>
	<script src="./notification.js"></script>
	</body>
</html>	