<?php
//recebendo dados de acesso ao bd
	include 'conf/config.php';
  session_start();
//recuperando dados do usuario logado

$nivel=$_SESSION['nivel'];
$usuario=$_SESSION['usuario'];
$escola=$_SESSION['escola'];

//carregando informações da marca do equipamento
	$sql2= mysql_query("SELECT * FROM marca") or die(mysql_error());

if ($nivel >= 7){
?>

<html>
<meta charset="UTF-8">
<head>
    <title> Cadastro de Escolas </title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.js"></script>
</head>
<body>
	<form id="form" action="" method="post">
	<fieldset id="pessoal" class="fornecedor">
			<legend>Cadastro de Equipamento - <?php echo $escola;?></legend>
			<label >Origem:
				<select name="adq">
	        		<option value="0">Selecione...</option>
	        		<option value="RP">Recursos Propios</option>
	        		<option value="OU">Outsourcing</option>
	        	</select>
	        </label><br>
			<label >Marca:
				<select name="marca">
	        		<option value="0">Selecione...</option>
	<?php
		while($query2 = mysql_fetch_array($sql2)){
	?>
					<option value="<?php echo $query2['m_id'];?>"><?php echo $query2['m_nome'];?></option>
	<?php
		}
	?>
	        	</select>
			</label><br>
			<label >Tipo:
				<select name="tipo">
	        		<option value="0">Selecione...</option>
	        		<option value="IMP">Impressora</option>
	        		<option value="MON">Monitor</option>
	        		<option value="CPU">CPU</option>
	        	</select>
	        </label><br> 
		  	<label >Modelo:<input name="modelo" type="text"size="18" placeholder="modelo" /></label><br> 
		 	<label >N/S:<input name="serie" type="text"size="18" placeholder="numero / serie" /></label><br>
		 	<label >Patrimonio:<input name="gpb" type="text"size="18" placeholder="patrimonio" /></label><br>
			<br><br>
			<input class="botao" type="submit" name="acao" value="Salvar"/>
			<input type="hidden" name="acao" value="inserir" />
			<input class="botao" type="reset" value="Limpar"/>
			<a href="../desktop.php"><input type="button" class="botao" name="voltar"value="Voltar" /></a>
	</fieldset>
	</form>
</body>
</html>

<?php 
	 
	if(isset($_POST['acao']) && $_POST['acao'] == 'inserir'){

		// RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO 
		$esc_id=1;//$_SESSION['escid'] = 1;
		$adq= $_POST['adq'];
		$marca= $_POST['marca'];
		$tipo= $_POST['tipo'];
		$modelo= $_POST['modelo'];
		$serie= $_POST['serie'];
		$patrinu= $_POST['gpb'];

	
		//query que realizar a inserção dos dados
		$sql = mysql_query("INSERT INTO equipamento(
										  esc_id,
										  e_adquirido,
										  e_marca,
										  e_tipo,
										  e_modelo,
										  e_serie,
										  e_patrimonio)
							VALUES('$esc_id',
								   '$adq',
								   '$marca',
								   '$tipo',
								   '$modelo',
								   '$serie',
								   '$patrinu')");


		if (!$sql){
			echo "<script>
						alert('Erro ao cadastrar, verifiqeu se o equipamento ja foi cadastrado, o numero de serie não pode ser repetido!');
						document.location.href='lista_equipamento.php'
				</script>";
			}
		else{
			echo "<script>alert('Cadastro realizado com sucesso!');window.history.go(-1)</script>";
			}
		}
}
else{
	echo "Sem permissão de cadastro!";
	
};
?> 
