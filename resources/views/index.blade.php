<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="favicon.png">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

        <!-- Font library and icon pack -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
        <!-- Vuetify.js -->
        <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="css/core.css">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>Fotosamling</title>

        <script>
            /* used by dropzone */
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token()
            ]); ?>
        </script>
    </head>
    <body>
        <div id="app">
            <!-- <aside id="main-aside"> -->
                <!-- <drawer></drawer> -->
                <v-app>
                <main-layout></main-layout>
            <!-- </aside> -->

            <!-- <main id="main-content">                
                <transition mode="out-in" appear name="custom-classes-transition" enter-active-class="animated fadeIn">
                    <router-view></router-view>
                </transition>

            </main> -->
</v-app>

        </div>

        <script src="./js/app.js"></script>
    </body>
</html>
