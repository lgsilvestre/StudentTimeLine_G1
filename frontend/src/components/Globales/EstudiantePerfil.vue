<template>
    <v-container  fluid >
        <v-row >
            <v-col cols="12" md="0"   >
            </v-col>
            <v-col  cols="12" md="5" lg="5">
                <v-card elevation="1" > 
                    <v-img
                        class="mx-auto white--text align-end justify-center"
                        width="100%"
                        src="@/assets/Globales/fondo.jpg"
                    >
                    <v-card-title
                    class="headline  text--center"
                    primary-title>
                        <div class="difuminado">
                            <strong class="white--text letra">Estudiante</strong>
                        </div>
                        <v-spacer></v-spacer>
                        <v-avatar :size="$vuetify.breakpoint.smAndDown ? 100 : 120" class="borde mt">
                            <img
                                src="@/assets/Globales/estudiante4.png"
                            > 
                        </v-avatar>
                    </v-card-title>
                    </v-img>
                    <v-divider></v-divider>
                    <v-row class="px-5 mt-5">
                        <v-col cols="3">
                            <h5>Matricula</h5> 
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{perfilEstudiante.matricula}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3">
                            <h5 >Rut</h5>
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{perfilEstudiante.rut}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3">
                            <h5 >Nombre</h5>
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{ perfilEstudiante.nombre_completo}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3">
                            <h5 >Correo</h5>
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{ perfilEstudiante.correo}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3">
                            <h5 >Ingreso</h5>
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{ perfilEstudiante.anho_ingreso}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3">
                            <h5 >Situacion Academica</h5>
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{ perfilEstudiante.situacion_academica}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3" class="pb-5">
                            <h5 >Escuela</h5>
                        </v-col>
                        <v-col cols="1" class="pb-5">
                            <h5 >:</h5>
                        </v-col >
                        <v-col class="pb-5" :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{ perfilEstudiante.escuela}}</h5>
                        </v-col>
                    </v-row>
                    <div class="pb-5"  style="text-align:center;">
                        <v-btn
                        color="secondary"
                        rounded
                        >Editar</v-btn>
                    </div>
                    
                </v-card>
            </v-col>
            <v-col cols="12" md="7"  lg="1" >
                <div class="pb-5"  style="text-align:center;">
                    <v-btn
                    color="secondary"
                    rounded
                    @click="volverEstudiantes"
                    >volver</v-btn>
                </div>
            </v-col>
        </v-row>
        <!-- Alertas -->
        <!-- alerta de exito de la modificacion -->
        <v-snackbar v-model="alertAcept" :timeout=delay
        bottom color="secondary" left class="mb-1 pb-12 pr-0 mr-0" >
            <div>
                <v-icon color="white" class="mr-2">
                    fas fa-check-circle
                </v-icon>
                <strong>{{textoAcept}}</strong>
            </div>
            <v-btn color="white" elevation="0" x-small
            fab @click="alertAcept = ! alertAcept" > 
                <v-icon color="secondary">fas fa-times</v-icon>
            </v-btn>
        </v-snackbar>
        <!-- alerta de error en la modificacion -->
        <v-snackbar v-model="alertError" :timeout=delay bottom
        color="secondary" left class="mb-1 pb-12 pr-0 mr-0">
            <div>
                <v-icon color="white" class="mr-2">
                    fas fa-exclamation-triangle
                </v-icon>
                <strong>{{textoError}}</strong>
            </div>
            
            <v-btn color="white" elevation="0" x-small
            fab @click="alertError = ! alertError" > 
                <v-icon color="secondary">fas fa-times</v-icon>
            </v-btn>
        </v-snackbar>
    </v-container> 
</template>

<script>
import { mapState,mapMutations } from 'vuex'
import axios from 'axios'

export default {
    data() {
        return {
            alertError: false,
            textoError: '',
            alertAcept: false,
            textoAcept: '',
            delay: 4000,
            mostrar: false, 

        }
    },
    computed:{
        ...mapState(['perfilEstudiante']), 
        
    },
    methods:{
        /**
         * Convierte la imagen cargada a base 64.
         */
        convertirImagen(e){
            this.imagenMiniatura=null;
            if(e != null){
                let image =e;
                let reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e =>{
                    this.imagenMiniatura=e.target.result;
                }
            }  
        },
        volverEstudiantes(){
            this.$router.push({path:'/administrador/estudiantes'});
        },
        
    }
}
</script>
<style scoped>
    .difuminado{
        text-shadow: #555 2px 2px 3px;
    }
    .letra{
        font-size: 125%;
    }
    .borde {
        color:#fff;
        background-color: rgba(0,0,0,0.6);
        border-style: solid; 
        border-color: color;
    }
</style>