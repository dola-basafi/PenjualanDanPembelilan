<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  {{-- <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">


  {{-- <script src="{{ asset('js/select2.min.js') }}"></script> --}}
  <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('js/datatables.min.js') }}"></script>
  {{-- <script src="{{ asset('js/jquery.js') }}"></script> --}}


  
</head>
<body>
  <div class="container">
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid mx-auto">
            @auth
            <a class="navbar-brand" href="#">@yield('navName')</a>
            <p class="display-6 mb-0">Anda login sebagai {{ auth()->user()->name }}</p>
            <a class="navbar-brand bg-danger p-1 text-light float-end" href="{{ route('logout') }}">Logout</a>
            @endauth
            @guest
            <a class="navbar-brand text-center" href="#">Login</a>
            @endguest
        </div>
    </nav>
    <div class="container">
      @auth
      <a href="{{ route('invIndex') }}" class="btn btn-info mb-2">
        Invientory
      </a>

      
      
      @if ( auth()->user()->role == 1)
      <a href="{{ route('adminSalesPurchase','sales') }}" class="btn btn-primary mb-2">
        Sale
      </a>
      @endif
      @if (auth()->user()->role == 2 or auth()->user()->role == 1 )
      <a href="{{ route('salesIndex') }}" class="btn btn-primary mb-2">
        List Sales
      </a>        
          
      @endif
      @if ( auth()->user()->role == 1)
      <a href="{{ route('adminSalesPurchase','purchase') }}" class="btn btn-success mb-2">
        Purchase
      </a>  
      @endif
      @if (auth()->user()->role == 3 or auth()->user()->role == 1 )
      <a href="{{ route('purchaseIndex') }}" class="btn btn-success mb-2">
        List Purchase
      </a>        

      @endif

      

      @endauth

    </div>
    <script>
      @if ($errors->any()) 
      Swal.fire({
        icon:'error',
        title:'error',
        html:'{!! implode('', $errors->all('<p class="alert alert-danger" >:message</p>')) !!}',
        showConfirmButton: true,
      })         
      @endif
      @if (session('success')) 
      Swal.fire({
        icon:'success',
        title:'success',
        html:'<p class="alert alert-success">{{ session('success') }}</p>',
        showConfirmButton: true,
      })         
      @endif
    </script>

    @yield('content')
    

 
</body>
</html>