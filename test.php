<?php
/////////////////////////////////////
// Sistema de Registro de Chamados //
//   configurando base de dados    //
/////////////////////////////////////

// caminho para utilização em localhost
$Host= "mysql.hostinger.com.br";   
$Usuario= "u328149552_cst" ;
$Senha= "cst9889" ;

// caminho para utilização via web online
//$Host="mysql.hostinger.com.br";
//$usuario= "u328149552_cst";
//$senha="cst9889";

// conectando com o banco
$conexao = mysql_connect($Host, $Usuario, $Senha) or
	die ("Falha na conexão com o banco de dados".mysql_errno());

//selecionando a base de dados
//localhost
	$banco = mysql_select_db('u328149552_cst',$conexao) or die("Falha na conexão com o banco de dados".mysql_errno());	

//on-line
//$banco = mysql_select_db('u328149552_cst',$conexao) or die("Falha na conexão com o banco de dados".mysql_errno());
 echo $banco;
 
?>