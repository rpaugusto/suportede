<?php
//recebendo dados de acesso ao bd
include "conf/config.php";
	session_start();

$nivel=$_SESSION['nivel'] = 9;
$usuario=$_SESSION['usuario'] = 1;

$sql4 = mysql_query('Select esc_nome, esc_id from escola')or die(mysql_error());


if ($nivel >= 7){

?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<head>
    <title> Cadastro de Funcionarios/Usuarios </title>
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
<body>
	<form id="form" action="" method="post" name="form">
		<fieldset class="cliente">
		<legend>Dados Pessoais:</legend>
			<label >Nome:<input name="nome" type="text" id="nome" size="25" placeholder="Nome Completo" /></label><br>
			<label >E-mail:<input name="email" type="text" id="email" size="25" placeholder="seu@email.com" /></label><br>
		 	<label >Sexo:<select id="sexo" name="sexo">
									    	<option value="M">Masculino</option>
									    	<option value="F">Feminino</option>
									    	</select></label><br>
		 	<label >Endereço:<input name="endereco" type="text" id="cidade" size="18" placeholder="Endereço" /></label><br> 
		  	<label >Bairro:<input name="bairro" type="text" id="cidade" size="18" placeholder="Bairro" /></label><br> 
		 	<label >Telefone:<input name="telefone" type="tel" id="telefone" size="13" placeholder="(99)9999-9999"/></label><br>
		  	<label >Celular:<input name="celular" type="tel" id="celular" size="15" placeholder="(99)9-9999-9999"/></label><br>
		  	<label >Cidade:<input name="cidade" type="text" id="cidade" size="18" placeholder="Cidades" /></label><br>
		  	<label >Estado:<select id="estado" name="estado">
									    	<option value="SP">SÃO PAULO</option>
									    	<option value="AC">ACRE</option>
											<option value="AL">ALAGOAS</option>
											<option value="AP">AMAPA</option>
									        <option value="AM">AMAZONAS</option>
									        <option value="BA">BAHIA</option>
									        <option value="CE">CEARA</option>
									        <option value="ES">ESPIRITO SANTO</option>
									        <option value="DF">DISTRITO FEDERAL</option>
									        <option value="MA">MARANHÃO</option>
									        <option value="MT">MATO GROSO</option>
									        <option value="MS">MATO GROSO DO SUL</option>
										    <option value="MG">MINAS GERAIS</option>
									        <option value="PA">PARA</option>
									        <option value="PB">PARAIBA</option>
									        <option value="PR">PARANÁ</option>
										    <option value="PE">PERNAMBUCO</option>
									        <option value="PI">PIAUI</option>
										    <option value="RJ">RIO DE JANEIRO</option>
									        <option value="RN">RIO GRANDE DO NORTE</option>
									        <option value="RS">RRIO GRANDE DO SUL</option>
										    <option value="RO">RONDONIA</option>
									        <option value="RR">RORAIMA</option>
									        <option value="SC">SANTA CATARINA</option>
									        <option value="SE">SERGIUPE</option>
									        <option value="TO">TOCANTINS</option>
								        </select></label><br> 
			<label >RG:<input name="rg" type="text" id="rg" size="18" placeholder="99.999.999-X" /></label><br>
			<label >CPF:<input type="text" name="cpf" id="cpf" size="18" placeholder="999.999.999-99"></label><br>
			<label >Escola:<select id="escola" name="escola">
<?php
									while($query4 = mysql_fetch_array($sql4))
    {
									    echo('<option value="'.$query4['esc_id'].'">'.$query4['esc_nome'].'</option>');
	};
?>
									    </select></label><br>	
		</fieldset>
		<fieldset class="usuario">
			<legend>Dados de Acesso ao Sistema:</legend>
			<label>Usuario:<input name="loga" type="text" id="loga" size="25" placeholder="login" /></label><br>
			<label >Senha:<input name="senha" type="password" id="email" size="25" placeholder="senha" /></label><br>
			<label >Nivel:<select id="nivel" name="nivel">
									    	<option value="0">Selecione...</option>
									    	<option value="1">Usuario</option>
									    	<option value="7">Tecnico</option>
									    </select></label><br>
			<p>**Solicite que seja alterado a senha no primeiro acesso!</p>
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
		$nome= trim($_POST["nome"]);
		$email= trim($_POST["email"]);
		$tel= trim($_POST["telefone"]);
		$cel= trim($_POST["celular"]);
		$endereco= trim($_POST["endereco"]);
		$cidade= trim($_POST["cidade"]);
		$estado= $_POST["estado"];
		$bairro = trim($_POST["bairro"]);
		$sexo= trim($_POST["sexo"]);
		$cpf= $_POST["cpf"];
		$rg= $_POST["rg"];
		$loga= trim($_POST["loga"]);
		$senha= trim($_POST["senha"]);
		$nivel= Trim($_POST["nivel"]);
		$escola= Trim($_POST["escola"]);
		
		
		//query que realizar a inserção dos dados
		$sql1 = mysql_query("INSERT INTO `pessoa` ( 
										`p_nome` ,
										`p_email` ,
										`p_sexo` ,
										`p_telefone`,
										`p_celular`,
										`p_endereco`,
										`p_cidade`,
										`p_estado`,
										`p_bairro`,
										`p_login`,
										`p_senha`,
										`p_rg`,
										`p_cpf`,
										`p_nivel`,
										`esc_id`,
										`p_id`) 
		VALUES 							('$nome',
										'$email',
										'$sexo',
										'$tel',
										'$cel',
										'$endereco',
										'$cidade',
										'$estado',
										'$bairro',
										'$loga',
										'$senha',
										'$rg',
										'$cpf',
										'$nivel',
										'$escola',
										'')")
		or die(mysql_error());
		$sql2 = mysql_query("select p_id from pessoa where p_nome = '$nome'");
		$query2 = mysql_fetch_array($sql2) or die(mysql_error());
		$id = $query2['p_id'];
		$sql3 = mysql_query("INSERT INTO `logado`(`log_status`, `p_id`) VALUES (0,'$id')");
		
		}
}
else{
	echo ("Usuario: ".$usuario.", não possui acesso a esta area contate o Administrador!");
}
?>