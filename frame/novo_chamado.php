<?php
//recebendo dados de acesso ao bd
include "conf/config.php";
session_start();
//recuperando dados do usuario logado
$nivel=$_SESSION['nivel'];
$usuid=$_SESSION['usuario'];
$escola=$_SESSION['escola'];

//carregando informações necessarias para abertura do chamado
/*
if ($nivel >= 1){
*/
?>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <title> Registrando novo chamados </title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.js"></script>
</head>

<body>
<form method="post" action="">
    <fieldset class="cliente">
        <legend>Novo Chamado:</legend>
    <label >Escola:<input name="escola" type="text" id="nome" size="25" value="<?php echo $escola; ?>" /></label><br>
    <label >Responsavel:<input name="nome" type="text" id="email" size="25" value="<?php echo $usuid; ?>" /></label><br>
    <label >E-mail:<input name="email" type="text" id="email" size="25" /></label><br>
    <label >Tipo:<select id="tipo" name="tipo">
                <option value="Computadores">Computadores</option>
                <option value="Intragov">Intragov</option>
                <option value="Outros">Outros</option>
            </select></label><br>
    <label>Descrição:<textarea rows="4" cols="44" name="descricao"></textarea></label><br>
    <br><br><br><br><br>
    <input class="botao" type="submit" name="acao" value="Salvar"/>
    <input type="hidden" name="acao" value="inserir" />
    <input class="botao" type="reset" value="Limpar"/>
    <a href="../desktop.php"><input type="button" class="botao" name="voltar"value="Voltar" /></a>
    </fieldset>
</form>
</body>
<?php 
        
        if(isset($_POST['acao']) && $_POST['acao'] == "inserir"){
        
        // RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO
        $data = date('y-m-d');
        $hora = date('H:i');
        $tipo = $_POST['tipo'];
        $descricao = $_POST['descricao'];
        $escola = 1;//$_SESSION['escid'];
        $usuario = 1;//$_SESSION['id'];
        echo ($data.'/'.$hora.'/'.$escola.'/'.$usuario.'/'.$descricao.'/'.$tipo.'aberto');
        $query = mysql_query("INSERT INTO chamado (ch_dt_abri,esc_id,cli_id,ch_descri,ch_tipo,ch_status, ch_hr_abri)
                                            values ('$data','$escola','$usuario','$descricao','$tipo','aberto', '$hora')") or die(mysql_error());


        if (!$query){
            echo "Ocorreu um erro ao efetuar o cadastro contate o adminstrador do sistema";
            }
        else{
            echo "<script>alert('Cadastro realizado com sucesso!');window.history.go(-1)</script>";
            }
        }
/*}
else{
  echo ("Usuario: ".$usuario.", não possui acesso a esta area contate o Gerente!");
};*/
?>