<template>
    <v-container  fluid >
        <v-row   class="align-center justify-center" >
            <v-col cols="12" md="0"  lg="1" >
            </v-col>
            <v-col  cols="12" md="6" lg="5">
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
                            <strong class="white--text letra" style="text-shadow: #000000 3px 3px 4px;">Perfil</strong>
                        </div>
                        <v-spacer></v-spacer>
                        <v-avatar :size="$vuetify.breakpoint.smAndDown ? 120 : 180" class="borde mt">
                            <img
                                :src="datosUsuario.foto"
                            > 
                        </v-avatar>
                    </v-card-title>
                    </v-img>
                    <v-divider></v-divider>
                    <v-row class="px-5 mt-5">
                        <v-col cols="3">
                            <h3 :style="$vuetify.breakpoint.smAndDown ? 'font-size: 79%' : 'font-size: 100%' ">Nombre</h3>
                        </v-col>
                        <v-col cols="1">
                            <h3 :style="$vuetify.breakpoint.smAndDown ? 'font-size: 79%' : 'font-size: 100%' ">:</h3>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h3 :style="$vuetify.breakpoint.smAndDown ? 'font-size: 79%' : 'font-size: 100%' ">{{ datosUsuario.nombre}}</h3>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3">
                            <h3 :style="$vuetify.breakpoint.smAndDown ? 'font-size: 79%' : 'font-size: 100%' ">Rol</h3>
                        </v-col>
                        <v-col cols="1">
                            <h3 :style="$vuetify.breakpoint.smAndDown ? 'font-size: 79%' : 'font-size: 100%' ">:</h3>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h3 :style="$vuetify.breakpoint.smAndDown ? 'font-size: 79%' : 'font-size: 100%' ">{{ datosUsuario.rol}}</h3>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3">
                            <h3 :style="$vuetify.breakpoint.smAndDown ? 'font-size: 79%' : 'font-size: 100%' ">Escuela</h3>
                        </v-col>
                        <v-col cols="1">
                            <h3 :style="$vuetify.breakpoint.smAndDown ? 'font-size: 79%' : 'font-size: 100%' ">:</h3>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h3 :style="$vuetify.breakpoint.smAndDown ? 'font-size: 79%' : 'font-size: 100%' ">{{datosUsuario.escuela}}</h3>
                        </v-col>
                    </v-row>
                    <v-row class="px-5 pb-5">
                        <v-col cols="3">
                            <h3 :style="$vuetify.breakpoint.smAndDown ? 'font-size: 79%' : 'font-size: 100%' ">Correo</h3>
                        </v-col>
                        <v-col cols="1">
                            <h3 :style="$vuetify.breakpoint.smAndDown ? 'font-size: 79%' : 'font-size: 100%' ">:</h3>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h3 :style="$vuetify.breakpoint.smAndDown ? 'font-size: 79%' : 'font-size: 100%' ">{{ datosUsuario.email}}</h3>
                        </v-col>
                    </v-row>
                    
                </v-card>
            </v-col>
            <v-col cols="12" md="1" lg="1">
            </v-col>
            <v-col cols="12" md="5" lg="4">
                <v-card elevation="1" shaped>
                <v-card-title  class="headline primary text--center" primary-title > 
                    <h5 class="white--text ">Editar Perfil</h5>
                </v-card-title>
                <v-form ref="modUsuario"  v-model="formModificar" lazy-validation @submit.prevent="modificarUsuario" class=" px-5 mt-7" >
                    <v-text-field v-model="datosUsuarioModificar.nombre" label="Nombre de usuario" outlined
                    color="secondary"
                    :rules="reglasNombre"
                    prepend-inner-icon="mdi-account"
                    ></v-text-field>
                    
                    <v-text-field 
                    v-model="datosUsuarioModificar.correo"
                    label="Correo Electronico"
                    outlined
                    color="secondary"
                    prepend-inner-icon="mdi-email"
                    :rules="reglasEmail"
                    hint="ejemplo@utalca.cl"
     
                    ></v-text-field>
                    <v-text-field v-model="datosUsuarioModificar.contrasena" label="Contraseña "
                    :prepend-inner-icon= "mostrar ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="mostrar ? 'text' : 'password'"
                    outlined
                    :rules="reglasContraseña"
                    color="secondary"
                    hint="Al menos 8 caracteres"
                    @click:prepend-inner="mostrar = !mostrar"
                    ></v-text-field>
                    <v-file-input  accept="image/png, image/jpeg, image/bmp" 
                    label="Seleccione una imagen"
                    color="secondary"
                    outlined
                    prepend-icon=""   
                    prepend-inner-icon="mdi-camera"
                    @change="convertirImagen"
                    v-model="datosUsuarioModificar.imagen">
                    </v-file-input>
                    <div style="text-align:right;">
                        <v-btn 
                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                        rounded color="primary" class="mb-4 ml-2" @click="reset"  > 
                            Restablecer
                        </v-btn>
                        <v-btn  
                        :disabled="!formModificar"
                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                        :loading="cargando" rounded color="secondary" class="mb-4 ml-2"    type="submit">
                            <h4 class="white--text">Modificar</h4>
                        </v-btn>
                    </div>
                </v-form> 
                </v-card>
            </v-col>
            <v-col cols="12" lg="1">
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
        color="warning" left class="mb-1 pb-12 pr-0 mr-0">
            <div>
                <v-icon color="white" class="mr-2">
                    fas fa-exclamation-triangle
                </v-icon>
                <strong>{{textoError}}</strong>
            </div>
            
            <v-btn color="white" elevation="0" x-small
            fab @click="alertError = ! alertError" > 
                <v-icon color="warning">fas fa-times</v-icon>
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
            cargando: false,
            formModificar: true,
            datosUsuarioModificar:[ {nombre:''},{correo:''},{contrasena:''} ,{imagen:null}],
            datosUsuario:[], 
            datosUsuarioAux:[],
            roles: ['Administrador', 'Secretaría de Escuela', 'Profesor'],   
            // ==================================
            // variables para la modificacion de usuario
            listaUsuarios:[],
            listaUsuariosAux:[],

            //escuela
            listaEscuela:[{id:''},{nombre:''},{cod:''}],
            miEscuela:null,
            desserts:[],
            dessertsAux:[],
            //prueba de imagen
            imagenMiniatura:null,
            correo:'',
            reglasNombre:[
                v => /^[a-zA-ZÀ-ÿ\u00f1\u00d1 ]+$/.test(v) || 'Nombre no Válido.',
                v => /^[a-zA-ZÀ-ÿ\u00f1\u00d1 ]{3,40}$/.test(v) || 'Largo del Nombre no Válido',
            ],
            reglasEmail: [
                v => /.+@utalca.cl/.test(v) || /.+@alumnos.utalca.cl/.test(v) || 'Correo no Válido', 
            ],
            reglasContraseña:[
                v => /^[a-zA-Z0-9!"#$%&'()*+,\-./:;<=>?@[\\\]^_`{|}~]{8,}$/.test(v)  || 'Contraseña muy corta',
            ],
        }
    },
    computed:{
        ...mapState(['usuario']), 
        
    },
    beforeMount() {
        this.obtenerUsuario();
        
    },
    mounted(){
        this.reset();
    },
    methods:{
        reset () {
            this.$refs.modUsuario.reset();
        },
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
        /**
         * Obtiene la informacino del usuario logeado.
         */
        obtenerUsuario(){
            var url =this.$store.state.rutaDinamica+`api/v1/usuario/${this.$store.state.usuario.usuario.id}/edit`;
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                this.$store.state.usuario.usuario =result.data.data.usuario;
            if (result.data.success == true) {
                this.datosUsuarioAux=result.data.data.usuario;
                //console.log();
                if (this.datosUsuarioAux == "admin") {
                    this.datosUsuarioAux.role= this.roles[0];
                };
                if (this.datosUsuarioAux.rol  == "secretaria de escuela") {
                    this.datosUsuarioAux.rol= this.roles[1];
                };
                if (this.datosUsuarioAux.rol  == "profesor") {
                    this.datosUsuarioAux.role= this.roles[2];
                };
                this.datosUsuario = this.datosUsuarioAux;
                if(this.datosUsuario.rol != "admin"){
                    this.modificar = false;
                };
            }
            }).catch((err)=>{
                if (error.message == 'Network Error') {
                    //console.log(error);
                    state.verificacionLogin= true;
                    state.cargaLogin=false;
                    state.mensajeErrorLogin= 'Error al comunicarse con el servidor, inténtelo más tarde';
                } else {
                    if (error.response.data.success == false) {
                        switch (error.response.data.code) {
                            case 501:
                                //console.log(error.response.data.code +' '+ error.response.data.message);
                                //console.log(error.response.data);
                                this.alertError = true;
                                var mensaje=error.response.data.message;
                                this.textoError=mensaje;
                                break;
                            case 502:
                                //console.log(error.response.data.code +' '+ error.response.data.message);
                                //console.log(error.response.data);
                                this.alertError = true;
                                var mensaje=error.response.data.message;
                                this.textoError=mensaje;
                                break;
                            default:
                                this.alertError = true;
                                var mensaje=error.response.data.message;
                                this.textoError=mensaje;
                                break;
                        }
                    }
                }
            });
        },
        
        /**
         * Modica la informacion del usuario logeado.
         */
        modificarUsuario(){
            // validamos que el correo puede ser null o segun la regla establecida
            // validar correo alumno.talca.cl
            this.cargando = true;
            var url =this.$store.state.rutaDinamica+`api/v1/usuario/${this.datosUsuario.id}`;
            let put ={
                "nombre": this.datosUsuarioModificar.nombre,
                "foto":this.imagenMiniatura,
                "password": this.datosUsuarioModificar.contrasena,
                "email" : this.datosUsuarioModificar.correo,
            }
            axios.put(url,put,this.$store.state.config)
            .then((result)=>{
                if (result.data.success == true){
                    this.obtenerUsuario();
                    this.resetModificacionUsuario();
                    this.cargando = false;
                    this.alertAcept = true;
                    var mensaje=result.data.message;
                    this.textoAcept=mensaje;
                    this.reset();
                }
            }).catch((error)=>{
                //console.log(error);
                //console.log(error.response.data);
                this.resetModificacionUsuario();
                if (error.message == 'Network Error') {
                    //console.log(error);
                    this.cargando = false;
                    this.alertError = true;
                    var mensaje="Se ha modificado correctamente el perfil.";
                    this.textoError=mensaje;
                    this.reset();
                } else 
                if (error.response.data.success == false) {
                    switch (error.response.data.code) {
                    case 601:
                        //console.log(error.response.data.code +' '+ error.response.data.message);
                        //console.log(error.response.data);
                        this.cargando = false;
                        this.alertError = true;
                        var mensaje=error.response.data.message;
                        this.textoError=mensaje;
                        this.reset();
                        break;
                    case 602:
                        //console.log(error.response.data.code +' '+ error.response.data.message);
                        //console.log(error.response.data);
                        this.cargando = false;
                        this.alertError = true;
                        var mensaje=error.response.data.message;
                        this.textoError="El usuario no existe.";
                        this.reset();
                        break;
                    case 603:
                        //console.log(error.response.data.code +' '+ error.response.data.message);
                        //console.log(error.response.data);
                        this.cargando = false;
                        var mensaje=error.response.data.message;
                        this.textoError=mensaje;
                        this.reset();
                        break;
                    case 604:
                        //console.log(error.response.data.code +' '+ error.response.data.message);
                        //console.log(error.response.data);
                        this.cargando = false;
                        this.alertError = true;
                        var mensaje=error.response.data.messagee;
                        this.textoError=mensaje;
                        this.reset()
                        break;
                    default:
                        this.cargando = false;
                        this.alertError = true;
                        var mensaje=error.response.data.message;
                        this.textoError=mensaje;
                        this.reset()
                        break;
                    }
                }
                
            });
        },
        resetModificacionUsuario(){
            this.datosUsuarioModificar.nombre=null;
            this.datosUsuarioModificar.correo=null;
            this.datosUsuarioModificar.contrasena=null;
            this.datosUsuarioModificar.imagen=null;
            this.imagenMiniatura=null;
            this.alertError= false;
            this.textoError= '';
            this.alertAcept= false;
            this.textoAcept= '';
            
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