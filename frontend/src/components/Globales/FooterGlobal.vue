<template >
    <v-container class="pa-md-7" fluid >
        <v-footer dark absolute color="primary" >
            <v-row no-gutters justify-center>
                <v-col class="d-none d-sm-none d-md-flex" align-self="center" md="4" >
                    <v-btn class="ml-2" color="primary white--text" depressed   @click="urlUniversidad" >Universidad de Talca</v-btn>
                    <!-- Boton que muestra informacion sobre el equipo de desarrollo -->
                    <!-- <NosotrosComponent/>  -->
                    <v-btn class="ml-2" color="primary white--text" depressed @click="dialogContactar = true" v-show="this.$store.state.usuario.usuario.rol != 'admin'">
                        Contactar
                    </v-btn>

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

        <v-dialog v-model="dialogContactar" persistent max-width="500px" :key="keyContactar">
            <v-card class="mx-auto" max-width="500" >
                <v-card-title class="headline primary text--center" primary-title >
                    <h5 class="white--text ">Contactar Superior</h5>
                </v-card-title>
                    <v-container class="px-5 mt-5">
                        <v-form ref="contactar">
                            <v-select
                                v-model="datosContactar.rolDestinatario"
                                label="Tipo Destinatario"
                                :items="listaRoles"
                                item-text="nombre"
                                item-value="id"
                                :rules="[() => !!datosContactar.rolDestinatario ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-account-tie"
                            >                                
                            </v-select>
                            <v-select
                                v-model="datosContactar.idDestinatario"
                                label="Destinatario"
                                :items="listaUsuarios"
                                item-text="nombre"
                                item-value="id"
                                :rules="[() => !!datosContactar.idDestinatario ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-account"
                            >                                
                            </v-select>
                            <v-text-field
                                v-model="datosContactar.motivo"
                                label="Motivo"
                                outlined
                                :rules="[() => !!datosContactar.motivo ||'Requerido']"
                                prepend-inner-icon="fas fa-question-circle"
                            >
                            </v-text-field>
                            <v-textarea
                                v-model="datosContactar.descripcion"
                                outlined
                                color="secondary"
                                label="Descripcion"
                            >
                            </v-textarea>
                            <div class="pb-1" style="text-align:right;">  
                                <v-btn 
                                :small="$vuetify.breakpoint.smAndDown ? true : false"
                                rounded color="warning" @click="resetContactar()">
                                    <h4 class="white--text">Cancelar</h4>
                                </v-btn>
                                <v-btn 
                                :small="$vuetify.breakpoint.smAndDown ? true : false"
                                rounded color="secondary" class="ml-2" @click="contactar()" >
                                    <h4 class="white--text">Enviar</h4>
                                </v-btn>
                            </div>
                        </v-form>
                            
                    </v-container>
                
            </v-card>
        </v-dialog> 
    </v-container>
</template>

<script>
import NosotrosComponent from '@/components/Globales/NosotrosComponent.vue';
import { mapState, mapMutations } from 'vuex'
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

            dialogContactar: false,
            keyContactar: 1,
            listaRoles: [],
            listaUsuarios: [], 

            datosContactar: [{rolDestinatario:''},{idDestinatario:''},{motivo:''},{descripcion:''}],
            
        }
    },
    methods:{
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
        },

        resetFormCrearUsuario () {
            this.$refs.contactar.reset();
        },
        resetContactar(){
            this.resetFormCrearUsuario();
            this.datosContactar.rolDestinatario = '';
            this.datosContactar.idDestinatario = '';
            this.datosContactar.motivo = '';
            this.datosContactar.descripcion = '';
            this.keyDialogCreacion++;
            this.dialogContactar = false;
        },

        contactar(){
            // inserte codigo aqui
        },
    }
}
</script>
