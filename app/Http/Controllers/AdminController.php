<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{

      /**
       * Create a new controller instance.
       *
       * @return void
       */
      public function __construct()
      {
          $this->middleware('auth:admin');
      }

      /**
       * Show the application dashboard.
       *
       * @return \Illuminate\Http\Response
       */
      public function index(){
        return view('admin');
      }

      public function getAdminMenu(){
        return view('admin');
      }

        public function postUser_Inser(Request $request){
              $this->validate($request,[
                'nome_user' => 'required',
                'email_user' => 'required',
                'password_user' => 'required',
                'password_new_user' => 'required',
                'departamento_user' => 'required'
              ]);

              $name = $request["nome_user"];
              $email = $request["email_user"];
              $password = $request["password_user"];
              $repassword = $request["password_new_user"];
              $ativo ="0";
              $id_departamento =$request["departamento_user"];
              if($password==$repassword){
                $password=bcrypt($password);
                DB::table('users')->insert([
                    ['name'=>$name,
                    'email'=>$email,
                    'password'=>$password,
                    'id_department'=>$id_departamento,
                    'ativo'=>$ativo
                    ]
                ]);

                return redirect()->route('user_table')->with(['message'=>'O User foi Inserido com sucesso!']);
              }else{
                return redirect()->route('user_table')->with(['error'=>'As Passwords eram diferentes!']);
              }
          }
          public function postAdmin_Depart_Insert(Request $request){

              $this->validate($request,[
                'nome_depart' => 'required',
                'abrevia_depart' => 'required',
              ]);

              $name_depart = $request["nome_depart"];
              $abreviatura_ = $request["abrevia_depart"];

                DB::table('departments')->insert([
                    ['abbreviation'=>  $abreviatura_,
                    'name'=>  $name_depart
                    ]
                ]);

                return redirect()->route('user.depart')->with(['message'=>'O Departamento foi inserido com sucesso!']);

          }
          public function postAdmin_Type_Doc_Insert(Request $request){

              $this->validate($request,[
                'type_doc_inser' => 'required',
              ]);

              $type_doc_inser = $request["type_doc_inser"];

                DB::table('type_docs')->insert([
                    ['type'=>$type_doc_inser]
                ]);
                return redirect()->route('type.doc.table')->with(['message'=>'O Tipo de documento foi inserido com sucesso!']);

          }
          public function postApagar_Type_doc(Request $request){
            $id_type_doc=$request["apagar_type_doc"];
            DB::table('type_docs')->where('id', '=',   $id_type_doc)->delete();
            DB::table('documents')->where('id_tipo_doc', '=',$id_type_doc)->delete();
            return redirect()->route('type.doc.table')->with(['message'=>' O Departamento foi Apagado com sucesso!']);
          }
      public function postApagar_User(Request $request){
        $id_users_ap=$request["apaga_user"];
        DB::table('users')->where('id', '=',$id_users_ap)->delete();

        return redirect()->route('user_table')->with(['message'=>' O User foi Apagado com sucesso!']);
      }
      public function postApagar_depart(Request $request){
        $id_department_ap=$request["apaga_depart"];
        DB::table('departments')->where('id', '=',  $id_department_ap)->delete();
        DB::table('users')->where('id_department', '=',$id_department_ap)->delete();
        DB::table('documents')->where('id_departamento', '=',$id_department_ap)->delete();
        return redirect()->route('user.depart')->with(['message'=>' O Departamento foi Apagado com sucesso!']);
      }
      public function getUser_table(){
        $user=DB::table('users')
              ->join('departments', 'departments.id', '=', 'users.id_department')
              ->select('users.*',  'departments.abbreviation')
              ->get();
        $dep=DB::table('departments')
              ->select('departments.*')
              ->get();
        return view('user_table',['user'=>$user],['dep'=>$dep]);
      }
      public function getUser_Depart(){
        $depart=DB::table('departments')
              ->select('departments.*')
              ->get();
        return view('depart_table',['depart'=>$depart]);
      }
      public function getType_Doc(){
        $type_doc=DB::table('type_docs')
              ->select('type_docs.*')
              ->get();
        return view('type_doc_table',['type_doc'=>$type_doc]);
      }

      public function postAdmin_Edit(Request $request){
        //Validation
      //  console.log('pedro');
      $password_edi = null;
      $repassword_edi = null;
      $this->validate($request,[
        'nome_edi' => 'required',
        'email_edi' => 'required',
        'departamento_edi' => 'required',
        'ativo_edi1' => 'required',
        '_user_edi'=> 'required'
      ]);

          $nome_edi = $request['nome_edi'];
          $email_edi = $request["email_edi"];
          $depart_edi = $request["departamento_edi"];
          $ativo_edi = $request["ativo_edi1"];
          $id_user_edi =$request["_user_edi"];

          if($request["password_edi"]!=null){
            $password_edi = $request["password_edi"];
            $repassword_edi = $request["password_new_edi"];
          }
          if($password_edi==$repassword_edi){
            if($ativo_edi=="Ativo"){
              $ativo_edi=1;
            }else{
              $ativo_edi=2;
            }
              if($password_edi!=null){
                  $password_edi=bcrypt($password_edi);
                DB::table('users')
                ->where('id',$id_user_edi)
                ->update([
                 'name' => $nome_edi,
                 'email' => $email_edi,
                 'password' => $password_edi,
                 'id_department' => $depart_edi ,
                 'ativo' =>   $ativo_edi]);
              }else{
                DB::table('users')
                ->where('id',$id_user_edi)
                ->update([
                 'name' => $nome_edi,
                 'email' => $email_edi,
                 'id_department' => $depart_edi ,
                 'ativo' =>   $ativo_edi]);
              }
               return redirect()->route('user_table')->with(['message'=>'As informações dos utilizadores foram alterado com sucesso!']);
        }else{
              return redirect()->route('user_table')->with(['error'=>'As Passwords eram diferentes!']);
        }
      }
      public function postAdmin_Depart_Edit(Request $request){
        $this->validate($request,[
          'id_depart' => 'required',
          'edi_nome_depart' => 'required',
          'edi_abrevia_depart' => 'required',
        ]);
        $id_depart = $request["id_depart"];
        $abreviatura_ = $request["edi_abrevia_depart"];
        $name_depart= $request["edi_nome_depart"];


        DB::table('departments')
        ->where('id',  $id_depart)
        ->update([
        'abbreviation' =>$abreviatura_,
         'name' => $name_depart
       ]);
        return redirect()->route('user.depart')->with(['message'=>'As informações dos departamento foram alterado com sucesso!']);

      }
      public function postAdmin_Type_Doc_Edit(Request $request){
        $this->validate($request,[
          'type_doc_edit' => 'required',
          'id_type_doc' => 'required'
        ]);

        $type_doc_edi = $request["type_doc_edit"];
        $id_type_doc =$request["id_type_doc"];

        DB::table('type_docs')
        ->where('id',    $id_type_doc)
        ->update(['type' =>  $type_doc_edi]);
        return redirect()->route('type.doc.table')->with(['message'=>'As informações do Tipo de documento foram alterado com sucesso!']);

      }

}
