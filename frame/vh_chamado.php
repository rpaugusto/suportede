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

    $sql2 = mysql_query("SELECT ac_indice AS indice,
                                ac_data AS data,
                                ac_desc AS descricao,
                                ac_tipo AS status,
                                p_nome AS atendente
                          FROM acao
                          INNER JOIN pessoa ON pessoa.p_id = acao.p_id
                          WHERE ch_id = '$id'
                          order by indice")or die(mysql_error());;
    
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
        <td colspan="4" width="100%">
            <a href="desktop.php"><input type="button" class="botao" name="voltar"value="Voltar" /></a>
        </td>
    </tr>
    <tr>
        <td align="left" width="25%"><label >Chamado: </label><?php echo $query1['ticket']; ?></td>
        <td width="25%"><label >Tipo: </label><?php echo $query1['objeto']; ?></td>
        <td width="25%">  </td>
        <td width="25%"><label >Tipo: </label><?php echo $data; ?></td>
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
<h4>Ações adotadas: </h4>
<?php 
    $i=1;
    while($query2 = mysql_fetch_array($sql2))
    {
        $i = $query2['indice'] + $i;
?>
<table>
    <tr>
        <td width='10%'>
            <label>Ação:</label><?php echo  $i; ?>
        </td>
        <td width='20%'>
            <label>Data:</label><?php echo $query2['data']; ?>
        </td>
        <td coldspn="2" width='70%' align="left">
            <label>Foi <?php echo $query2['status']; ?> pelo <?php echo $query2['atendente']; ?> </label>
        </td>
    </tr>
    <tr>
        <td colspan="4" valign="top" align="left">
            <label>Realizado:</label><br>
            <?php echo $query2['descricao']; ?>
        </td>
    </tr>
</table>
<?php
    };
?>        
</body>
