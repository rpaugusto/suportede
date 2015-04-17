<?php
//conectando com o banco de dados
include "frame/conf/config.php";

ob_start();
session_start();

$usuid=$_SESSION['usuario'];
$sql2 = mysql_query("UPDATE logado SET log_status=0 WHERE p_id='$id'") or die(mysql_error());

unset($_SESSION['usuid']);
unset($_SESSION['nivel']);
unset($_SESSION['usuario']);
unset($_SESSION['escola']);
session_destroy();

header("location: login.html");
?>