<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Multi Auth Guard') }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('DataTables/css/dataTables.bootstrap4.min.css')}}">
  <style>
  #example_wrapper{
    display:unset !important;
  }
  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">LARAVEL</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{ url('/admin') }}">Home <span class="sr-only">(current)</span></a>
        </li>
        
        
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/user') }}">User</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/product') }}">Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/category') }}">Category</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/employee') }}">Employee</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/top-five') }}">Employee Top 5 Salary</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/document') }}">Document Upload</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/email') }}">Send Email</a>
        </li>
        @if (Auth::guest())
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/register') }}">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/login') }}">login</a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
          <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
        </li>
        @endif
      </ul>
      
    </div>
  </nav>
<div class="container">

   @yield('content')

   </div>
   <script type="text/javascript" src="{{asset('DataTables/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('DataTables/js/dataTables.bootstrap4.min.js')}}"></script>
    
</body>
</html>