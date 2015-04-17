<?php
//recebendo dados de acesso ao bd
include "conf/config.php";
//recebendo informações da session
  session_start();
$nivel=$_SESSION['nivel'];
$usuario=$_SESSION['usuario'];
$id= $_SESSION['id'];

//verificando a lista de chamados para o usuario
//carregando dados da listagem
if ($nivel >= 8){
$sql1 = mysql_query("SELECT chamado.ch_dt_abri AS abertd,
                            chamado.ch_hr_abri as aberth,
                            chamado.ch_id AS ticket,
                            chamado.ch_descri AS solicita,
                            chamado.ch_tipo AS objeto,
                            pessoa.p_nome AS nome,
                            escola.esc_nome AS escola,
                            chamado.ch_status as status
                           FROM chamado
                           INNER JOIN pessoa ON pessoa.p_id = chamado.cli_id
                           INNER JOIN escola ON escola.esc_id = chamado.esc_id") 
                           or die(mysql_error());
}else{
$sql1 = mysql_query("SELECT chamado.ch_dt_abri AS abertd,
                            chamado.ch_hr_abri as aberth,
                            chamado.ch_id AS ticket,
                            chamado.ch_descri AS solicita,
                            chamado.ch_tipo AS objeto,
                            pessoa.p_nome AS nome,
                            escola.esc_nome AS escola,
                            chamado.ch_status as status
                           FROM chamado
                           INNER JOIN pessoa ON pessoa.p_id = chamado.cli_id
                           INNER JOIN escola ON escola.esc_id = chamado.esc_id
                           WHERE chamado.cli_id = '$id'") 
                           or die(mysql_error());
}
?>
<html lang="pt-br">
<meta charset="UTF-8">

<head>
    <title> Relatorio - Visualizando Venda </title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.js"></script>
</head>

<body>

<div id="menu">
    <a href="novo_chamado.php"><img src="img/novo.png" ></a>
    <a href="lista_chamado.php"><img src="img/voltar.png" ></a>
</div>
 

<table border="0" align="center" width="690">
    <tr>
        <td width="20" colspan="3">&nbsp;</td>
        <td width="30"><font size="1" face="verdana" ><center>Ticket</center></font></td>
        <td width="70"><font size="1" face="verdana" ><center>Dt Abert.</center></font></td>
        <td width="70"><font size="1" face="verdana" ><center>Hr Abert.</center></font></td>
        <td width="80"><font size="1" face="verdana" ><center>Tipo</center></font></td>
        <td width="180"><font size="1" face="verdana" ><center>Solicitante</center></font></td>
        <td width="50"><font size="1" face="verdana" ><center>Status</center></font></td>
    </tr>
<?php
    while($query1 = mysql_fetch_array($sql1)) {
           
           if ($query1['status'] == 'aberto') {
?>
    <tr>
        <td align="center"><a href="#"><img src="img/excluir.jpg" alt="Excluir" width="15" height="16" border="0"></a></td>
        <td align="center"><a href="acao_chamado.php?id=<?php echo $query1['ticket'] ?>"><img src="img/alterar.jpg" alt="Ação" width="15" height="16" border="0"></a></td>
        <td align="center"><a href="vh_chamado.php?id=<?php echo $query1['ticket'] ?>"><img src="img/ver.jpg" alt="Visualizar" width="15" height="16" border="0"></a></td>
        <td><font color="green"><center><?php echo $query1['ticket'] ?></center></td>
        <td><font color="green"><center><?php echo $query1['abertd'] ?></center></td>
        <td><font color="green"><center><?php echo $query1['aberth'] ?></center></td>
        <td><font color="green"><center><?php echo $query1['objeto'] ?></center></td>
        <td><font color="green"><center><?php echo $query1['nome'] ?></a></center></td>
        <td><font color="green"><center><?php echo $query1['status'] ?></center></td>
    </tr>
<?php
          };
          if ($query1['status'] == 'atualizado') {
?>
    <tr>
        <td align="center"><a href="#"><img src="img/excluir.jpg" alt="Excluir" width="15" height="16" border="0"></a></td>
        <td align="center"><a href="acao_chamado.php?id=<?php echo $query1['ticket'] ?>"><img src="img/alterar.jpg" alt="Ação" width="15" height="16" border="0"></a></td>
        <td align="center"><a href="vh_chamado.php?id=<?php echo $query1['ticket'] ?>"><img src="img/ver.jpg" alt="Visualizar" width="15" height="16" border="0"></a></td>
        <td><font color="blue"><center><?php echo $query1['ticket'] ?></center></td>
        <td><font color="blue"><center><?php echo $query1['abertd'] ?></center></td>
        <td><font color="blue"><center><?php echo $query1['aberth'] ?></center></td>
        <td><font color="blue"><center><?php echo $query1['objeto'] ?></center></td>
        <td><font color="blue"><center><?php echo $query1['nome'] ?></a></center></td>
        <td><font color="blue"><center><?php echo $query1['status'] ?></center></td>
    </tr>
<?php
          };
          if ($query1['status'] == 'cancelado') {
?>
    <tr>
        <td align="center"><a href="#"><img src="img/excluir.jpg" alt="Excluir" width="15" height="16" border="0"></a></td>
        <td align="center"><a ><img src="img/alterar.jpg" alt="Ação" width="15" height="16" border="0"></a></td>
        <td align="center"><a href="vh_chamado.php?id=<?php echo $query1['ticket'] ?>"><img src="img/ver.jpg" alt="Visualizar" width="15" height="16" border="0"></a></td>
        <td><font color="red"><center><?php echo $query1['ticket'] ?></center></td>
        <td><font color="red"><center><?php echo $query1['abertd'] ?></center></td>
        <td><font color="red"><center><?php echo $query1['aberth'] ?></center></td>
        <td><font color="red"><center><?php echo $query1['objeto'] ?></center></td>
        <td><font color="red"><center><?php echo $query1['nome'] ?></a></center></td>
        <td><font color="red"><center><?php echo $query1['status'] ?></center></td>
    </tr>
<?php
          };
         if ($query1['status'] == 'fechado') {
?>
    <tr>
        <td align="center"><a href="#"><img src="img/excluir.jpg" alt="Excluir" width="15" height="16" border="0"></a></td>
        <td align="center"><a ><img src="img/alterar.jpg" alt="Ação" width="15" height="16" border="0"></a></td>
        <td align="center"><a href="vh_chamado.php?id=<?php echo $query1['ticket'] ?>"><img src="img/ver.jpg" alt="Visualizar" width="15" height="16" border="0"></a></td>
        <td><font color="#EE00EE"><center><?php echo $query1['ticket'] ?></center></td>
        <td><font color="#EE00EE"><center><?php echo $query1['abertd'] ?></center></td>
        <td><font color="#EE00EE"><center><?php echo $query1['aberth'] ?></center></td>
        <td><font color="#EE00EE"><center><?php echo $query1['objeto'] ?></center></td>
        <td><font color="#EE00EE"><center><?php echo $query1['nome'] ?></a></center></td>
        <td><font color="#EE00EE"><center><?php echo $query1['status'] ?></center></td>
    </tr>
<?php
          }
    };
?>
</table >
</body>