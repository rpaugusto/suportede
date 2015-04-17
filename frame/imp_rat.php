<?php
//recebendo dados de acesso ao bd
include "conf/config.php";
//recebendo informações da session
  session_start();
$nivel=$_SESSION['nivel'];
$tecnico=$_SESSION['usuario'];

$id= $_SESSION['id'] = 1;

//carregando dados da rat
$sql1=mysql_query('SELECT pessoa.p_nome AS solicitante,
						  chamado.ch_id AS ticket,
						  chamado.ch_dt_abri AS abertura,
						  escola.esc_nome AS escola,
						  escola.esc_endereco AS endereco,
						  escola.esc_cidade AS cidade,
						  escola.esc_fone as telefone,
						  chamado.ch_descri as descricao
					 FROM chamado
			   INNER JOIN pessoa ON pessoa.p_id = chamado.cli_id
			   INNER JOIN escola ON escola.esc_id = chamado.esc_id
			   		WHERE chamado.ch_id = 1');
$query1=mysql_fetch_array($sql1)or die(mysql_error());

$sql2=mysql_query("SELECT ac_data AS fecha,
						  ac_desc AS solucao
					 FROM acao
					WHERE ch_id =1 and ac_tipo = 'fechado'");
$query2=mysql_fetch_array($sql2)or die(mysql_error());


$ESCOLA = $query1['escola'];
$PESSOA = $query1['solicitante'];
$endereco = $query1['endereco'];
$CIDAD1 = $query1['cidade'];
$TELEF = $query1['telefone'];
$PEDIDO = $query1['descricao'];
$DAT1 = $query1['abertura'];
$DAT2 = $query2['fecha']= 01;
$RESOLVE = $query2['solucao']= 01;

//quebrando as linhas
$NEWPEDIDO = strtoupper(wordwrap($PEDIDO, 20, "\n", true));
$NEWRESOLVE = strtoupper(wordwrap($RESOLVE, 20, "\n", true));


?>
<html lang="EN-US">
	<head>
		<title>Centro de Técnologia - Relatorio de Atendimento Técnico</title>
		<meta charset="UTF-8" />
	</head>
<body>
<table width="900" border="1" cellspacing="0" cellpadding="2" align="center">
			<thead></thead>
			<tr>
			<th colspan="4">
				<center><font size="18px"><b>RELATORIO DE ATENDIMENTO TÉCNICO</b></font></center>
				<br>
				<br><p align="center"><font size="6"> DIRETORIA DE ENSINO DE TUPÃ - SP </font></p>
				<br>
				</th>
			</tr>
			<tr>
			<td colspan="4" align="center"><b>Dados do Local:</b></td>
			</tr>
			<tr>
			<td colspan="4"><p><b>Unidade Escolar:</b></p><p><?php echo $ESCOLA; ?></p></td>
			</tr>
			<tr>
			<td colspan="4"><p><b>Endereço:</b></p><p><?php echo $endereco; ?></p></td>
			</tr>
			<tr>
			<td colspan="2"><p><b>Cidade:</b></p><p><?php echo $CIDAD1; ?></p></td>
			<td colspan="2"><p><b>Telefone:</b></p><p><?php echo $TELEF; ?></p></td>
			</tr>
			<tr>
			<td colspan="4" align="center"><b>Dados do Atendimento:</b></td>
			</tr>
			<tr>
			<td colspan="4"><p><b>Solicitante:</b></p><p><?php echo $PESSOA; ?></p></td>
			</tr>
			<tr>
			<td><p><b>Data de Abertura:</b></p><p><?php echo $DAT1; ?></p></td>
			<td><p><b>Hora da Abertura:</b></p><p><?php echo $HORINI; ?></p></td>
			<td><p><b>Data do Atendimento:</b></p><p><?php echo $HORFIN; ?></p></td>
			<td><p><b>Hora do Atendimento:</b></p><p><?php echo $DAT2; ?></p></td>
			</tr>
			<tr>
			<td colspan="4"><b>Serviço Solicitado:</b></td>
			</tr>
			<tr>
			<td colspan="4" height="90" height-max="100" valign="top"><?php echo $NEWPEDIDO; ?></td>
			</tr>
			<tr>
			<td colspan="4"><b>Serviço Realizado:</b></td>
			</tr>
			<tr>
			<td colspan="4" height="190" height-max="200" valign="top"><?php echo $NEWRESOLVE; ?></td>
			</tr>
			<tr>
			<td height-max="60"  width-max="440" tex-aling="center" colspan="2">
				<label><b>Assinatura Técnico:</b></label>
				<p align="center"><?php echo $tecnico; ?></p>
				<p align="center">_______________________________</p>
				<p align="center">_____/______/______</p>
			</td>
			<td height-max="60" width-max="440" text-aling="center" colspan="2">
				<label><b>Assinatura Solicitante:</b></label>
				<p align="center"><?php echo $PESSOA; ?></p>
				<p align="center">_______________________________</p>
				<p align="center">_____/______/______</p>
			</td>
			</tr>
		</table>
	<p align="center"><a href="javascript:window.print()"><<---Imprimir essa Página--->></a>