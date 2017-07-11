@extends('layouts.app')
@section('content')
@include('includes.message-block')
<div class="row">
  <div class="col-md-2">
  </div>
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class='box-title'><i class='fa fa-book'></i><b> Lista de Documentos </b></h4>
      </div>
      <div class="panel-body">
        <div class='row-fluid'>
          <div id="postBody"></div>
              <table id="example" class=' table-bordered table-striped' class="display" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>N.º</th>
                    <th>DATA</th>
                    <th>TIPO DOC.</th>
                    <th>ASSUNTO</th>
                    <th>DESTINATÁRIO</th>
                    <th>DEP.</th>
                    <th>UTILIZADOR</th>
                    <th>OPÇÕES</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($doc as $docs)
                   <tr>
                    <td style='min-width: 50px; text-align: center;'>{{$docs->id}} </td>
                    <td style='width: 80px;'>{{$docs->data}}</td>
                    <td>{{$docs->type}}</td>
                    <td>{{$docs->assunto}}</td>
                    <td>{{$docs->receiver}}</td>
                    <td style='min-width: 55px;'>{{$docs->abbreviation}}</td>
                    <td>{{$docs->name}}</td>
                    <td>
                    <a href='#'  type='button'class='btn btn-info btn-xs modelVer' onclick="myFunction(this)" id="{{$docs->id}}" ><span><i class='fa fa-eye' aria-hidden='true'></i></span></a>
                    <a href='#' type='button'class='btn btn-warning btn-xs modelEdit'onclick="edit_func(this)" name="{{$docs->id}}" data-toggle="modal" data-target="#ModalEdit"><span><i class='fa fa-pencil' aria-hidden='true'></i></span></a>
                    <a href="#" type='button' class='btn btn-danger btn-xs' onclick="apagar(this)" name="{{$docs->id}}"><span><i class='fa fa-trash' aria-hidden='true'></i></span></a></td>
                   </tr>

                   <input type="text" id="id_doc" value="{{$docs->id}}"  style="display: none">
                   <input type="text" id="data_doc{{$docs->id}}" value="{{$docs->data}}"  style="display: none">
                   <input type="text" id="type_doc_1{{$docs->id}}" value="{{$docs->id_tipo_doc}}"  style="display: none">
                   <input type="text" id="assunto_doc{{$docs->id}}"  value="{{$docs->assunto}}"  style="display: none">
                   <input type="text" id="receiver_doc{{$docs->id}}"  value="{{$docs->receiver}}"  style="display: none">
                   <input type="text" id="abbreviation_doc{{$docs->id}}"  value="{{$docs->id_departamento}}"  style="display: none">
                   <input type="text" id="user_doc{{$docs->id}}"  value="{{$docs->id_user}}"  style="display: none">

                 @endforeach
               </tbody>
            </table>
          </div>
          <div class=''>
            <a href='#' data-toggle="modal" data-target="#myModal"  class='btn btn-success date_doc'>
              <i class='fa fa-plus'></i> Novo Documento
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
        <h4 class="modal-title"><i class='fa fa-book'></i><b> Inserir Documento </b></h4>
      </div>
      <form class="form-group" action="{{route('insert')}}" method="post">
        <div class="modal-body">
            <div class="form-group">
              <div class='form-group has-feedback'>
                <label>Utilizador:</label><br>
                <select name='utilizador' class='btn btn-default dropdown-toggle' value="{{ Auth::user()->id }}"  style='text-align:left!important;' required>
                    @foreach($user as $users)
                      <option value="{{$users->id}}">{{$users->name}}</option>
                    @endforeach
                </select>
              </div>
              <div class='form-group has-feedback'>
                <label>Departamento:</label><br>
                <select name='departamento'  class='btn btn-default dropdown-toggle' required='required' id="depart"  style='text-align:left!important; width:270px!important;' required>
    		            <option selected disabled value="">-Selecione o Departamento -</option>";
                    <option value="1">Diretor de Serviços</option>
                    <option value="2">Divisão de Apoio à Educação Artística</option>
                    <option value="3">Divisão de Expressões Artísticas</option>
                    <option value="4">Divisão de Investigação e Multimédia</option>
                    <option value="5">Secção Administrativa</option>
                    <option value="6">Sistema de Gestão</option>
                    <option value="7">Área de Informática</option>
                    <option value="8">Produção</option>
                    <option value="9">Comunicação, Imagem e Vídeo</option>
                    <option value="10">Equipa de Animação</option>
                    <option value="11">Centro Multimédia</option>
                </select>
              </div>
              <div class='form-group has-feedback'>
                <label>Tipo de Documento:</label><br>
                <select  class='btn btn-default dropdown-toggle' required='required' name="type_doc" style='text-align:left!important;' required>
                    <option selected disabled value="">-Selecione o Tipo de Documento-</option>
                    <option value='1'> Certificado </option>
                    <option value='2'> Declaração </option>
                    <option value='3'> Informação Interna </option>
                    <option value='4'> Nota Interna </option>
                    <option value='5'> Ofício Circular </option>
                    <option value='6'> Press Release </option>
                    <option value='7'> Fax </option>
                </select>
              </div>
              <div class='form-group has-feedback' style='width:270px!important;'>
                <label>Data:</label><br>
                <input type='date' class='form-control' id="date"  required='required'name='data'  required>
                <span class='glyphicon glyphicon-calendar form-control-feedback' ></span>
               </div>

               <div class='form-group has-feedback'>
                 <label>Assunto:</label><br>
                 <input type='text' class='form-control'  required='required'name='assunto' placeholder='Assunto: ' required>
                 <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
               </div>

               <div class='form-group has-feedback'>
                 <label>Destinatario:</label><br>
                 <input type='text' class='form-control' required='required' name="dest" placeholder='Destinatario: ' required>
                 <span class='glyphicon glyphicon-user form-control-feedback' ></span>
               </div>
        	    <br>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit"class="btn btn-primary modelInser" onclick="this.style.visibility = 'hidden'" ><i class="fa fa-check" aria-hidden="true"></i> Confirmar</button>
          <input type="hidden" name="_token"  value="{{ csrf_token() }}" >
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
        <h4 class="modal-title"><i class='fa fa-book'></i><b> Editar Documento </b></h4>
      </div>
      <form class="form-group" action="{{route('edit')}}" method="post">
        <div class="modal-body">
            <div class="form-group">
              <div class='form-group has-feedback'>
                <label>Utilizador:</label><br>
                <select id='utilizador_edi' name='utilizador_edi' class='btn btn-default dropdown-toggle'  required='required' style='text-align:left!important;'>
                    @foreach($user as $users)
                      <option value="{{$users->id}}">{{$users->name}}</option>
                    @endforeach
                </select>
              </div>
              <div class='form-group has-feedback'>
                <label>Departamento:</label><br>
                <select name='departamento_edi'  class='btn btn-default dropdown-toggle' required='required' id="depart_edi" style='text-align:left!important; width:270px!important;'>
                    <option value="1">Diretor de Serviços</option>
                    <option value="2">Divisão de Apoio à Educação Artística</option>
                    <option value="3">Divisão de Expressões Artísticas</option>
                    <option value="4">Divisão de Investigação e Multimédia</option>
                    <option value="5">Secção Administrativa</option>
                    <option value="6">Sistema de Gestão</option>
                    <option value="7">Área de Informática</option>
                    <option value="8">Produção</option>
                    <option value="9">Comunicação, Imagem e Vídeo</option>
                    <option value="10">Equipa de Animação</option>
                    <option value="11">Centro Multimédia</option>
                </select>
              </div>
              <div class='form-group has-feedback'>
                <label>Tipo de Documento:</label><br>
                <select  class='btn btn-default dropdown-toggle' required='required' name="type_doc_edi" id="type_doc_edi" style='text-align:left!important;'>
                    <option value='1'> Certificado </option>
                    <option value='2'> Declaração </option>
                    <option value='3'> Informação Interna </option>
                    <option value='4'> Nota Interna </option>
                    <option value='5'> Ofício Circular </option>
                    <option value='6'> Press Release </option>
                    <option value='7'> Fax </option>
                </select>
              </div>
              <div class='form-group has-feedback' style='width:270px!important;'>
                <label>Data:</label><br>
                <input type='date' class='form-control' id="date_edi" name='date_edi' placeholder='Data:  AAAA-MM-DD'  required='required'>
                <span class='glyphicon glyphicon-calendar form-control-feedback' ></span>
               </div>

               <div class='form-group has-feedback'>
                 <label>Assunto:</label><br>
                 <input type='text' class='form-control'  required='required'id='assunto_edi' name='assunto_edi' placeholder='Assunto: 'required='required'>
                 <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
               </div>

               <div class='form-group has-feedback'>
                 <label>Destinatario:</label><br>
                 <input type='text' class='form-control' required='required' id="dest_edi" name ="dest_edi"placeholder='Destinatario: ' required='required'>
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

