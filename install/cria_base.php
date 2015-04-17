<?php
     include "../config.php";

    mysql_connect($Host, $Usuario, $Senha);

//cria base//
    $sQuery = " CREATE DATABASE `helpdesk` ;";
    mysql_query($sQuery);
    
//cria tabela usuarios//  e insere um usuario inicial.
    mysql_select_db($Base);
    $sQuery_usuarios = "CREATE TABLE `clientes` (
  `p_id` int(4) NOT NULL AUTO_INCREMENT,
  `p_nome` varchar(60) NOT NULL,
  `p_email` varchar(60) NOT NULL,
  `p_sexo` varchar(3) NOT NULL,
  `p_telefone` varchar(13) DEFAULT NULL,
  `p_celular` varchar(15) DEFAULT NULL,
  `p_endereco` varchar(70) NOT NULL,
  `p_cidade` varchar(20) NOT NULL,
  `p_estado` varchar(2) NOT NULL,
  `p_bairro` varchar(20) DEFAULT NULL,
  `p_pais` varchar(20) DEFAULT NULL,
  `p_login` varchar(12) DEFAULT NULL,
  `p_senha` varchar(12) DEFAULT NULL,
  `p_rg` varchar(10) NOT NULL,
  `p_cpf` varchar(14) NOT NULL,
  `p_nivel` int(1) NOT NULL DEFAULT '1',
  UNIQUE KEY `p_id` (`p_id`)
) COMMENT='Cadastro de Usuários' ;";
    mysql_query($sQuery_usuarios);

    $sQuery_usuarios_insert ="INSERT INTO `clientes` (`p_id`,`p_nome`,`p_email`,`p_sexo`,`p_telefone`,`p_celular`,`p_endereco`,`p_cidade`,`p_estado`,`p_bairro`,`p_login`,`p_senha`,`p_rg`,`p_cpf`,`p_nivel`)
                              VALUES ('','Administrador do Sistema','adm@rpaugusto.com.br','M','(99)9999-9999','','','cidade','uf','bairro','admin','admin','','',9);";
    mysql_query($sQuery_usuarios_insert);
?>
<font face="verdana" size="2"><b>Tabela Usuários Criada com sucesso!</b><br>
Usuário Administrador inserido com sucesso!</font><p>
<?php
//cria tabela chamados//
    $sQuery_escolas = "CREATE TABLE `escolas` (
  `esc_id` int(11) NOT NULL AUTO_INCREMENT,
  `esc_nome` varchar(50) NOT NULL,
  `esc_endereco` varchar(50) NOT NULL,
  `esc_bairro` varchar(20) NOT NULL,
  `esc_cidade` varchar(40) NOT NULL,
  `esc_fone` varchar(14) NOT NULL,
  `esc_cie` int(11) NOT NULL,
  PRIMARY KEY (`esc_id`),
  UNIQUE KEY `esc_nome` (`esc_nome`,`esc_ciee`)
) COMMENT='Cadastro de Escolas' AUTO_INCREMENT=1 ;
";
    mysql_query($sQuery_escolas);
?>
<font face="verdana" size="2"><b>Tabela Escolas Criada com sucesso!</b></font><p>

<?php
//cria tabela chamados//
    $sQuery_chamados = "CREATE TABLE `chamados` (
`ch_id` int( 6 ) NOT NULL AUTO_INCREMENT ,
`ch_dt_abri` varchar( 8 ) NOT NULL default '',
`ch_dt_fecha` varchar( 8 ) NOT NULL default '',
`ch_hr_abri` varchar( 5 ) NOT NULL default '',
`ch_hr_fecha` varchar( 5 ) NOT NULL default '',
`esc_id` int NOT NULL ,
`cli_id` int NOT NULL ,
`descricao` text NOT NULL ,
`tipo` varchar( 25 ) NOT NULL default '',
`status` varchar( 12 ) NOT NULL default '',
PRIMARY KEY ( `ch_id` )
) COMMENT = 'Cadastro dos Chamados';";
    mysql_query($sQuery_chamados);
?>
<font face="verdana" size="2"><b>Tabela Chamados Criada com sucesso!</b></font><p>


<hr color="#000000" width="400" size="1" align="left"><p>
<p><b><font face="Verdana" size="2"><a href="install2.php">
<font color="#000000">..:: Prosseguir</font></a></font></b></p>
