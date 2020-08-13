<template>
    <v-container>
        <v-row>
            <v-col cols="12" md="1">
            </v-col>
            <v-col cols="12" md="10">
            <v-card>
                <v-img
                    class="mx-auto white--text align-end justify-center"
                    width="100%"
                    height="180px"       
                    src="@/assets/Globales/fondo3.jpg"        
                    >                    
                    <v-card-title class="white--text" style="padding:0;" >     
                        <!-- Titulo -->
                        <v-row class="px-5">
                            <v-col cols="12" class="pt-1">
                                <strong :style=" $vuetify.breakpoint.smAndDown ? 'font-size: 140%;' : 'font-size: 180%;'" style="text-shadow: #000000 3px 3px 4px;" >Profesores</strong>
                            </v-col>
                            <v-col cols="7" sm="9" md="9" class="align-self-end" >
                                <v-text-field
                                v-model="buscar"
                                append-icon="mdi-magnify"
                                label="Buscar"
                                hide-details
                                outlined
                                clearable
                                dense
                                solo
                                rounded
                                color="secondary"
                                background-color="white"
                                ></v-text-field>
                            </v-col>
                            <v-col  cols="5" sm="3" md="3" class="align-self-end" style="text-align:right;">
                                <v-tooltip bottom color="primary">
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                        fab
                                        bottom
                                        class="mr-2"
                                        left
                                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                                        v-on="on"
                                        @click="dialogAviso = true"
                                        >
                                            <v-icon class="mx-2" color="secondary">fas fa-bell</v-icon>
                                        </v-btn>
                                    </template>
                                    <span><strong>Aviso Profesores</strong></span>
                                </v-tooltip>
                                <v-tooltip bottom color="primary">
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                        fab
                                        bottom
                                        left
                                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                                        v-on="on"
                                        @click="obtenerProfesoresDeshabilitados"
                                        >
                                            <v-icon class="mx-2" color="secondary">fas fa-trash-restore-alt</v-icon>
                                        </v-btn>
                                    </template>
                                    <span><strong>Recuperar Profesor</strong></span>
                                </v-tooltip>
                            </v-col>
                        </v-row>
                        <!-- Ventana emergente que muestra los profesores deshabilitados -->
                        <v-dialog v-model="profesoresEliminados" fullscreen transition="dialog-bottom-transition">
                            <v-card class="mx-auto my-10 " max-width="100%" style="display: block; background-color:#F7FFF7;">  
                                <v-toolbar dark color="primary">
                                    <v-spacer></v-spacer>
                                    <v-btn 
                                    rounded depressed color="primary" 
                                    @click="resetDialogProfesoresDeshabilitados">
                                        <strong> Cerrar </strong>
                                        <v-icon class="ml-1">mdi-close</v-icon>
                                    </v-btn>
                                </v-toolbar>
                                <v-container style="background-color: #F7FFF7;">
                                    <v-row>
                                        <v-col cols="12" md="1">
                                        </v-col>
                                        <v-col cols="12" md="10">
                                            <v-card 
                                                elevation="1"
                                            >
                                            <v-img
                                                class="mx-auto white--text align-end justify-center"
                                                width="100%"
                                                height="180px"       
                                                src="@/assets/Globales/fondo3.jpg"        
                                            >
                                            <v-card-title class="white--text" style="padding:0;"> 
                                            <v-row  class="px-5">
                                                <v-col cols="12" class="pt-1">
                                                    <strong :style=" $vuetify.breakpoint.smAndDown ? 'font-size: 140%;' : 'font-size: 180%;'" style="text-shadow: #000000 3px 3px 4px;" >Profesores Eliminados</strong>
                                                </v-col>
                                                <v-col cols="7" sm="9" md="9" class="align-self-end" >
                                                    <v-text-field
                                                    v-model="buscar2"
                                                    append-icon="mdi-magnify"
                                                    label="Buscar"
                                                    hide-details
                                                    outlined
                                                    clearable
                                                    dense
                                                    solo
                                                    rounded
                                                    color="secondary"
                                                    background-color="white"
                                                    ></v-text-field>
                                                </v-col>
                                            </v-row>
                                            </v-card-title>
                                            </v-img> 
                                                <v-text-field
                                                v-model="buscar2"
                                                append-icon="mdi-magnify"
                                                label="Buscar"
                                                hide-details
                                                outlined
                                                class="px-5 py-2 d-sm-flex d-md-none"
                                                clearable
                                                dense
                                                solo
                                                rounded
                                                color="secondary"
                                                background-color="white"
                                                ></v-text-field>
                                                <v-data-table        
                                                    :headers="columnas"
                                                    :items="listaProfesoresEliminados"
                                                    :search="buscar2"
                                                    :loading="cargando"
                                                    :items-per-page="10"
                                                >            
                                                    <template v-slot:[`item.opciones`]="{ item }">
                                                        <!-- boton para deshabilitar el profesor seleccionado -->
                                                        <v-tooltip bottom color="primary">
                                                            <template v-slot:activator="{ on }">
                                                                <v-btn color="white" fab small depressed >
                                                                    <v-icon
                                                                        color="secondary"  
                                                                        v-on="on"       
                                                                        @click="mostrarHabilitarProfesor(item)"
                                                                    >
                                                                    fas fa-trash-restore-alt
                                                                    </v-icon>
                                                                </v-btn>
                                                            </template>
                                                            <span><strong>Recuperar Profesor</strong></span>
                                                        </v-tooltip>
                                                    </template>
                                                </v-data-table>
                                                
                                            </v-card>
                                        </v-col>
                                        <v-col cols="12" md="1">
                                        </v-col>
                                    </v-row>
                                    
                                </v-container>
                                
                            </v-card>
                        </v-dialog>

                        <!-- Habilitar un profesor -->
                        <v-dialog  v-model="dialogHabilitar" ref="form" persistent max-width="450px">
                            <v-card class="mx-auto" max-width="450"  >
                                <v-card-title
                                    class="headline primary text--center"
                                    primary-title
                                    >
                                    <h5 class="white--text ">Habilitar Profesor</h5>
                                    </v-card-title>                             
                                    <v-card-title class="text-justify" style="font-size: 100%;">Esta seguro que desea habilitar el siguiente Profesor?</v-card-title>
                                    <v-card-text>Nombre : {{ this.datosUsuario.nombre }}</v-card-text>
                                    <v-card-text>Escuela : {{ this.datosUsuario.escuela }}</v-card-text>
                                    <v-card-text>Email : {{ this.datosUsuario.correo }}</v-card-text>

                                    
                                    <div style="text-align:right;">
                                        <v-btn 
                                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                                        rounded color="warning" class=" mb-4 "  @click="dialogHabilitar = false">
                                            <h4 class="white--text">Cancelar</h4>
                                        </v-btn>
                                        <v-btn 
                                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                                        rounded color="secondary"   class=" mb-4 ml-2 mr-5" @click="habilitarProfesor()">
                                            <h4 class="white--text">Habilitar</h4>
                                        </v-btn>
                                    </div> 
                            </v-card>
                        </v-dialog>
                        

                        <!-- Deshabilitar un profesor -->
                        <v-dialog v-model="dialogEliminar" persistent max-width="450px">
                            <v-card class="mx-auto" max-width="450"  >
                                <v-card-title
                                    class="headline primary text--center"
                                    primary-title
                                    >
                                    <h5 class="white--text ">Eliminar Profesor</h5>
                                    </v-card-title> 
                                    <v-card-title class="text-justify" style="font-size: 100%;">Esta seguro que desea eliminar el siguiente Profesor?</v-card-title>
                                    <v-card-text>Nombre : {{ this.datosUsuario.nombre }}</v-card-text>
                                    <v-card-text>Email : {{ this.datosUsuario.correo }}</v-card-text>
                                    <div style="text-align:right;">
                                        <v-btn rounded color="warning" class=" mb-4 "  @click="dialogEliminar = false">
                                            <h4 class="white--text">Cancelar</h4>
                                        </v-btn>
                                        <v-btn rounded color="secondary"   class=" mb-4 ml-2 mr-5" @click="eliminarProfesor()">
                                            <h4 class="white--text">Eliminar</h4>
                                        </v-btn>
                                    </div> 
                            </v-card>
                        </v-dialog>                
                    </v-card-title>                                                                                   
                </v-img>
                <!-- propiedades tablas -->
                <v-data-table        
                    :headers="columnas"
                    :items="listaProfesores"
                    :loading="cargando"
                    :search="buscar"
                    :items-per-page="10"
                >            
                    <template v-slot:[`item.opciones`]="{ item }">
                        <v-tooltip bottom color="primary">
                            <template v-slot:activator="{ on }">
                    <!-- boton para deshabilitar el profesor seleccionado -->
                                <v-btn color="white" fab small depressed v-on="on" @click="EliminarProfesor(item)">
                                    <v-icon
                                        color="warning"         
                                    >
                                    fas fa-trash-alt
                                    </v-icon>
                                </v-btn>
                            </template>
                            <span><strong>Eliminar Profesor</strong></span>
                        </v-tooltip>
                    </template>
                </v-data-table>
            </v-card>
            </v-col>
            <v-col cols="12" md="1">
            </v-col>
        </v-row>

        <v-dialog v-model="dialogAviso" persistent max-width="500px">
            <v-card class="mx-auto" max-width="500" >
                <v-card-title class="headline primary text--center" primary-title >
                    <h5 class="white--text ">Enviar Aviso</h5>
                </v-card-title>
                <v-container class="px-5 mt-5">
                    <v-form ref="aviso" v-model="formAviso" lazy-validation>
                        <v-text-field
                            v-model="datosAviso.motivo"
                            label="Motivo"
                            outlined
                            :rules="[() => !!datosAviso.motivo ||'Requerido']"
                            prepend-inner-icon="fas fa-question-circle"
                        >
                        </v-text-field>
                        <v-textarea
                            v-model="datosAviso.descripcion"
                            outlined
                            color="secondary"
                            :rules="[() => !!datosAviso.descripcion ||'Requerido']"
                            label="Descripcion"
                        >
                        </v-textarea>
                        <div class="pb-1" style="text-align:right;">  
                            <v-btn 
                            :small="$vuetify.breakpoint.smAndDown ? true : false"
                            rounded 
                            color="warning" 
                            @click="resetAviso()"
                            >
                                <h4 class="white--text">Cancelar</h4>
                            </v-btn>
                            <v-btn 
                            :disabled="!formAviso"
                            :loading="cargando"
                            :small="$vuetify.breakpoint.smAndDown ? true : false"
                            rounded 
                            color="secondary" 
                            class="ml-2" 
                            @click="validarAviso()"
                            >
                                <h4 class="white--text">Enviar</h4>
                            </v-btn>
                        </div>
                    </v-form>
                </v-container>
            </v-card>
        </v-dialog>

        <!-- Alertas -->
        <v-snackbar
        v-model="alertaError"
        :timeout=delay
        bottom
        color="warning"
        left
        class="mb-1 pb-12 pr-0 mr-0"
        >
        <div>
            <v-icon color="white" class="mr-2">
            fas fa-exclamation-triangle
            </v-icon>
            <strong>{{textoAlertas}} </strong>
        </div>
        <v-btn
            color="white"
            elevation="0"
            x-small
            fab
            @click="alertaError= ! alertaError"
        > 
            <v-icon color="warning">fas fa-times</v-icon>
        </v-btn>
        </v-snackbar>
        <v-snackbar
        v-model="alertaExito"
        :timeout=delay
        bottom
        color="secondary"
        left
        class="mb-1 pb-12 pr-0 mr-0"
        >
        <div>
            <v-icon color="white" class="mr-2">
            fas fa-check-circle
            </v-icon>
            <strong>{{textoAlertas}}</strong>
        </div>
        <v-btn
            color="white"
            elevation="0"
            x-small
            fab
            @click="alertaExito = ! alertaExito"
        > 
            <v-icon color="secondary">fas fa-times</v-icon>
        </v-btn>
        </v-snackbar>
    </v-container>
