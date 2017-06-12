@extends('layouts.master')
@section('title')
Thank you
@stop
@section('content')

@include('includes.message-block')
  <div class='row'>
    <div class='col-md-6'>
      <h3>Inscrição</h3>
      <form action="{{ route('register') }}" method='post'>
      <div class="form_group">
        <label for='email'>O teu email</label>
        <input class="form-control " type='email' name='email' id='email' value="{{Request::old('email')}}">
      </div>
      <div class="form_group ">
        <label for='name'>O teu Nome</label>
        <input class="form-control " type='text' name='name' id='name' value="{{Request::old('name')}}">
      </div>
      <div class="form_group">
        <label for='password'>O tua Password</label>
        <input class="form-control " type='password' name='password' id='password' value="{{Request::old('password')}}">
      </div>
      <div class="form_group">
        <label for='id_department'>Departamento</label>
        <select class="form-control "  name"id_departament">
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
        <select>
      </div>
      <br>
      <button type='submit' class='btn btn-primary'>Submeter</button>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
   </div>
   <div class='col-md-6'>
     <h3>Entrar</h3>
     <form action='' method='post'>
       <div class="form_group {{$errors->has('email')?'has-error' : ''}}">
          <label for='email'>O teu email</label>
          <input class='form-control' type='email' name='email' id='email' value="{{Request::old('email')}}" >
       </div>
       <div class="form_group ">
          <label for='password'>O tua Password</label>
          <input class='form-control'type='password' name='password' id='password'  value="">
       </div>
       <br>
       <button type='submit' class='btn btn-primary'>Submeter</button>
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
   </div>
  </div>
  <div class="demo">
    <footer>
    <div class="row">
      <div class="col-md-2">
      </div>
      <div class="col-md-8">
        <div class="login-logo">
      	<img src="{{ URL::to('img/logo_sre.png')}}" style="margin-top:15px; margin-bottom: 6px;">
      </div>
    </div>
    <div class="col-md-2">
    </div>
    </div>
  </footer>
  </div>
@stop
