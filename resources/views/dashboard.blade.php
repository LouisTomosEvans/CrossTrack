<html>
    <head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap">
    <style>
    html {
        font-family: 'Inter', sans-serif;
    }
    </style>
    <meta name="laravel-constants" content="{{ base64_encode(json_encode(\App\Constants\IndustrySectors::SECTORS)) }}">
    </head>
    <body>
    <script defer src="{{ mix('/js/app.js') }}"></script>
    <div id="app">
        <app></app>
    </div>
    </body>
    <!-- <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script> -->
</html>