</template>

<script>
import { mapState, mapMutations } from 'vuex'
import axios from 'axios'

export default {    
    data() {
        name: 'listaEstudiantes'
        return{
            /* Variables para el uso de las alertas */
            alertaError: false,
            alertaExito: false,
            textoAlertas: '',
            delay: 4000,
            /*  ----------- */
            dialog: false,            
            profesoresEliminados: false,
            mostrar: false, 
            datosUsuario:[ {nombre:''},{escuela:''},{correo:''}],  
            columnas:[
                {text:'Nombre', value:'nombre',align: '',sortable: true},
                {text:'Escuela', value:'escuela', align: '',sortable: true},                            
                {text:'Correo', value:'correo', align: '',sortable: true},
                {text:'Opciones', value:'opciones', align: 'center',sortable: false},
            ],
            // ==================================
            // variables para la modificacion de usuario
            listaProfesores:[],
            listaProfesoresEliminados:[],
            listaProfesoresAux:[],            
            modUsuarioActivo: false,
            dialogEliminar: false,
            dialogHabilitar: false,
            cargando: true,
            buscar2: '',
            buscar:'',

            formAviso: true,
            dialogAviso: false,
            datosAviso: [{motivo:''},{descripcion:''}],
        }
    },
    created () {   
        this.obtenerProfesores();        
    },
    methods: {

        obtenerProfesores(){
            this.cargando = true;
            this.listaProfesoresAux = [];
            var aux;
            var url = this.$store.state.rutaDinamica+'api/v1/usuario';
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                for (let index = 0; index < result.data.data.usuarios.length; index++) {
                    const element = result.data.data.usuarios[index];
                    let usuario = {
                        id: element.id,
                        nombre: element.nombre,
                        correo: element.email,   
                        escuela: element.escuela,
                    };                         
                    this.listaProfesoresAux[index]=usuario;
                }
                this.cargando = false;
                this.listaProfesores = this.listaProfesoresAux;
            }
            ).catch((error)=>{
                if (error.message == 'Network Error') {
                    this.alertaError = true;
                    this.cargando = false;
                    this.textoAlertas = "Error al cargar los datos, inténtelo más tarde.";
                }
                else{
                    if (error.response.data.success == false) {
                        if(error.response.data.code == 101){
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;                            
                        }
                        else{
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true; 
                        }                        
                    }
                }
            });
        },

        /* Metodo que permite obtener todos los profesores deshabilitados a los cuales tenga acceso el usuario */
        obtenerProfesoresDeshabilitados(){
            this.profesoresEliminados = true;
            this.cargando = true;
            this.listaProfesoresAux = [];
            var aux;
            var url = this.$store.state.rutaDinamica+'api/v1/usuario/disabled';
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                for (let index = 0; index < result.data.data.usuarios.length; index++) {
                    const element = result.data.data.usuarios[index];
                    let usuario = {
                        id: element.id,
                        nombre: element.nombre,
                        correo: element.email,   
                        escuela: element.nombre_escuela,
                    };                         
                    this.listaProfesoresAux[index]=usuario;
                }
                this.cargando = false;
                this.listaProfesoresEliminados = this.listaProfesoresAux;

            }
            ).catch((error)=>{
                if (error.message == 'Network Error') {
                    this.alertaError = true;
                    this.cargando = false;
                    this.textoAlertas = "Error al cargar los datos, inténtelo más tarde.";
                }
                else{
                    if (error.response.data.success == false) {
                        if(error.response.data.code == 101){
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;                            
                        }
                        else{
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true; 
                        }                        
                    }
                }
            });
        },

        resetEliminarprofesor(){
            this.dialogEliminar = false;
            this.datosUsuario.nombre='';
            this.datosUsuario.escuela='';
            this.datosUsuario.correo='';
            this.datosUsuario.contrasena='';           
        },

        eliminarProfesor(){
            var url = this.$store.state.rutaDinamica+'api/v1/usuario/'+this.datosUsuario.id;
                axios.delete(url,this.$store.state.config)
                .then((result)=>{
                if (result.data.success == true) {
                    this.obtenerProfesores();
                    this.resetEliminarprofesor(); 
                    this.alertaExito = true;
                    this.textoAlertas = "Se ha eliminado correctamente el usuario."
                }
                }).catch((error)=>{
                    if (error.message == 'Network Error') {
                        this.alertaError = true;
                        this.textoAlertas = "Error al eliminar el usuario, inténtelo más tarde."
                    }
                    else{
                        if (error.response.data.success == false) {
                            if(error.response.data.code == 701){
                                this.textoAlertas = error.response.data.message;
                                this.alertaError = true;
                            }
                            if(error.response.data.code == 702){
                                this.textoAlertas = error.response.data.message;
                                this.alertaError = true;
                            }
                        }
                    }
            });
        },

        EliminarProfesor(item){
            this.datosUsuario.id= item.id;
            this.datosUsuario.nombre= item.nombre;
            this.datosUsuario.escuela= item.escuela;
            this.datosUsuario.imagen= item.imagen;
            this.datosUsuario.correo= item.correo;
            this.datosUsuario.contrasena= item.contrasena;
            this.dialogEliminar = true;
        },

        resetDialogProfesoresDeshabilitados(){
            this.obtenerProfesores();
            this.profesoresEliminados = false;
        },

        mostrarHabilitarProfesor(item){
            this.datosUsuario.id = item.id;
            this.datosUsuario.nombre = item.nombre;
            this.datosUsuario.escuela = item.escuela;
            this.datosUsuario.correo = item.correo;
            this.dialogHabilitar = true;
        },

        /* Metodo que permite habilitar un profesor seleccionado */
        habilitarProfesor(){            
            var url =this.$store.state.rutaDinamica+`api/v1/usuario/restore/${this.datosUsuario.id}`;
            axios.post(url,null,this.$store.state.config)
            .then((result)=>{
                this.obtenerProfesoresDeshabilitados();
                this.dialogHabilitar = false;
                this.alertaExito = true;
                this.textoAlertas = "El usuario ha sido habilitado correctamente.";
            
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    this.alertaError = true;
                    this.textoAlertas = "Error al eliminar el usuario, inténtelo más tarde."
                }
                else{
                    if (error.response.data.success == false) {
                        
                        this.textoAlertas = error.response.data.message;
                        this.alertaError = true;
                        
                    }
                }
            });
        },

              //Funcion que valida los datos ingresados en el Dialog Contactar
        validarAviso(){            
            if(this.$refs.aviso.validate()){
                this.enviarAviso();
            }
            else{
                this.$refs.aviso.validate();
            }
        },
        //Funcion que reinicia los valores usados en el dialog, ademas de las validaciones relacionadas a este.
        resetAviso(){
            this.$refs.aviso.reset();
            this.datosAviso.motivo = '';
            this.datosAviso.descripcion = '';            
            this.dialogAviso = false;
        },
        //Funcion que se encarga de solicitar (a backend) el envio de los distintos correos electronicos
        enviarAviso(){
            this.cargando = true;
            let post ={                
                "motivo": this.datosAviso.motivo,
                "descripcion": this.datosAviso.descripcion,
            };                     
            var url = this.$store.state.rutaDinamica+'api/v1/usuario/recordatorio';
            axios.post(url, post, this.$store.state.config)
            .then((result)=>{       
                    this.cargando = false;
                    this.dialogAviso = false;
                    this.alertaExito = true;
                    this.resetAviso();
                    this.textoAlertas = "Se ha enviado el aviso con éxito."
                }
                ).catch((error)=>{
                    if (error.message == 'Network Error') {
                        this.dialogAviso = false;
                        this.cargando = false;
                        this.alertaError = true;         
                        this.resetAviso();               
                        this.textoAlertas = "Error al cargar los datos, inténtelo más tarde.";
                    }
                    else{
                        if (error.response.data.success == false) {

                            this.dialogAviso = false;
                            this.cargando = false;
                            this.alertaError = true;         
                            this.resetAviso();               
                            this.textoAlertas = error.response.data.message;
                        }
                    }
            })
        },
    }
}
</script>