<?php
//recebendo dados de acesso ao bd
include "conf/config.php";
  session_start();
//recuperando dados do usuario logado
$nivel=$_SESSION['nivel'];
$usuid=$_SESSION['usuario'];
$escola=$_SESSION['escola'];

    //recuperando informação do chamado
    $id = $_GET['id'];
    $sql1 = mysql_query("SELECT chamado.ch_dt_abri AS abertura,
                                  chamado.ch_id AS ticket,
                                  chamado.ch_descri AS solicita,
                                  chamado.ch_tipo AS objeto,
                                  pessoa.p_nome AS nome,
                                  escola.esc_nome AS escola
                           FROM chamado
                           INNER JOIN pessoa ON pessoa.p_id = chamado.cli_id
                           INNER JOIN escola ON escola.esc_id = chamado.esc_id
                           WHERE chamado.ch_id = '$id'") 
                           or die(mysql_error());
    $query1 = mysql_fetch_array($sql1);

    $descricao = $query1['solicita'];
    //quebrando as linhas
    $NEWCHAMADO = strtoupper(wordwrap($descricao, 44, "\n", true));
    $data=date('d/m/y');

?>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <title> Cadastro de Funcionarios/Usuarios </title>
    <link rel="stylesheet" type="text/css" href="css/estilo_acao.css"/>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.js"></script>
</head>

<body>
<table>
    <tr>
        <td align="left" width="25%"><label >Chamado: </label><?php echo $query1['ticket']; ?></td>
        <td width="25%"><label >Tipo: </label><?php echo $query1['objeto']; ?></td>
        <td width="25%">  </td>
        <td width="25%"><label >Tipo: </label><?php echo $query1['abertura']; ?></td>
    </tr>
    <tr>
        <td align="left" colspan="4"><label>Escola:  </label><?php echo $query1['escola']; ?></td>
    </tr>
    <tr>
        <td align="left" colspan="4"><label>Responsavel: </label><?php echo $query1['nome']; ?></td>
    </tr>
    <tr>
        <td colspan="4" width="100%" height="90" height-max="100" valign="top" align="left">
            <label>Descrição:</label>
            <br><?php echo $NEWCHAMADO; ?>
        </td>
    </tr>
</table>
   <hr>
<form method="post" action="">
    <table>
        <tr>
            <td width="25%">
                <?php echo $data ?>
            </td>
            <td width="25%">
                <input name="radiobutton" type="radio" value="atualizado" checked="checked" />Atualizar<br>            
            </td>
            <td width="25%">
                <input name="radiobutton" type="radio" value="fechado" />Fechar<br>
            </td>
            <td width="25%">
                <input name="radiobutton" type="radio" value="cancelado" />Cancelar<br>
            </td>
        </tr>
        <tr>
            <td colspan="4" width="100%">
                <textarea rows="4" cols="90" name="descricao"></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="4" width="100%">
                <input class="botao" type="submit" name="acao" value="Salvar"/>
                <input type="hidden" name="acao" value="inserir" />
                <input class="botao" type="reset" value="Limpar"/>
                <input type="hidden" name="chamado" value="<?php echo $query1['ticket']; ?>" />
                <a href="../desktop.php"><input type="button" class="botao" name="voltar"value="Voltar" /></a>            
            </td>
        </tr>
    </table>
</form>
    
    
        
</body>
<?php 
        
        if(isset($_POST['acao']) && $_POST['acao'] == "inserir"){
        
        //checando numero de ações do chamado
        $chamado = $_POST['chamado'];
        $sql2 = mysql_query("SELECT max(acao.ac_indice) as i, chamado.ch_id
                             FROM chamado
                             left join acao on acao.ch_id = chamado.ch_id
                             where chamado.ch_id = '$chamado'
                             group by chamado.ch_id");
        $query2 = mysql_fetch_array($sql2) or die(mysql_error());
        $i = $query2['i'];
        
        // RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO
        $nacao = ++$i;
        $data = date('y-m-d');
        $tipo = $_POST['radiobutton'];
        $descricao = $_POST['descricao'];
        $usuario = $usuid;

       
        //echo ($data.','.$descricao.','.$tipo.','.$nacao.','.$usuario.','.$chamado);
        $sql3 = mysql_query("INSERT INTO acao (ac_data,ac_desc,ac_tipo,ac_indice,p_id,ch_id)
                            values ('$data','$descricao','$tipo','$nacao','$usuario','$chamado')
                            ") or die(mysql_error());
        $sql4 = mysql_query("UPDATE chamado SET ch_status='$tipo' WHERE ch_id='$chamado'") or die(mysql_error());


        if (!$sql3){
            echo "Ocorreu um erro ao efetuar o cadastro contate o adminstrador do sistema";
            }
        else{
            echo ("<script>alert('Cadastro realizado com sucesso!');window.history.go(../desktop.php)</script>");                
            }
        }
?>