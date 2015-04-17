<?php
    $date = date();
    $hora = date();
    include "config.php";
    
    $sQuery = "insert into chamados (data_abertura, hora_abertura, setor, descricao, tipo, nome, email)
                 values ($date,
                         $hora,
                         $_POST[setor],
                         $_POST[descricao],
                         $_POST[tipo],
                         $_POST[nome],
                         $_POST[email],
                         'aberto')";

   if (mysql_query($sQuery)) {
      echo "<script>window.location='lista_chamados.php'</script>";
   } else {
       echo "Problemas gravando chamado";
   }

   exit;
?>
