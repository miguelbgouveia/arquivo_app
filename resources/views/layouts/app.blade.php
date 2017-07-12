<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="icon" type="img/ico" href="{{ URL::to('img/favicon.ico')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Arquivo Digital</title>

    <!-- Styles -->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.15/datatables.min.css"/>



    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::to('css/main.css')}}">
    <link rel="stylesheet" href="{{ URL::to('font-awesome-4.7.0/css/font-awesome.min.css')}}">

    <!-- Latest compiled and minified JavaScript -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.css"/>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.js"></script>
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.15/datatables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">
          <span class="logo-mini"><font size="6"><p><i class="fa fa-archive" aria-hidden="true"></i> Arquivo Digital de Documentação &nbsp;&nbsp;</p></font></span>
        </a>
      </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if(Auth::guard('admin')->check())
                          <li><a href="{{ route('admin_menu') }}">Admin Menu</a></li>
                        @endif
                        @if(Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            @else
                                  <li>
                                     <a href="{{route('dashboard')}}" class="dropdown-toggle"  role="button" aria-expanded="false">
                                       Documentos
                                     </a>
                                  </li>
                                  <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                          {{ Auth::user()->name }} <span class="caret"></span>
                                      </a>

                                      <ul class="dropdown-menu" role="menu">
                                          <li>
                                              <a href="{{route('logout')}}">Logout</a>
                                          </li>
                                      </ul>
                                  </li>
                            @endif
                        </a>
         </div>
       </div>
     </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script>
    $(document).ready(function() {
      $('#example').DataTable( {
        "columnDefs":[{
          "targets": 'no-sort',
          "orderable": true,
        }],
        "order": [[ 0, "desc" ]]
      } );
    } );
    </script>
</body>
</html>
