<?php
//recebendo dados de acesso ao bd
include "conf/config.php";
//recebendo informações da session
  session_start();
$nivel=$_SESSION['nivel'];
$usuario=$_SESSION['usuario'];

if ($nivel >= 8){
//carregando dados da listagem
$sql1 = mysql_query("SELECT pessoa.p_nome AS nome,
                            pessoa.p_id AS id,
                            pessoa.p_email AS email,
                            pessoa.p_telefone AS telefone,
                            escola.esc_nome AS escnome,
                            logado.log_status as st
                            FROM pessoa
                 INNER JOIN escola ON escola.esc_id = pessoa.esc_id
                 INNER JOIN logado on logado.p_id = pessoa.p_id
                    GROUP by escnome, nome
                    order by nome") 
                           or die(mysql_error());
}else{
//carregando dados do local
$id= $_SESSION['escid'] = 1;
//carregando dados da listagem
$sql1 = mysql_query("SELECT pessoa.p_nome AS nome,
                            pessoa.p_id AS id,
                            pessoa.p_email AS email,
                            pessoa.p_telefone AS telefone,
                            escola.esc_nome AS escnome,
                            logado.log_status as st
                            FROM pessoa
                 INNER JOIN escola ON escola.esc_id = pessoa.esc_id
                 INNER JOIN logado on logado.p_id = pessoa.p_id
                      WHERE pessoa.p_id > 1
                   GROUP by escnome, nome
                    order by nome") 
                           or die(mysql_error());

}

$sql2 = mysql_query("select * from logado where ")

?>
<html>
<meta charset="UTF-8">
<head>
    <title> Relatorio - Visualizando Equipamentos </title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.js"></script>
</head>
    
<body>
<div id="menu">
<?php if ($nivel >= 8){ ?>
    <a href="cad_usuario.php"><img src="img/novo.png" ></a>
    <a href="lista_usuario.php"><img src="img/voltar.png" ></a>
<?php } else { ?>
    <a href="lista_usuario.php"><img src="img/voltar.png" ></a>
<?php } ?>
</div>
<table>
    <tr>
        <td width="30"></td>
        <td width="30"><font size="1" face="verdana" ><center>Codigo</center></font></td>
        <td width="100"><font size="1" face="verdana" ><center>Nome</center></font></td>
        <td width="100"><font size="1" face="verdana" ><center>Escola</center></font></td>
        <td width="108"><font size="1" face="verdana" ><center>e-mail</center></font></td>
        <td width="80"><font size="1" face="verdana" ><center>Telefone Pessoal</center></font></td>
        <td width="30"><font size="1" face="verdana" ><center>On-Line</center></font></td>
    </tr>
    
<?php
    while($query1 = mysql_fetch_array($sql1)) {
        echo '<tr>';
        if ($nivel < 8){
            echo '<td align="center"><a href="alt_senha.php"><img src="img/alt_senha.png" alt="Ação" width="15" height="15" border="0"></a></td>';
        }else{
            echo '<td align="center"><a href="alt_usuario.php"><img src="img/alterar.jpg" alt="Ação" width="15" height="15" border="0"></a></td>';
        }
?>
        <td width="30"><font size="1" face="verdana" ><center><?php echo $query1['id'] ?></center></font></td>
        <td width="100"><font size="1" face="verdana" ><center><?php echo $query1['nome'] ?></center></font></td>
        <td width="100"><font size="1" face="verdana" ><center><?php echo $query1['escnome'] ?></center></font></td>
        <td width="108"><font size="1" face="verdana" ><center><?php echo $query1['email'] ?></center></font></td>
        <td width="80"><font size="1" face="verdana" ><center><?php echo $query1['telefone'] ?></center></font></td>
<?php 
    $idu = $query1['id'];
    $sql3 = mysql_query("select log_status as st from logado where p_id ='$idu' ");
    $query3 = mysql_fetch_array($sql3) or die(mysql_error());
    $st = $query3['st'];
    if ($st == 1) {
?>
        <td align="center"><img src="img/l_verde.jpg" alt="Ação" width="15" height="16" border="0"></td>
<?php
    }
    if ($st == 0){
?>
        <td align="center"><img src="img/l_vermelha.jpg" alt="Ação" width="15" height="16" border="0"></td>
<?php
    }
    echo '</tr>';
    }
?>
    </tr>
</table >
</body>
</html>