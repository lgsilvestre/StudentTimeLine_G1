<template >
<<<<<<< HEAD:frontend/src/components/Globales/FooterGlobal.vue
  <v-container  fluid  >
      <v-footer    padless absolute="" color="primary" min-width="720px"   >
        <v-btn color="primary white--text mt-3 mr-2 " depressed   @click="urlUniversidad" >Universidad de Talca</v-btn>
        <v-btn color="primary white--text mt-3 mr-2 " depressed   @click="urlContacto">Contacto</v-btn>
        <NosotrosComponent/>
        

        <v-spacer></v-spacer>
            <v-app-bar-nav-icon @click="setDrawelAdmin"></v-app-bar-nav-icon>

            <v-btn class="xs-2 " small icon fab @click="urlFacebook">
                    <v-icon color="white" >{{ icoFacebook }}</v-icon>
            </v-btn>
            <v-btn class="xs-2 ml-10" small  icon fab  @click="urlTwitter">
                <v-icon color="white">{{icoTwitter}}</v-icon>
            </v-btn>
            <v-btn class="xs-2 ml-10" small  icon fab  @click="urlInstagram">     
                <v-icon color="white"> {{ icoInstagram }} </v-icon>
            </v-btn>
            <v-btn class="xs-2 ml-10 mr-10" small   icon fab  @click="urlYoutube">     
                <v-icon color="white"> {{ icoYoutube }} </v-icon>
            </v-btn>
             
      <v-card-text class=" py-2 white--text text-center secondary">
        {{ new Date().getFullYear() }} — <strong> {{ nombrePag }} </strong>
      </v-card-text>
    </v-footer>
  </v-container>
=======
  <v-footer dark padless fixed color="primary" min-width="720" >
    <!-- <v-card class=" flex" flat tile  > -->
      <!-- <v-card-title class="primary"  > -->
        <v-row no-gutters justify-center>
            <v-col class="d-none d-sm-none d-md-flex" align-self="center" md="4" >
                <v-btn class="ml-2" color="primary white--text" depressed   @click="urlUniversidad" >Universidad de Talca</v-btn>
                <!-- Boton que muestra informacion sobre el equipo de desarrollo -->
                <NosotrosComponent/>
            </v-col>
            <v-col class="text-center" sm="12" md="4" lg="4" align-self="center">
                <strong> {{ nombrePag }} —  {{ new Date().getFullYear() }} </strong>         
            </v-col>
            <v-col  class="d-none d-sm-none d-md-flex " align-self="center" md="4">
                <v-spacer></v-spacer>
                <v-btn class="xs-2 " small icon fab @click="urlFacebook">
                    <v-icon color="white" >{{ icoFacebook }}</v-icon>
                </v-btn>
                <v-btn class="xs-2 ml-2" small  icon fab  @click="urlTwitter">
                    <v-icon color="white">{{icoTwitter}}</v-icon>
                </v-btn>
                <v-btn class="xs-2 ml-2" small  icon fab  @click="urlInstagram">     
                    <v-icon color="white"> {{ icoInstagram }} </v-icon>
                </v-btn>
                <v-btn class="xs-2 ml-2 mr-4" small   icon fab  @click="urlYoutube">     
                    <v-icon color="white"> {{ icoYoutube }} </v-icon>
                </v-btn>
            </v-col>
        </v-row>
  </v-footer>
>>>>>>> felipe2:frontend/src/components/Globales/FooterGeneral.vue
</template>


<script>
import NosotrosComponent from '@/components/Globales/NosotrosComponent.vue';
import {mapMutations} from 'vuex';
export default {
    components:{
        NosotrosComponent
    },
    data() {
        return {
            icoFacebook:'mdi-facebook',
            icoTwitter:'mdi-twitter',
            icoInstagram: 'mdi-instagram',
            icoYoutube:'mdi-youtube',
            nombrePag:'La Calila y los Mojojojo',
        }
    },
    methods:{
        ...mapMutations(['setDrawelAdmin'])
        ,
        urlFacebook(){
            window.open("https://www.facebook.com/utalca/", '_blank');
        },
        urlTwitter(){
            window.open("https://twitter.com/utalca", '_blank');
        },
        urlInstagram(){
            window.open("https://www.instagram.com/utalca/", '_blank');
        },
        urlYoutube(){
            window.open("https://www.youtube.com/channel/UCoH9MLoWd9f5mFbSBaa_X9Q", '_blank');
        },
        urlUniversidad(){
            window.open("https://www.utalca.cl/universidad/", '_blank');
        }
    }
}
</script>
