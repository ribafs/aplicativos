<?php
include "config/config.php";
include "config/funciones.php";

if(!isset($p)){
	$p = "inicio";
}

if(isset($registrar)){
	$scu = $link->query("SELECT * FROM usuarios WHERE user = '$user'");
	if($scu->rowCount()>0){
		alert("Este usuário já está sendo usado");
		redir("");
	}

	$link->query("INSERT INTO usuarios (nombre,user,pass) VALUES ('$nombre','$user','$pass')");
	//alert("Registro efetuado com sucesso");
	$s = $link->query("SELECT * FROM usuarios WHERE user = '$user'");
	$r = $s->fetch(PDO::FETCH_ASSOC);
	$_SESSION['id'] = $r['id'];
	redir("./");
}

if(isset($enviar)){
	$s = $link->query("SELECT * FROM usuarios WHERE user = '$userlogin' AND pass = '$passlogin'");
	if($s->rowCount()>0){
		$r = $s->fetch(PDO::FETCH_ASSOC);
		$_SESSION['id'] = $r['id'];
		//alert("Seja bem-vindo ".$r['nombre']);
		redir("./");
	}else{
		alert("Dados inválidos");
		redir("");
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="css/estilo.css"/>
	<script type="text/javascript" src="jquery.js"></script>
	<title>Chat AJAX</title>
</head>
<body>

	<?php
	if(isset($_SESSION['id'])){
		?>
        <h3 align="center">Chat AJAX</h3>
		Olá <?=nombre($_SESSION['id'])?>, seja bem vindo(a) <a href="?p=sair">Sair</a>
		<br>
		<br>

		<?php
		if(file_exists("modulos/".$p.".php")){
			include "modulos/".$p.".php";
		}else{
			echo "<i>O módulo seleccionado não existe</i> <a href='./'>Volar</a>";
		}
	}else{
		if($p!="registrate"){
		?>
		<center>
			<br><br><br>
			<h1>Acessar!</h1><br><br>
			<form method="post" action="">
				<input class="campo" type="text" name="userlogin" placeholder="Usuário"/><br><br>
				<input class="campo" type="password" name="passlogin" placeholder="Senha"/><br><br>
				<button class="boton" name="enviar">Entrar</button><br><br>
				<a href="?p=registrate">Registrar-se!</a>
			</form>
		</center>
		<?php
        }elseif($p=='sair'){
            session_start();

            session_destroy();
            header('Location: index.php');
		}else{
			?>
			<center>
			<br><br><br>
			<h1>Registrar-se!</h1><br><br>
			<form method="post" action="">
				<input class="campo" type="text" name="nombre" placeholder="Nome"/><br><br>
				<input class="campo" type="text" name="user" placeholder="Usuário"/><br><br>
				<input class="campo" type="password" name="pass" placeholder="Senha"/><br><br>
				<button class="boton" name="registrar">Registrar-se</button><br><br>
				<a href="./">Se já tens uma conta, então faz login!</a>
			</form>
		</center>
			<?php
		}
	}
	?>

</body>
</html>
