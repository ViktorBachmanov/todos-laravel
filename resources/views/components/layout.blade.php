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

      {{ $slot }}

      <div class="toast position-fixed bottom-0 end-0 m-3 text-bg-danger" style="max-width: 10em;" role="alert" aria-live="assertive" aria-atomic="true" id="toast">
        <div style="display: flex; align-items: center;" class="px-2">
          <div class="toast-body">Error</div>
          <button type="button" class="btn-close" style="margin-left: auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
      
    </body>
</html>
