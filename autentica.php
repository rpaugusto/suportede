<?php
include "frame/conf/config.php";

	$login = $_POST['usuario'];
	$senha = $_POST['senha'];

	$sql = mysql_query("select pessoa.p_id as id,
						pessoa.p_nome as nome,
						pessoa.p_login as login,
						pessoa.p_senha as senha,
						pessoa.p_nivel as nivel,
						escola.esc_nome as escola,
						escola.esc_id as escid
						from pessoa 
						inner join escola on escola.esc_id = pessoa.esc_id
						where p_login = '$login'") or die(mysql_error());
	$result = mysql_fetch_array($sql) or die(mysql_error());
	$usuario = $result['login'];
	$passwd = $result['senha'];


	if ($login == $usuario && $senha == $passwd){


		// grava informações do usuario para navegar no sistema
		session_start();
		$_SESSION['id'] = $result['id'];
		$_SESSION['nivel'] = $result['nivel'];
		$_SESSION['usuario'] = $result['nome'];
		$_SESSION['escola'] = $result['escola'];
		$_SESSION['escid'] = $result['escid'];
		$id = $result['id'];
		$sql2 = mysql_query("UPDATE logado SET log_status=1 WHERE p_id='$id'") or die(mysql_error());

		echo "<script>window.location='desktop.php'</script>";

	}else{
		echo "<script language='javascript' type='text/javascript'>alert('Usuario ou Senha invalida!, solicite seu cadastro com o responsavel.');window.location.href='login.html';</script>";
	};
?>
