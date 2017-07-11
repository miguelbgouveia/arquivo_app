@extends('layouts.app_admin')
@section('content')
@include('includes.message-block')
<div class="row">
  <div class="col-md-2">
  </div>
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class='box-title'><i class='fa fa-book'></i><b> Lista de Tipos Doc.</b></h4>
      </div>
      <div class="panel-body">
        <div class='row-fluid'>
          <div id="postBody"></div>
              <table id="example" class=' table-bordered table-striped' class="display" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th>ID Tipo do Doc</th>
                  <th>Tipo de Doc</th>
                  <th>Opções</th>
                </tr>
              </thead>
              <tbody>
                <form>
                  @foreach($type_doc as $type_docs)
                   <tr>
                      <td>{{ $type_docs->id}}</td>
                      <td>{{ $type_docs->type}}</td>
                      <td>
                      <a href='#' type='button'class='btn btn-info btn-xs' onclick="type_docs_ver(this)" id="{{ $type_docs->id}}" data-toggle="modal" data-target="#ModalVer"><span><i class='fa fa-eye' aria-hidden='true'></i></span></a>
                      <a href='#' type='button'class='btn btn-warning btn-xs'onclick="edit_type_docs(this)" name="{{$type_docs->id}}" ><span><i class='fa fa-pencil' aria-hidden='true'></i></span></a>
                      <a href="#" type='button'class='btn btn-danger btn-xs' onclick="type_docs_apagar(this)" name="{{ $type_docs->id}}"><span><i class='fa fa-trash' aria-hidden='true'></i></span></a></td>
                   </tr>
                   <input  id="type_docs{{ $type_docs->id}}" value="{{ $type_docs->type}}"  style="display: none">
                 @endforeach
               </form>
               </tbody>
            </table>
          </div>
          <div class=''>
            <a href='#' data-toggle="modal" data-target="#myModal"  class='btn btn-success date_doc'>
              <i class='fa fa-plus'></i> Novo Tipo de Doc
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
        <h4 class="modal-title"><i class='fa fa-arrow-circle-o-right'></i><b> Inserir Tipo de Doc</b></h4>
      </div>
      <form class="form-group" action="{{route('admin.type_doc.insert')}}" method="post">
        <div class="modal-body">
            <div class="form-group">
              <div class='form-group has-feedback'>
                <label>Nome do Tipo de Doc: </label><br>
                <input type='text' class='form-control'  required='required' name='type_doc_inser' placeholder='Nome do Tipo de Doc: 'required='required'>
                <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
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
</div>
<!-- Modal Para Editar-->
<div class="modal fade" tabindex="-1" id="ModalEdit" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Departamento</h4>
      </div>
      <form class="form-group" action="{{route('admin.type_doc.edit')}}" method="post">
      <div class="modal-body">
        <div class="modal-body">
            <div class="form-group">
              <div class='form-group has-feedback'>
                <label>Nome do Tipo de Doc: </label><br>
                <input type='text' class='form-control'  required='required' name='type_doc_edit' id='type_doc_edit'placeholder='Nome do Departamento: 'required='required'>
                <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <input type="text" id="id_type_doc" name="id_type_doc" style="display: none" >
          <input type="text" name="_token"  value="{{ csrf_token() }}" style="display: none" >
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Guardar Mudanças</button>
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
        <h4 class="modal-title">Ver Tipo de Doc</h4>
      </div>
      <div class="modal-body">
        <div class="modal-body">
            <div class="form-group">
              <div class='form-group has-feedback'>
                <label>Nome do Tipo de Doc: </label><br>
                <input type='text' class='form-control'  required='required' id='type_doc' placeholder='Tipo Doc: 'required='required' disabled>
                <span class='glyphicon glyphicon-comment form-control-feedback' ></span>
              </div>
            </div>
      </div>
      <div class="modal-footer">

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
</div>

<div class="modal fade" id="Apagar_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{route('apagar.type_doc')}}" method="POST">
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Apagar Tipo de Doc</h4>
        </div>
        <div class="modal-body">
          <p>Tem a certesa que quer apagar este Tipo Doc???</p>
          <input  id="apagar_type_doc" name="apagar_type_doc"  style="display: none">
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
  var tipo;


 function type_docs_ver(elem) {
        event.preventDefault();
        tipo =document.getElementById('type_docs'+elem.id).value
        document.getElementById('type_doc').value=tipo;
  }
  function type_docs_apagar(vari) {
       event.preventDefault();
       $("#Apagar_modal").modal();
       document.getElementById('apagar_type_doc').value=vari.name;
  }


  function edit_type_docs(elem) {
         event.preventDefault();
         $("#ModalEdit").modal();
         name =document.getElementById('type_docs'+elem.name).value
         document.getElementById('type_doc_edit').value=name;
         document.getElementById('id_type_doc').value=elem.name;
   }

</script>
@stop
