<!doctype html>
<html lang="{{App::getLocale()}}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>contract generator</title>
        <link href="{{ (env('APP_ENV') === 'development') ? mix('css/app.css') : asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    </head>
    <body>
        <v-app id="app">
            <v-fade-transition mode="out-in">
                <router-view></router-view>
            </v-fade-transition>
        </v-app>
    </body>
    <script src="{{ (env('APP_ENV') === 'development') ? mix('js/app.js') : asset('js/app.js') }}"></script>
</html>
