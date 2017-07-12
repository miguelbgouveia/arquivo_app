@extends('layouts.app_admin')
@section('content')
@include('includes.message-block')
<div class="row">
  <div class="col-md-2">
  </div>
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class='box-title'><i class='fa fa-book'></i><b> Lista de Utilizador </b></h4>
      </div>
      <div class="panel-body">
        <div class='row-fluid'>
          <div id="postBody"></div>
              <table id="example" class=' table-bordered table-striped' class="display" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th>ID Utilizador</th>
                  <th>Nome Utilizador</th>
                  <th>Departamento</th>
                  <th>Email</th>
                  <th>Ativo</th>
                  <th>Opções</th>
                </tr>
              </thead>
              <tbody>
                <form>
                  @foreach($user as $users)
                   <tr>
                      <td style='min-width: 50px; text-align: center;'>{{$users->id}}</td>
                      <td style='width: 80px;'>{{ $users->name}}</td>
                      <td>{{ $users->abbreviation}}</td>
                      <td>{{ $users->email}}</td>
                      @if($users->ativo==1)
                        <td>Ativo</td>
                      @else
                        <td>Desativo</td>
                      @endif
                      <td>
                      <a href='#' type='button'class='btn btn-info btn-xs' onclick="user_ver(this)" id="{{$users->id}}" ><span><i class='fa fa-eye' aria-hidden='true'></i></span></a>
                      <a href='#' type='button'class='btn btn-warning btn-xs'onclick="edit_user(this)" name="{{$users->id}}" data-toggle="modal" data-target="#ModalEdit"><span><i class='fa fa-pencil' aria-hidden='true'></i></span></a>
                      <a href="#" type='button'class='btn btn-danger btn-xs' onclick="user_apagar(this)" name="{{$users->id}}"><span><i class='fa fa-trash' aria-hidden='true'></i></span></a></td>
                   </tr>
                   <input  id="name_user{{$users->id}}" value="{{$users->name}}"  style="display: none">
                   <input  id="email_user{{$users->id}}" value="{{$users->email}}"  style="display: none">
                   <input  id="department_user{{$users->id}}" value="{{$users->id_department}}"  style="display: none">
                   <input  id="password_user{{$users->id}}" value="{{$users->password}}"  style="display: none">
                   <input  id="ativo_user{{$users->id}}" value="{{$users->ativo}}"  style="display: none">
                 @endforeach
               </form>
               </tbody>
            </table>
          </div>
          <div class=''>
            <a href='#' data-toggle="modal" data-target="#myModal"  class='btn btn-success date_doc'>
              <i class='fa fa-plus'></i> Novo Utilizador
            </a>
          </div>
        </div
          <!-- /.box-body -->
      </div>
    </div>
  </div>
  <div class="col-md-2">
  </div><!-- /.box -->
</div>


<!-- Modal Para Inserir-->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-arrow-circle-o-right'></i><b> Inserir Utilizador </b></h4>
      </div>
      <form class="form-group" action="{{route('admin_inser')}}" method="post">
        <div class="modal-body">
            <div class="form-group">
              <div class='form-group has-feedback'>
                <label>Utilizador:</label><br>
                <input type='text' class='form-control'  required='required' name='nome_user' placeholder='Utilizador: 'required='required'>
                <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
              </div>
              <div class='form-group has-feedback'>
                <label>Email:</label><br>
                <input type='email' class='form-control'  required='required' name='email_user' placeholder='Email: 'required='required'>
                <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
              </div>
              <div class='form-group has-feedback'>
                <label>Departamento:</label><br>
                <select name='departamento_user'  class='btn btn-default dropdown-toggle' required='required'  style='text-align:left!important; width:270px!important;'>
                  @foreach($dep as $deps)
                  <option value="{{$deps->id}}">{{ $deps->name}}</option>
                  @endforeach
                </select>
              </div>


               <div class='form-group has-feedback'>
                 <label>Palavra Passe:</label><br>
                 <input type='password' class='form-control'  required='required' name='password_user' placeholder='Palavra Passe:'required='required'>
                 <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
               </div>

               <div class='form-group has-feedback'>
                 <label>Confirmação:</label><br>
                 <input type='password' class='form-control' required='required' name ="password_new_user"placeholder='Palavra Passe:' required='required'>
                 <span class='glyphicon glyphicon-user form-control-feedback' ></span>
               </div>
        	    <br>
            </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="_user" value="" >
          <input type="hidden" name="_token"  value="{{ csrf_token() }}" >
          <button type="submit"class="btn btn-primary" ><i class="fa fa-check" aria-hidden="true"></i> Confirmar</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Para Editar-->
