<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Awokein</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"/>

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
    </head>
    <body class=" bg-dark-blue">
      <div id="app" class="  mx-auto">
        <app-hero :data="{{ json_encode($gamesWithImages) }}"></app-hero>
        <app-second-section :data="{{ json_encode($gamesWithImages) }}"></app-second-section>
      </div>
    </body>
</html>
