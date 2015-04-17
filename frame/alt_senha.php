<?php
//recebendo dados de acesso ao bd
include "conf/config.php";
session_start();

$nivel=$_SESSION['nivel'];
$usuario=$_SESSION['usuario'];


//if ($nivel >= 1){

?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<head>
    <title> Alterar Senha </title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.js"></script>
</head>
<script type="text/javascript">
    $(document).ready(function(){
        $("#telefone").mask("(99)9999-9999");
        $("#celular").mask("(99)9-9999-9999");
        $("#cpf").mask("999.999.999-99");
        $("#rg").mask("99.999.999-*")
        $("#cep").mask("99999-999");
        $("#data").mask("99/99/9999");
    });
</script>
<body><fieldset class="usuario">
			<legend>Dados de Acesso ao Sistema:</legend>
			<label>Usuario:<input name="loga" type="text" id="loga" size="25" value="<?php echo('usuario') ?>" /></label><br>
			<label >Senha:<input name="senha" type="text" id="email" size="25" value="<?php echo('usuario') ?>" /></label><br>
			<label >Nivel:<input name="nivel" type="text" id="email" size="25" value="<?php echo('nivel') ?>" /></label><br>
			<br><br><br>
			<input class="botao" type="submit" name="acao" value="Salvar"/>
			<input type="hidden" name="acao" value="inserir" />
			<input class="botao" type="reset" value="Limpar"/>
			<a href="../desktop.php"><input type="button" class="botao" name="voltar"value="Voltar" /></a>
		</fieldset>
	</form>
</body>
</html>

<?php 
	
	if(isset($_POST['acao']) && $_POST['acao'] == "inserir"){
	
	// RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO 
	$senha= trim($_POST["senha"]);
	$usuario= $_SESSION['iduser'];
			
	//query que realizar a alteração dos dados
		$query = mysql_query("UPDATE `clientes` SET  `cl_senha` = '$senha' WHERE cl_id=$usuario ")
		or die(mysql_error());


		if (!$query){
			echo "<script language='javascript' type='text/javascript'>alert('Problemas ao alterar senha, contate o Administrador do Sistema!.');window.location.href='lista_chamado.php';</script>";
			}
		else{
			echo "<script language='javascript' type='text/javascript'>alert('Senha Alterada com Sucesso!');window.location.href='lista_chamado.php';</script>";
			}
		}
//}
//else{
//	echo ("Usuario: ".$usuario.", não possui acesso a esta area contate o Gerente!");
//}
?> 