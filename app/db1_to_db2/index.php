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
      /*/  $var1=date("Y/m/d");
        $var2=date("Y/m/d");
        $stmt2 = $mysqli2->prepare("INSERT INTO documents VALUES (?,?,?,?,?,?,?,?,?,?,?)");
      	$stmt2->bind_param('issiisssiis',$var1,$var1,$var2,$ano,$numero_utilizador,$assunto,$data,$destinatario,$id_tipo_doc2,$codepartamento2,$ficheiro);
      	$stmt2->execute();
      	echo "$stmt2->affected_rows resgistos inseridos<br>";
      	$stmt2->close();*/

      }
    }
}
echo"<br>";
if($stmt = $mysqli->prepare('SELECT id_utilizador,departamento,nome_utilizador,password,email FROM utilizador')) {
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id_utilizador,$departament,$nome_utilizador,$password,$email);
    $num_rows = $stmt->num_rows;

    if($num_rows>0) {
      while ($stmt->fetch()) {

        $var1=date("Y/m/d");
        $var2=date("Y/m/d");
        $password=bcrypt($password);
        echo"$id_utilizador,$departament,$nome_utilizador,$password,$email<br>";
        $stmt2 = $mysqli2->prepare("INSERT INTO documents VALUES (?,?,?,?,?)");
      	$stmt2->bind_param('iisss',$var1,$departament,$nome_utilizador,$password,$email);
      	$stmt2->execute();
      	echo "$stmt2->affected_rows resgistos inseridos<br>";
      	$stmt2->close();

      }
    }
}
?>