<div class="modal fade" id="ModalEdit" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-book'></i><b> Editar Utilizador </b></h4>
      </div>
      <form class="form-group" action="{{route('admin_edit')}}" method="post">
        <div class="modal-body">
            <div class="form-group">
              <div class='form-group has-feedback'>
                <label>Utilizador:</label><br>
                <input type='text' class='form-control'  required='required'id='nome_edi' name='nome_edi' placeholder='Utilizador: 'required='required'>
                <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
              </div>
              <div class='form-group has-feedback'>
                <label>Email:</label><br>
                <input type='email' class='form-control'  required='required'id='email_edi' name='email_edi' placeholder='Email: 'required='required'>
                <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
              </div>
              <div class='form-group has-feedback'>
                <label>Departamento:</label><br>
                <select name='departamento_edi'  class='btn btn-default dropdown-toggle' required='required' id="depart_edi" style='text-align:left!important; width:270px!important;'>
                  @foreach($dep as $deps)
                  <option value="{{$deps->id}}">{{ $deps->name}}</option>
                  @endforeach
                </select>
              </div>


               <div class='form-group has-feedback'>
                 <label>Palavra Passe:</label><br>
                 <input type='password' class='form-control' id='password_edi' name='password_edi' placeholder='Palavra Passe:'>
                 <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
               </div>

               <div class='form-group has-feedback'>
                 <label>Confirmação:</label><br>
                 <input type='password' class='form-control'  id="password_new_edi" name ="password_new_edi" placeholder='Palavra Passe:'>
                 <span class='glyphicon glyphicon-user form-control-feedback' ></span>
               </div>

               <div class='form-group has-feedback '>
                   <label>Estado da Conta:</label><br>
                     <input type="button" id="ativo_edi" onclick="user_BTN_ativo(this)"  class="btn btn-default" >
                     <input type="text" id="ativo_edi1"  name="ativo_edi1" class="btn btn-default" style="display: none">
                </div>
        	    <br>
            </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="_user_edi" id="_user_edi" value="" >
          <input type="hidden" name="_token"  value="{{ csrf_token() }}" >
          <button type="submit"class="btn btn-primary" ><i class="fa fa-check" aria-hidden="true"></i> Confirmar</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalVer" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-book'></i><b> Ver User </b></h4>
      </div>
      <form class="form-group" >
        <div class="modal-body">
            <div class="form-group">
              <div class='form-group has-feedback'>
                <label>Ver Utilizador:</label><br>
                <input type='text' class='form-control'  required='required'id='nome' name='nome' placeholder='Utilizador: 'required='required' disabled>
                <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
              </div>
              <div class='form-group has-feedback'>
                <label>Email:</label><br>
                <input type='email' class='form-control'  required='required'id='email' name='email' placeholder='Email: 'required='required' disabled>
                <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
              </div>
              <div class='form-group has-feedback'>
                <label>Departamento:</label><br>
                <select name='departamento_edi'  class='btn btn-default dropdown-toggle' required='required' id="depart" style='text-align:left!important; width:270px!important;' disabled>
                    @foreach($dep as $deps)
                    <option value="{{$deps->id}}">{{ $deps->name}}</option>
                    @endforeach
                </select>
              </div>


               <div class='form-group has-feedback'>
                 <label>Palavra Passe:</label><br>
                 <input type='password' class='form-control'  required='required'id='password' name='password' placeholder='Palavra Passe:'required='required' disabled>
                 <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
               </div>

               <div class='form-group has-feedback'>
                 <label>Confirmação:</label><br>
                 <input type='password' class='form-control' required='required' id="repassword" name ="password_new_edi"placeholder='Palavra Passe:' required='required'disabled>
                 <span class='glyphicon glyphicon-user form-control-feedback' ></span>
               </div>
               <div class='form-group has-feedback '>
                   <label>Estado da Conta:</label><br>
                   <input type="button" id="ativo"  class="btn btn-default" disabled>
                </div>
        	    <br>
            </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="_user" value="" >
          <input type="hidden" name="_token"  value="{{ csrf_token() }}" >
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>
        </div>
      </form>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="Apagar_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{route('apagar_user')}}" method="POST">
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Apagar Utilizador</h4>
        </div>
        <div class="modal-body">
          <h4>Tem a certesa que quer apagar este Utilizador??? </h4><br>
          <ul>
            <li>
              Todos os documentos criados por este utilizador irão ser apagados.
            </li>
          </ul>
          <input  id="apagar_user" name="apaga_user"  style="display: none">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          <input type="hidden" name="_token"  value="{{ csrf_token() }}" >
          <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Apagar</button>
        </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script  type="text/javascript">
  var token = '{{Session::token()}}';
  var name;
  var email;
  var password;
  var repassword;
  var depart;
  var ativo;
  var id_user_edi;
 function user_ver(elem) {
        event.preventDefault();
        $("#ModalVer").modal();
        name =document.getElementById('name_user'+elem.id).value
        email=document.getElementById('email_user'+elem.id).value
        depart=document.getElementById('department_user'+elem.id).value
        ativo=document.getElementById('ativo_user'+elem.id).value

        document.getElementById('nome').value=name;
        document.getElementById('email').value=email;
        document.getElementById('depart').value=depart;
        document.getElementById('password').value="Fakepassword";
        document.getElementById('repassword').value="Fakepassword";
        console.log('ativo:'+ativo);
        var var1;
        if(ativo==1){
            var1="Ativo";
            console.log('ativo');
        }else if(ativo==0){
             var1="Desativo";
            console.log('desativo');
        }
        console.log('ativo:'+var1);
        document.getElementById('ativo').value=var1;

  }
  function user_apagar(vari) {
       event.preventDefault();
       $("#Apagar_modal").modal();
       console.log(vari.name);
       document.getElementById('apagar_user').value=vari.name;
  }

  function user_BTN_ativo(vari) {
      event.preventDefault();
      if(vari.value=="Ativo"){
        document.getElementById('ativo_edi1').value="Desativo";
        document.getElementById('ativo_edi').value="Desativo";
      }else if(vari.value=="Desativo"){
        document.getElementById('ativo_edi').value="Ativo";
        document.getElementById('ativo_edi1').value="Ativo";
      }
  }

  function edit_user(elem) {
         event.preventDefault();
         $("#ModelEdit").modal();
         ativo=document.getElementById('ativo_user'+elem.name).value
         name =document.getElementById('name_user'+elem.name).value
         email=document.getElementById('email_user'+elem.name).value
         depart=document.getElementById('department_user'+elem.name).value
         id_user_edi =elem.name;

         document.getElementById('nome_edi').value=name;
         document.getElementById('email_edi').value=email;
         document.getElementById('depart_edi').value=depart;
         document.getElementById('_user_edi').value=id_user_edi;
         console.log('ativo:'+ativo);
         var var1;
         if(ativo==1){
             var1="Ativo";
             console.log('ativo');
         }else if(ativo==0){
              var1="Desativo";
             console.log('desativo');
         }
         document.getElementById('ativo_edi').value=var1
         document.getElementById('ativo_edi1').value=var1;
   }

</script>
@stop
