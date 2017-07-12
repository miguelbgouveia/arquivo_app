<?php
	include ("config/config.php");
  include ("config/config2.php");

if($stmt = $mysqli->prepare('SELECT * FROM documentos')) {
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($numero,$ano,$numero_utilizador,$assunto,$data,$destinatario,$id_tipo_doc2,$codepartamento2,$ficheiro);
    $num_rows = $stmt->num_rows;

    if($num_rows>0) {
      while ($stmt->fetch()) {
        echo"$numero,$ano,$numero_utilizador,$assunto,$data,$destinatario,$id_tipo_doc2,$codepartamento2,$ficheiro<br>";
       $var1=null;
        $var2=date("Y/m/d");
        $stmt2 = $mysqli2->prepare("INSERT INTO documents VALUES (?,?,?,?,?,?,?,?,?,?,?)");
      	$stmt2->bind_param('issiisssiis',$numero,$var2,$var2,$ano,$numero_utilizador,$assunto,$data,$destinatario,$id_tipo_doc2,$codepartamento2,$ficheiro);
      	$stmt2->execute();
      	echo "$stmt2->affected_rows resgistos inseridos<br>";
		echo"$var1,$var1,$var2,$ano,$numero_utilizador,$assunto,$data,$destinatario,$id_tipo_doc2,$codepartamento2,$ficheiro";
      	$stmt2->close();
		echo"<br>.
<br>";

      }
    }
}


?>
