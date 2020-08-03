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
                            <v-autocomplete
                                v-model="datosContactar.idDestinatario"
                                label="Administrador"
                                :items="listaAdmin"
                                item-text="nombre"
                                item-value="id"
                                :rules="[() => !!datosContactar.idDestinatario ||'Requerido']"
                                outlined
                                multiple
                                chips
                                small-chips
                                prepend-inner-icon="mdi-account"
                                v-show="datosContactar.rolDestinatario == 'Administrador'"
                            >                                
                            </v-autocomplete>
                            <v-autocomplete
                                v-model="datosContactar.idDestinatario"
                                label="Secretaría de Escuela"
                                :items="listaSecEscuela"
                                item-text="nombre"
                                item-value="id"
                                :rules="[() => !!datosContactar.idDestinatario ||'Requerido']"
                                outlined
                                multiple
                                chips
                                small-chips
                                prepend-inner-icon="mdi-account"
                                v-show="datosContactar.rolDestinatario == 'Secretaría de Escuela'"
                            >                                
                            </v-autocomplete>
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
                                :rules="[() => !!datosContactar.descripcion ||'Requerido']"
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

                <!-- Alertas -->

        <!-- Alerta de Error -->
        <v-snackbar v-model="alertaError" :timeout="timeout"
            bottom color= "warning" left class="pb-12"  >
            <v-icon color="white"   
                class="mr-3"                      
            >
            fas fa-exclamation-triangle 
            </v-icon>
        
            <strong> {{textoAlertas }}</strong>
            <v-btn
                icon
                @click="alertaError = false"
                >
                <v-icon     
                    color="white"                         
                >
                fas fa-times-circle
                </v-icon>                
            </v-btn>
        </v-snackbar>       

        <!-- Alerta de Exito (success) -->

        <v-snackbar v-model="alertaExito" :timeout="timeout" bottom
            color= "secondary" left class="pb-12"  >
            <v-icon class="mr-3"  color="white" >
                fas fa-info-circle  
            </v-icon>
            <strong> {{ textoAlertas }} </strong>
            <v-btn
                icon
                @click="alertaExito = false"
                >
                <v-icon     
                    class="mr-3"
                    color="white"                         
                >
                fas fa-times-circle
                </v-icon>                
            </v-btn>
        </v-snackbar> 
    </v-container>
</template>

<script>
import NosotrosComponent from '@/components/Globales/NosotrosComponent.vue';
import { mapState, mapMutations } from 'vuex'
import axios from 'axios'
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
            listaRoles: ['Administrador','Secretaría de Escuela'],
            listaAdmin: [],
            listaSecEscuela: [],
            listaAdminAux: [],      
            listaSecEscuelaAux: [],      

            datosContactar: [{rolDestinatario:''},{idDestinatario:[]},{motivo:''},{descripcion:''}],

            timeout: 4000,
            textoAlertas: '',
            alertaError: false,
            alertaExito: false,

            
        }
    },
    beforeMount(){
        this.obtenerUsuarios();        
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

        resetFormContactar() {
            this.$refs.contactar.reset();
        },
        resetContactar(){
            this.resetFormContactar();
            this.datosContactar.rolDestinatario = '';
            this.datosContactar.idDestinatario = [];
            this.datosContactar.motivo = '';
            this.datosContactar.descripcion = '';
            this.keyDialogCreacion++;
            this.dialogContactar = false;
        },

        obtenerUsuarios(){            
            this.listaAdminAux = [];
            this.listaSecEscuelaAux = [];
            var c1 = 0;
            var c2 = 0;
            var url = 'http://127.0.0.1:8000/api/v1/usuario/listarEncargados';
            
            axios.get(url,this.$store.state.config)
            .then((result)=>{                
                    for (let index = 0; index < result.data.data.usuarios.length; index++) {
                        const element = result.data.data.usuarios[index];
                        let usuario = {
                            id: element.id,
                            nombre: element.nombre,
                            rol: element.rol,
                        };                   
                        if(usuario.rol == 'admin'){
                            this.listaAdminAux[c1] = usuario;
                            c1++;                            
                        }
                        else if(usuario.rol == 'secretaria de escuela'){
                            this.listaSecEscuelaAux[c2] = usuario;
                            c2++;                            
                        }                    
                    }
                    this.listaAdmin = this.listaAdminAux;                              
                    this.listaSecEscuela = this.listaSecEscuelaAux;                    
                }
                ).catch((error)=>{
                    if (error.message == 'Network Error') {
                        this.alertaError = true;                        
                        this.textoAlertas = "Error al cargar los datos, intente mas tarde.";
                    }
            })
        },

        contactar(){
            
            let post ={
                "destinatarios": this.datosContactar.idDestinatario,
                "motivo": this.datosContactar.motivo,
                "descripcion": this.datosContactar.descripcion,
            };            
            //por definir
            var url = 'http://127.0.0.1:8000/api/v1/usuario/contactar';
            axios.post(url, post, this.$store.state.config)
            .then((result)=>{                
                    this.alertaExito = true;
                    this.textoAlertas = "Se ha enviado el/los correos correctamente."
                }
                ).catch((error)=>{
                    if (error.message == 'Network Error') {
                        this.alertaError = true;                        
                        this.textoAlertas = "Error al cargar los datos, intente mas tarde.";
                    }
            })

        },
    }
}
</script>
