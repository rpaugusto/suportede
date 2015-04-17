<?php
include "/frame/conf/config.php";

session_start();

$nivel=$_SESSION['nivel'] =7;
$escola=$_SESSION['escola']=1;



if ($nivel > 1){
	$Ok="0";

?>

<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title>CST - Diretoria de Ensino de Tupã</title>
		<meta name="description" content="CST - Centro de Serviços de Tecnologia - V1.0.1" />
		<link rel="stylesheet" type="text/css" href="css/stilo.css"/>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	</head>
<body>

	<div id="topo" align="center">
		<b>Usuario:</b> <?php echo $_SESSION['usuario'] ;?>
		<br>
		<b>Localidade:</b> <?php  echo $_SESSION['escola'];?>
	</div>
			
	<div id="corpo">
		<div class="margen" id="coluna1" align="center">
			<ul id="nav">
			    <li><a  target="desktop">Cadastros</a>
		    		<ul>
			    	    <li><a href="frame/cad_escola.php" target="desktop">Escolas</a></li>
			    	    <li><a href="frame/lista_escola.php" target="desktop">Lista Escola</a></li>
				        <li><a href="frame/cad_equipamento.php" target="desktop">Equipamentos</a></li>
				        <li><a href="frame/lista_equipamento.php" target="desktop">Listar Equip.</a></li>
				        <li><a href="frame/cad_usuario.php" target="desktop">Usuario</a></li>
				        <li><a href="frame/lista_usuario.php" target="desktop">Lista Usuario</a></li>
				     </ul>
				</li>
				<li><a  target="desktop">Chamados</a>
				    <ul>
					    <li><a href="frame/novo_chamado.php" target="desktop">Novo</a></li>
				        <li><a href="frame/lista_chamado.php" target="desktop">Listar</a></li>
				    </ul>
				</li>
				<li><a href="logout.php">Sair</a></li>
			</ul>
		</div>
		<div class="margen" id="postagem" align="auto">
			<iframe src="" width="800" height="700" name="desktop" align="center"></iframe>
		</div>
	</div>

</body>
</html>
<?php
}
else{
	echo $nivel;
}
?>