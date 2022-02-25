<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <title>Mombasa Auto Show</title>
    <base href="{{ URL::to('/')}}">


   <!-- Bootstrap CSS --> 
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
   <link rel="stylesheet" href="{{ asset('front-end/css/style.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- jQuery UI 1.11.4 -->
   <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    
</head>
<body>
    @yield('content') 
    <input type="hidden" id="refreshed" value="no"> 
    <script src="{{ asset('front-end/js/autoshow.js') }}"></script>
</body>
</html>