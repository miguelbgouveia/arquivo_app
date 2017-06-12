<?php

namespace App\Http\Controllers;
use DB;
use App\Quotation;
use illuminate\Http\Request;
use illuminate\Http\Response;
use App\User;
use App\Document;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function getlogout(){
      Auth::logout();
      return redirect()->route('login');
    }
    public function getDashboard(){
      $doc=DB::table('documents')
            ->join('users', 'users.id', '=', 'documents.id_user')
            ->join('type_docs', 'type_docs.id', '=', 'documents.id_tipo_doc')
            ->join('departments', 'departments.id', '=', 'documents.id_departamento')
            ->select('documents.*', 'type_docs.type', 'users.name','departments.abbreviation')
            ->get();
      $user=DB::table('users')
      ->select('users.*')
      ->get();

            //$doc = Document::all();
      return view('dashboard',['doc'=>$doc],['user'=>$user]);
    }
    public function getLogin(){

      return redirect()->route('login');
    }
    public function postInsert(Request $request){
      //Validation
    //  console.log('pedro');
    $year=date("Y");
      $this->validate($request,[
        'utilizador' => 'required',
        'assunto' => 'required',
        'data' => 'required',
        'dest' => 'required',
        'type_doc' => 'required',
        'departamento' => 'required'
      ]);

      $id_user = $request["utilizador"];
      $assunto = $request["assunto"];
      $data = $request["data"];
      $receiver = $request["dest"];
      $id_tipo_doc = $request["type_doc"];
      $id_departamento =$request["departamento"];
      $file = 'documento.PDF';
      DB::table('documents')->insert([
          ['year' => $year,
           'id_user' => $id_user,
           'assunto' => $assunto,
           'data' => $data,
           'receiver' => $receiver,
           'id_tipo_doc' => $id_tipo_doc ,
           'id_departamento' => $id_departamento,
           'file' => $file]
      ]);
      return redirect()->route('dashboard')->with(['message'=>'O campo foi Inserido com sucesso!']);;
    }
    public function getDeleteDoc($doc_id){
      DB::table('documents')->where('id', '=', $doc_id)->delete();

      return redirect()->route('dashboard')->with(['message'=>'O campo foi apagada com sucesso!']);
    }
    public function postEditDoc(Request $request){
      //Validation
    //  console.log('pedro');
    $this->validate($request,[
      'utilizador_edi' => 'required',
      'assunto_edi' => 'required',
      'date_edi' => 'required',
      'dest_edi' => 'required',
      'type_doc_edi' => 'required',
      'departamento_edi' => 'required',
      'id'=> 'required'
    ]);
    $year=date("Y");
    $id = $request['id'];
    $id_user = $request["utilizador_edi"];
    $assunto = $request["assunto_edi"];
    $data = $request["date_edi"];
    $receiver = $request["dest_edi"];
    $id_tipo_doc = $request["type_doc_edi"];
    $id_departamento =$request["departamento_edi"];
    $file = 'documento.PDF';

      DB::table('documents')
            ->where('id', $id)
            ->update(['year' => $year,
             'id_user' => $id_user,
             'assunto' => $assunto,
             'data' => $data,
             'receiver' => $receiver,
             'id_tipo_doc' => $id_tipo_doc ,
             'id_departamento' => $id_departamento,
             'file' => $file]);
      return redirect()->route('dashboard')->with(['message'=>'O campo foi editada com sucesso!']);
    }

}
