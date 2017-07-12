<?php namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DataBaseController extends Controller
{
  public function getData_Base_Inser(){
  $mysqli = new mysqli("localhost", "root","","arquivodigital");
	$mysqli->set_charset('utf8');

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
    if($stmt = $mysqli->prepare('SELECT * FROM documentos')) {
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($numero,$ano,$numero_utilizador,$assunto,$data,$destinatario,$id_tipo_doc2,$codepartamento2,$ficheiro);
    $num_rows = $stmt->num_rows;

    if($num_rows>0) {
      while ($stmt->fetch()) {
        echo"$numero,$ano,$numero_utilizador,$assunto,$data,$destinatario,$id_tipo_doc2,$codepartamento2,$ficheiro<br>";
        DB::table('documents')->insert([
            ['year' => $ano,
             'id_user' => $numero_utilizador,
             'assunto' => $assunto,
             'data' => $data,
             'receiver' => $destinatario,
             'id_tipo_doc' => $id_tipo_doc2,
             'id_departamento' =>$codepartamento2,
             'file' => $ficheiro]
        ]);

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

        $ativo=2;
        $var2=date("Y/m/d");
        $password=bcrypt($password);
        echo"$id_utilizador,$departament,$nome_utilizador,$password,$email<br>";
        DB::table('users')->insert([
            ['name'=>$nome_utilizador,
            'email'=>$email,
            'password'=>$password,
            'id_department'=>$departament,
            'ativo'=>$ativo
            ]
        ]);

      }
    }
}

  }
}
