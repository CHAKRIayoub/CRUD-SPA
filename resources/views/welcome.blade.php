<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<meta id="h" name="csrf-token" content='<?php /*echo json_encode(['csrfToken' => csrf_token(), ]); */ ?>'>-->

    <meta id="h" name="csrf-token" content='<?php echo  csrf_token(); ?>'>

        <title>Laravel</title>

        <!-- Fonts -->


        <!-- Styles -->

        <link href="{!! asset('css/boostwatch/paper/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
       
    </head>

    <body>

        <div id="app">

           
                @include('partials.top')

                <div class="jumbotron">
                    <router-view>  </router-view>
                </div>



        </div>

        

       
        <script src="/js/app.js" ></script>    
    </body>
</html>
