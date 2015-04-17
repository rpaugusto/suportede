<?php
/////////////////////////////////////
// Sistema de Registro de Chamados //
//   configurando base de dados    //
/////////////////////////////////////

// caminho para utilização
$Host= "localhost";   
$Usuario= "root" ;
$Senha= "root" ;

// caminho para utilização via web online
/*$Host="mysql.hostinger.com.br";
$usuario= "u328149552_cst";
$senha="cst9889";*/

// conectando com o banco
$conexao = mysql_connect($Host, $Usuario, $Senha) or
	die ("Falha na conexão com o banco de dados".mysql_errno());

//selecionando a base de dados
$banco = mysql_select_db('suporte',$conexao) or die("Falha na conexão com o banco de dados".mysql_errno());	



?>