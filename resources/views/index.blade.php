<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="favicon.png">

        <title>Fotosamling</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

        <!-- Font library and icon pack -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
        <!-- Vuetify -->
        <link href="https://unpkg.com/vuetify@0.12.0/dist/vuetify.min.css" rel="stylesheet" type="text/css">
        <!-- <link rel="stylesheet" type="text/css" href="../node_modules/vuetify/dist/vuetify.min.css"> -->

        <link rel="stylesheet" type="text/css" href="css/core.css">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script>
            /* used by dropzone */
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token()
            ]); ?>
        </script>
    </head>
    <body>
        <div id="app">
            <v-app>
                <main-layout></main-layout>
            </v-app>
        </div>
        
        <script src="./js/app.js"></script>
    </body>
</html>
