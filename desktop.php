<?php
//recebendo dados de acesso ao bd
include "frame/conf/config.php";
//recebendo informações da session
  session_start();
$nivel=$_SESSION['nivel'];
$usuario=$_SESSION['usuario'];

$id= $_SESSION['id'];

//verificando nivel para mostra os chamados
if ($nivel >= 7){
//carregando dados da listagem
$sql1 = mysql_query("SELECT ch_status as tipo, count( ch_id ) as nchamado
					   FROM chamado
				   GROUP BY ch_status") 
                           or die(mysql_error());
} else {
//carregando dados da listagem
$sql1 = mysql_query("SELECT ch_status as tipo, count( ch_id ) as nchamado
					   FROM chamado
					  WHERE chamado.cli_id = '$id'
				   GROUP BY ch_status") 
                           or die(mysql_error());
};

?>

<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>CST - Centro de Serviços Tecnologicos - v1.1.0</title>
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta name="description" content="CST - Centro de Serviços de Tecnologia - V1.1.0" />
		<link rel="stylesheet" type="text/css" href="estilo.css"/>
		<link rel="shortcut icon" href="imagen/favicon.ico" type="image/x-icon" />
	</head>
	<body>
	
	<div id="topo">
		CST - Centro de Serviços Tecnologicos
		<div id="identifica">
			<a href="logout.php" ><img src="frame/img/sair.png" ></a>
			<br>
			<p>Usuario logado: <?php echo $usuario; ?></p>
		</div>
	</div>
	
	<div id="menu">
	<?php if ($nivel >= 7){ ?>
		<a href="frame/lista_usuario.php" target="desktop"><img src="frame/img/usuario.png" ></a>
		<a href="frame/lista_escola.php" target="desktop"><img src="frame/img/escola.png" ></a>
		<a href="frame/lista_equipamento.php" target="desktop"><img src="frame/img/equipamento.png" ></a>	
		<a href="frame/lista_chamado.php" target="desktop"><img src="frame/img/chamado.png" ></a>
		<a href="" target="desktop"><img src="frame/img/relatorio.png"></a>
	<?php } else { ?>
		<a href="frame/lista_usuario.php" target="desktop"><img src="frame/img/usuario.png" ></a>
		<a href="frame/lista_chamado.php" target="desktop"><img src="frame/img/chamado.png" ></a>
		<a  target="desktop"><img src="frame/img/relatorio.png"></a>
	<?php }?>
	</div>


	<div id="corpo">
		
		<div id="direita">
			<br>
			<hr>
			<h3>Meus chamados:</h3>
			<hr>
			<br>
			<table>
		<?php while ($query1 = mysql_fetch_array($sql1)) {
				echo "<tr>
					<td>Chamados ".$query1['tipo'].": ".$query1['nchamado']."</td>
				</tr>";
		};?>
			</table>
			
			
		</div>

		<div id="frame"  align="center">
			<iframe src="" width="99%" height="98%" name="desktop" FrameBorder="0" Marginwidth="0" Marginheight="0"></iframe>
		</div>


	</div>


	<div id="rodape">
		TODOS OS DIREITO RESERVADOS!
	</div>

	</body>
</html>