<div class="modal fade" id="ModalVer" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-book'></i><b> Ver Documento </b></h4>
      </div>
      <form class="form-group">
        <div class="modal-body">
            <div class="form-group">
              <div class='form-group has-feedback'>
                <label>Utilizador:</label><br>
                <select name='num_utilizador' class='btn btn-default dropdown-toggle' id="utilizador_ver" required='required' style='text-align:left!important;' disabled>
                    <option>-Selecione Utilizador-</option>
                    @foreach($user as $users)
                      <option value="{{$users->id}}">{{$users->name}}</option>
                    @endforeach
                </select>
              </div>
              <div class='form-group has-feedback'>
                <label>Departamento:</label><br>
                <select name='departamento'  class='btn btn-default dropdown-toggle' required='required' id="depart_ver" style='text-align:left!important; width:270px!important;' disabled>
    		            <option>-Selecione o Departamento -</option>";
                    <option value="1">Diretor de Serviços</option>
                    <option value="2">Divisão de Apoio à Educação Artística</option>
                    <option value="3">Divisão de Expressões Artísticas</option>
                    <option value="4">Divisão de Investigação e Multimédia</option>
                    <option value="5">Secção Administrativa</option>
                    <option value="6">Sistema de Gestão</option>
                    <option value="7">Área de Informática</option>
                    <option value="8">Produção</option>
                    <option value="9">Comunicação, Imagem e Vídeo</option>
                    <option value="10">Equipa de Animação</option>
                    <option value="11">Centro Multimédia</option>
                </select>
              </div>
              <div class='form-group has-feedback'>
                <label>Tipo de Documento:</label><br>
                <select name='num_utilizador' class='btn btn-default dropdown-toggle' required='required' id="type_doc_ver" style='text-align:left!important;' disabled>
                    <option>-Selecione o Tipo de Documento-</option>
                    <option value='1'>-Certificado-</option>
                    <option value='2'>-Declaração-</option>
                    <option value='3'>-Informação Interna-</option>
                    <option value='4'>-Nota Interna-</option>
                    <option value='5'>-Ofício Circular-</option>
                    <option value='6'>-Press Release-</option>
                    <option value='7'>-Fax-</option>
                </select>
              </div>
              <div class='form-group has-feedback' style='width:270px!important;'>
                <label>Data:</label><br>
                <input type='date' class='form-control' id="date_ver" required='required'name='data' placeholder='Data:  AAAA-MM-DD'  required='required' disabled>
                <span class='glyphicon glyphicon-calendar form-control-feedback' ></span>
               </div>

               <div class='form-group has-feedback'>
                 <label>Assunto:</label><br>
                 <input type='text' class='form-control'  required='required'name='assunto' id="assunto_ver" placeholder='Assunto: 'required='required' disabled>
                 <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
               </div>

               <div class='form-group has-feedback'>
                 <label>Destinatario:</label><br>
                 <input type='text' class='form-control' required='required'name='destinatarios' id="dest_ver" placeholder='Destinatario: ' required='required' disabled>
                 <span class='glyphicon glyphicon-user form-control-feedback' ></span>
               </div>
        	    <br>
            </div>
        </div>
      </form>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="apagar_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{route('doc.delete')}}" method="POST">
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Apagar Documento</h4>
        </div>
        <div class="modal-body">
          <p>Tem a certesa que quer apagar este Documento???</p>
          <input  id="apagar_doc" name="apaga_doc"  style="display: none">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="hidden" name="_token"  value="{{ csrf_token() }}" >
          <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Apagar</button>
        </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script  type="text/javascript">
  var destinatario;
  var departamento;
  var utilizador;
  var data;
  var tipo_doc;
  var assunto;
  var token = '{{Session::token()}}';
  var urlEdit = "{{route('edit')}}";
  var date1;


  $('.date_doc').on('click', function(event) {

    var data = new Date();
    var dia = data.getDate();
    if (dia.toString().length == 1)
      dia = "0"+dia;
    var mes = data.getMonth()+1;
    if (mes.toString().length == 1)
      mes = "0"+mes;
    var ano = data.getFullYear();

    document.getElementById('date').value= ano+"-"+mes+"-"+dia;
    console.log(''+currentdate);
  });
  $('.modelInser').on('click', function(event) {

      departamento=document.getElementById('depart').value;
      destinatario=document.getElementById('dest').value;
      utilizador=document.getElementById('utilizador').value;
      date=document.getElementById('date').value;
      tipo_doc=document.getElementById('type_doc').value;
      assunto1=document.getElementById('assunto').value;
      currentyear=new Date().getFullYear();
      if(date==null){
        console.log('nada');
      } else{
        console.log('funcionou');
      }
      $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
      $.ajax({
              method: 'POST',
              url: urlInsert,
              data: {year: currentyear  , id_user: utilizador,assunto: assunto1 ,data: date,receiver:destinatario,id_tipo_doc:tipo_doc ,id_departamento:departamento, _token:token}
          })
          .done(function (msg) {
            $('#myModal').modal('hide');
          });

  });

 function myFunction(elem) {
        event.preventDefault();
        $("#ModalVer").modal();
        var destinatario1;
        var departamento1;
        var utilizador1;

        var tipo_doc1;
        var assunto11;

        console.log('elem:'+elem.id);
        id_doc=elem.id;
         console.log('2');
        departamento1=document.getElementById('abbreviation_doc'+elem.id).value;
         console.log('3');
        destinatario1=document.getElementById('receiver_doc'+elem.id).value;
         console.log('4');
        utilizador1=document.getElementById('user_doc'+elem.id).value;
         console.log('5');
        date1=document.getElementById('data_doc'+elem.id).value;
         console.log('6');
        tipo_doc1=document.getElementById('type_doc_1'+elem.id).value;
         console.log('7');
        assunto11=document.getElementById('assunto_doc'+elem.id).value;
         console.log('8');
        currentyear=new Date().getFullYear();

        document.getElementById('depart_ver').value=departamento1;
        document.getElementById('dest_ver').value=destinatario1;
        document.getElementById('utilizador_ver').value= utilizador1;
        document.getElementById('date_ver').value=date1;
        document.getElementById('type_doc_ver').value=tipo_doc1;
        document.getElementById('assunto_ver').value=assunto11;
  }
  function apagar(vari) {
       event.preventDefault();
       $("#apagar_modal").modal();
       document.getElementById('apagar_doc').value=vari.name;
  }

  function edit_func(elem) {
         event.preventDefault();
         $("#ModelEdit").modal();
         var destinatario_edi;
         var departamento_edi;
         var utilizador_edi;
         var date_edi;
         var tipo_doc_edi;
         var assunto_edi;

          id_doc=elem.name;
          departamento_edi=document.getElementById('abbreviation_doc'+elem.name).value;
          destinatario_edi=document.getElementById('receiver_doc'+elem.name).value;
          utilizador_edi=document.getElementById('user_doc'+elem.name).value;
          date_edi=document.getElementById('data_doc'+elem.name).value;
          tipo_doc_edi=document.getElementById('type_doc_1'+elem.name).value;
          assunto_edi=document.getElementById('assunto_doc'+elem.name).value;
          currentyear=new Date().getFullYear();

          document.getElementById('_user').value=id_doc;
          document.getElementById('depart_edi').value=departamento_edi;
          document.getElementById('dest_edi').value=destinatario_edi;
          document.getElementById('utilizador_edi').value= utilizador_edi;
          document.getElementById('date_edi').value=date_edi;
          document.getElementById('type_doc_edi').value=tipo_doc_edi;
          document.getElementById('assunto_edi').value=assunto_edi;
   }

</script>

@stop
