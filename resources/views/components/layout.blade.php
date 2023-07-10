<!DOCTYPE html>
<html lang="ru" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todo - Laravel</title>

        
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

        <script src="{{ mix('/js/app.js') }}"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    </head>
    <body>
      <x-app-bar />      

      <x-toast /> 
      <script src="{{ mix('/js/toast.js') }}"></script> 

      {{ $slot }}

    </body>
</html>
