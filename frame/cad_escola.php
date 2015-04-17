<?php
//recebendo dados de acesso ao bd
	include 'conf/config.php';
  session_start();
//recuperando dados do usuario logado

$nivel=$_SESSION['nivel'];
$usuario=$_SESSION['usuario'];

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
<script type="text/javascript">
    $(document).ready(function(){
        $("#telefone").mask("(99)9999-9999");
        $("#celular").mask("(99)9-9999-9999");
        $("#cpf").mask("999.999.999/9999-99");
        $("#ie").mask("999.999.999.999")
        $("#cep").mask("99999-999");
        $("#data").mask("99/99/9999");
    });
</script>
<body>
	<form id="form" action="" method="post">
		<fieldset id="pessoal" class="fornecedor">
			<legend>Dados da Unidade Escolar:</legend>
			<label >Escola:<input name="razao" type="text" size="25" placeholder="Nome da escola" class="ctexto2" /></label><br>
			<label >CIE:<input name="codigo" type="text" size="25" placeholder="Codigo CIEE" class="ctexto2" /></label><br>
			<label >Endereço:<input name="endereco" type="text" size="18" placeholder="Endereço" /></label><br> 
		  	<label >Bairro:<input name="bairro" type="text" size="18" placeholder="Bairro" /></label><br> 
		 	<label >Telefone:<input name="telefone" type="tel" id="telefone" size="13" placeholder="(99)9999-9999"/></label><br>
		 	<label >Cidade:<input name="cidade" type="text" size="18" placeholder="Cidades" /></label><br>
			<br><br>
			<input class="botao" type="submit" name="acao" value="Salvar"/>
			<input type="hidden" name="acao" value="inserir" />
			<input class="botao" type="reset" value="Limpar"/>
			<a href="../desktop.php"><input type="button" class="botao" name="voltar"value="Voltar" /></a>
		</fieldset>
	</form>
	<br><br>
</body>
</html>

<?php 
	 
	if(isset($_POST['acao']) && $_POST['acao'] == 'inserir'){

		// RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO 
		$tel= $_POST['telefone'];
		$endereco= $_POST['endereco'];
		$cidade= $_POST['cidade'];
		$social= $_POST['razao'];
		$codigo= $_POST['codigo'];
		$bairro= $_POST['bairro'];

	
		//query que realizar a inserção dos dados
		$sql = mysql_query("INSERT INTO escola(
										  esc_nome,
										  esc_endereco,
										  esc_cidade,
										  esc_fone,
										  esc_bairro,
										  esc_cie)
							VALUES('$social',
								   '$endereco',
								   '$cidade',
								   '$tel',
								   '$bairro',
								   '$codigo')")
							or die(mysql_error());
		echo $codigo;


		if (!$sql){
			echo "Ocorreu um erro ao efetuar o cadastro contate o adminstrador do sistema";
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