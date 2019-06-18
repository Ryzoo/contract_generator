<!doctype html>
<html lang="{{App::getLocale()}}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>contract generator</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <v-app>
                <v-container fluid>
                    <router-view></router-view>
                </v-container>
            </v-app>
        </div>
    </body>
    <script src="{{ asset('js/app.js')}}"></script>
</html>
