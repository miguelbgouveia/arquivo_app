@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin</div>
                <div class="panel-body">
                    <a class="btn btn-default" href="{{route('user_table')}}">Utilizador <i class="fa fa-users" aria-hidden="true"></i></a>
                    <a class="btn btn-default" href="{{route('dashboard')}}">Admin <i class="fa fa-user" aria-hidden="true"></i></a>
                    <a class="btn btn-default" href="{{route('type.doc.table')}}">Tipos de Documentos<i class="fa fa-file" aria-hidden="true"></i></a>
                    <a class="btn btn-default" href="{{route('user.depart')}}">Departamentos <i class="fa fa-building" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
