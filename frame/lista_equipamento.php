<?php
//recebendo dados de acesso ao bd
include "conf/config.php";
//recebendo informações da session
  session_start();
$nivel=$_SESSION['nivel'];
$usuario=$_SESSION['usuario'];

if ($nivel >= 5){
//carregando dados da listagem
$sql1 = mysql_query("SELECT e_marca AS marca,
                            e_tipo AS tipo,
                            e_modelo AS modelo,
                            e_serie AS serie,
                            e_patrimonio AS patrimonio
                           FROM equipamento
                           GROUP BY tipo") 
                           or die(mysql_error());
}
else{
//carregando dados do local
$id= $_SESSION['escid'] = 1;
//carregando dados da listagem
$sql1 = mysql_query("SELECT e_marca AS marca,
                            e_tipo AS tipo,
                            e_modelo AS modelo,
                            e_serie AS serie,
                            e_patrimonio AS patrimonio
                           FROM equipamento
                           WHERE esc_id = '$id'
                           GROUP BY tipo") 
                           or die(mysql_error());

}


?>
<html>
<meta charset="UTF-8">
<head>
    <title> Relatorio - Visualizando Equipamentos </title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.js"></script>
</head>
    <style type="text/css">
     
        /*Definido cor das linhas pares*/
        .full_table_list tr:nth-child(even) {background: #FFF}
         
        /*Definindo cor das Linhas impáres*/
        .full_table_list tr:nth-child(odd) {background: #EEE}      
                 
    </style>
<body>
<CENTER><a href="../desktop.php"><input type="button" class="botao" name="voltar"value="Voltar" /></a></CENTER>
<table>
    <tr>
        <td width="30"></td>
        <td width="30"><font size="1" face="verdana" ><center>MARCA</center></font></td>
        <td width="30"><font size="1" face="verdana" ><center>TIPO</center></font></td>
        <td width="30"><font size="1" face="verdana" ><center>MODELO</center></font></td>
        <td width="80"><font size="1" face="verdana" ><center>SERIE</center></font></td>
        <td width="80"><font size="1" face="verdana" ><center>PATRIMONIO</center></font></td>
    </tr>
    <tr>
<?php
    while($query1 = mysql_fetch_array($sql1)) {
?>
        <td align="center"><a href=""><img src="img/alterar.jpg" alt="Ação" width="15" height="16" border="0"></a></td>
        <td width="30"><font size="1" face="verdana" ><center><?php echo $query1['marca'] ?></center></font></td>
        <td width="70"><font size="1" face="verdana" ><center><?php echo $query1['tipo'] ?></center></font></td>
        <td width="70"><font size="1" face="verdana" ><center><?php echo $query1['modelo'] ?></center></font></td>
        <td width="80"><font size="1" face="verdana" ><center><?php echo $query1['serie'] ?></center></font></td>
        <td width="180"><font size="1" face="verdana" ><center><?php echo $query1['patrimonio'] ?></center></font></td>
<?php
    }
?>
    </tr>
</table >
</body>
</html>