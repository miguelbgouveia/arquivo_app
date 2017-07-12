@extends('layouts.app_admin')
@section('content')
@include('includes.message-block')
<div class="row">
  <div class="col-md-2">
  </div>
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class='box-title'><i class='fa fa-book'></i><b> Lista de Departamentos </b></h4>
      </div>
      <div class="panel-body">
        <div class='row-fluid'>
          <div id="postBody"></div>
              <table id="example" class=' table-bordered table-striped' class="display" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th>ID Departamentos</th>
                  <th>Abreviatura</th>
                  <th>Nome</th>
                  <th>Opções</th>
                </tr>
              </thead>
              <tbody>
                <form>
                  @foreach($depart as $departs)
                   <tr>
                      <td>{{$departs->id}}</td>
                      <td>{{ $departs->abbreviation}}</td>
                      <td>{{ $departs->name}}</td>
                      <td>
                      <a href='#' type='button'class='btn btn-info btn-xs' onclick="depart_ver(this)" id="{{ $departs->id}}" data-toggle="modal" data-target="#ModalVer"><span><i class='fa fa-eye' aria-hidden='true'></i></span></a>
                      <a href='#' type='button'class='btn btn-warning btn-xs'onclick="edit_depart(this)" name="{{$departs->id}}" ><span><i class='fa fa-pencil' aria-hidden='true'></i></span></a>
                      <a href="#" type='button'class='btn btn-danger btn-xs' onclick="depart_apagar(this)" name="{{ $departs->id}}"><span><i class='fa fa-trash' aria-hidden='true'></i></span></a></td>
                   </tr>
                   <input  id="abbreviation_depart{{ $departs->id}}" value="{{ $departs->abbreviation}}"  style="display: none">
                   <input  id="name_depart{{ $departs->id}}" value="{{ $departs->name}}"  style="display: none">
                 @endforeach
               </form>
               </tbody>
            </table>
          </div>
          <div class=''>
            <a href='#' data-toggle="modal" data-target="#myModal"  class='btn btn-success date_doc'>
              <i class='fa fa-plus'></i> Novo Departamento
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
        <h4 class="modal-title"><i class='fa fa-arrow-circle-o-right'></i><b> Inserir Departamento </b></h4>
      </div>
      <form class="form-group" id="depart_form_inser" action="{{route('admin.depart.insert')}}" method="post">
        <div class="modal-body">
            <div class="form-group">
              <div class='form-group has-feedback'>
                <label>Nome do Departamento: </label><br>
                <input type='text' class='form-control'  required='required' name='nome_depart' placeholder='Nome do Departamento: 'required='required'>
                <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
              </div>
              <div class='form-group has-feedback'>
                <label>Abreviatura do Departamento</label><br>
                <input type='text' class='form-control'  required='required' name='abrevia_depart' placeholder='Abreviatura do Departamento: 'required='required'>
                <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
              </div>
            </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="_user" value="" >
          <input type="hidden" name="_token"  value="{{ csrf_token() }}" >
          <button type="submit" onclick="depart_inser_submit(this)" class="btn btn-primary" onclick="depart_inser_submit(this)" ><i class="fa fa-check" aria-hidden="true"></i> Confirmar</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- Modal Para Editar-->
<div class="modal fade" tabindex="-1" id="ModalEdit" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Departamento</h4>
      </div>
      <form class="form-group" id="edi_form_depart" action="{{route('admin.depart.edit')}}" method="post">
      <div class="modal-body">
        <div class="modal-body">
            <div class="form-group">
              <div class='form-group has-feedback'>
                <label>Nome do Departamento: </label><br>
                <input type='text' class='form-control'  required='required' name='edi_nome_depart' id='edi_nome_depart'placeholder='Nome do Departamento: 'required='required'>
                <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
              </div>
              <div class='form-group has-feedback'>
                <label>Abreviatura do Departamento</label><br>
                <input type='text' class='form-control'  required='required'id ='edi_abrevia_depart' name='edi_abrevia_depart' placeholder='Abreviatura do Departamento: 'required='required'>
                <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <input type="text" id="id_depart" name="id_depart" style="display: none" >
          <input type="text" name="_token"  value="{{ csrf_token() }}" style="display: none" >
          <button type="submit" onclick="depart_edi_submit(this)"  class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>  Guardar Mudanças</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>
        </div>
      </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
</div>

<div class="modal fade" tabindex="-1" id="ModalVer" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ver Departamento</h4>
      </div>
      <div class="modal-body">
        <div class="modal-body">
            <div class="form-group">
              <div class='form-group has-feedback'>
                <label>Nome do Departamento: </label><br>
                <input type='text' class='form-control'  required='required' id='nome_depart' placeholder='Nome do Departamento: 'required='required' disabled>
                <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
              </div>
              <div class='form-group has-feedback'>
                <label>Abreviatura do Departamento</label><br>
                <input type='text' class='form-control'  required='required' id='abrevia_depart' placeholder='Abreviatura do Departamento: 'required='required'disabled>
                <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
              </div>
            </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
</div>

<div class="modal fade" id="Apagar_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{route('apagar.depart')}}" method="POST">
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Apagar Departamento</h4>
        </div>
        <div class="modal-body">
          <h4>Tem a certesa que quer apagar este Departamento???</h4>
          <ul>
            <li>
              Todos os documentos e utilizadores que fazem parte deste Departamento irão ser apagado.
            </li>
          </ul>
          <input  id="apagar_depart" name="apaga_depart"  style="display: none">
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
  var token = '{{Session::token()}}';
  var name;
  var abreviation;

 function depart_ver(elem) {
        event.preventDefault();
        name =document.getElementById('name_depart'+elem.id).value
        abreviation=document.getElementById('abbreviation_depart'+elem.id).value
        console.log("flag1 -name:"+name+" abreviatura:"+abreviation);
        document.getElementById('nome_depart').value=  name;
        document.getElementById('abrevia_depart').value=abreviation;
  }
  function depart_apagar(vari) {
       event.preventDefault();
       $("#Apagar_modal").modal();
       console.log(vari.name);
       document.getElementById('apagar_depart').value=vari.name;
  }


  function edit_depart(elem) {
         event.preventDefault();
         $("#ModalEdit").modal();
         name =document.getElementById('name_depart'+elem.name).value
         abreviation=document.getElementById('abbreviation_depart'+elem.name).value
         document.getElementById('edi_nome_depart').value=name;
         document.getElementById('edi_abrevia_depart').value=abreviation;
         document.getElementById('id_depart').value=elem.name;
   }
   function depart_edi_submit(elem) {
      abreviation=document.getElementById('edi_abrevia_depart').value;
      if(document.getElementById('edi_nome_depart').value==null){
        alert("validation failed false");
        returnToPreviousPage();
        return false;
      }
      if(document.getElementById('edi_abrevia_depart').value==null){
        alert("validation failed false");
        returnToPreviousPage();
        return false;
      }
      return true;
      document.getElementById("edi_form_depart").submit();
    }

    function depart_inser_submit(elem) {
       if(document.getElementById('nome_depart').value==null){
         returnToPreviousPage();
         return false;
       }
       if(document.getElementById('abrevia_depart').value==null){
         returnToPreviousPage();
         return false;
       }
       return true;
       document.getElementById("depart_form_inser").submit();
     }

</script>
@stop
