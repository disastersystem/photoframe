<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
 
        <script src="https://unpkg.com/vue/dist/vue.js"></script>

        <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet" type="text/css">
        <script src="https://unpkg.com/vuetify/dist/vuetify.min.js"></script>
    </head>
    <body style="font-size: 20px;">
        <div id="loginapp" style="display: flex; justify-content: center; margin-top: 50px;">
         <v-card class="grey lighten-4 elevation-0" style="width: 300px;">
            <v-card-text>
              <v-container>
                
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                      name="input-1"
                      label="Brukernavn eller e-post"
                      value="Johanne Johnsen"
                      id="testing"
                    ></v-text-field>
                  </v-flex>
                </v-layout>
                
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                      name="input-2"
                      label="Passord"
                      value="32awdjk342"
                      type="password"
                      class=""
                    ></v-text-field>
                  </v-flex>
                </v-layout>

                <a href="inside" 
                style="background: #61B865; color: #FFF; padding: 10px; 
                font-variant: small-caps; font-weight: bold; font-size: 20px;
                text-decoration: none;">login</a>
              
              </v-container>
            </v-card-text>
          </v-card>
        </div>

        <script src="./js/login.js"></script>
    </body>
</html>