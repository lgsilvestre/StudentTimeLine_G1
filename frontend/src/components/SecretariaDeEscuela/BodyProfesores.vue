<template>
    <v-container>
        <v-row>
            <v-col cols="12" md="2">
            </v-col>
            <v-col cols="12" md="8">
            <v-card>
                <v-img
                    class="mx-auto white--text align-end justify-center"
                    width="100%"
                    height="180px"       
                    src="@/assets/Globales/fondo3.jpg"        
                    >                    
                    <v-card-title class="white--text" style="font-size: 200%;text-shadow: #555 2px 2px 3px;">     
                        <v-icon class="mx-3" color="white">fas fa-chalkboard-teacher</v-icon>    

                        <!-- Titulo -->
                        <strong>Profesores</strong>
                        <v-spacer></v-spacer>

                        <!-- Ventana emergente que muestra los profesores deshabilitados -->
                        <v-dialog v-model="profesoresEliminados" fullscreen transition="dialog-bottom-transition">
                            <template v-slot:activator="{ on }">
                                <v-btn
                                fab
                                large
                                bottom
                                left
                                v-on="on"
                                @click="obtenerProfesoresDeshabilitados"
                                >
                                    <v-icon class="mx-2" color="secondary">fas fa-trash-restore-alt</v-icon>
                                </v-btn>
                            </template>
                            <v-toolbar color="primary">
                                <v-btn icon dark @click="resetDialogProfesoresDeshabilitados">
                                    <v-icon>mdi-close</v-icon>
                                </v-btn>
                                <v-toolbar-title class="white--text"> <strong>Lista de Usuarios Eliminados</strong></v-toolbar-title>
                            </v-toolbar>
                            <v-card> 
                                <v-row>
                                    <v-col cols="12" md="2">
                                    </v-col>
                                    <v-col cols="12" md="8">
                                        <v-card 
                                            class="mx-auto" 
                                            shaped
                                        >
                                            <v-img
                                                class="mx-auto white--text align-end justify-center"
                                                width="100%"
                                                height="180px"       
                                                src="@/assets/Globales/fondo3.jpg"        
                                            >
                                            <v-card-title class="white--text" style="font-size: 200%;text-shadow: #555 2px 2px 3px;">     
                                                <v-icon class="mx-3" color="white">fas fa-chalkboard-teacher</v-icon> 
                                                <strong>Profesores Deshabilitados</strong>
                                            </v-card-title>
                                            </v-img>  
                                            <v-data-table        
                                                :headers="columnas"
                                                :items="listaProfesoresEliminados"
                                                :loading="cargando"
                                                :items-per-page="10"
                                            >            
                                                <template v-slot:item.opciones="{ item }">
                                                <!-- boton para deshabilitar el profesor seleccionado -->
                                                    <v-btn color="white" fab small depressed >
                                                        <v-icon
                                                            color="secondary"         
                                                            @click="mostrarHabilitarProfesor(item)"
                                                        >
                                                        fas fa-arrow-alt-circle-up
                                                        </v-icon>
                                                    </v-btn>
                                                </template>
                                            </v-data-table>
                                        </v-card>
                                    </v-col>
                                    <v-col cols="12" md="2">
                                    </v-col>
                                </v-row>
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
                                        <v-btn rounded color="warning" class=" mb-4 "  @click="dialogHabilitar = false">
                                            <h4 class="white--text">Cancelar</h4>
                                        </v-btn>
                                        <v-btn rounded color="secondary"   class=" mb-4 ml-2 mr-5" @click="habilitarProfesor()">
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
                    :items-per-page="10"
                >            
                    <template v-slot:item.opciones="{ item }">
                    <!-- boton para deshabilitar el profesor seleccionado -->
                        <v-btn color="white" fab small depressed >
                            <v-icon
                                color="warning"         
                                @click="EliminarProfesor(item)"
                            >
                            fas fa-trash-alt
                            </v-icon>
                        </v-btn>
                    </template>
                </v-data-table>
            </v-card>
            </v-col>
            <v-col cols="12" md="2">
            </v-col>
        </v-row>
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
                {text:'Nombre', value:'nombre',align: '',sortable: false},
                {text:'Escuela', value:'escuela', align: '',sortable: false},                            
                {text:'Correo', value:'correo', align: '',sortable: false},
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
            var url = 'http://127.0.0.1:8000/api/v1/usuario';
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
                this.listaProfesores = this.listaProfesoresAux;
            }
            ).catch((error)=>{
                if (error.message == 'Network Error') {
                    this.alertaError = true;
                    this.cargando = false;
                    this.textoAlertas = "Error al cargar los datos, intente mas tarde.";
                }
                else{
                    if (error.response.data.success == false) {
                        if(error.response.data.code == 101){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
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
            var url = 'http://127.0.0.1:8000/api/v1/usuario/disabled';
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
                console.log(error)
                if (error.message == 'Network Error') {
                    this.alertaError = true;
                    this.cargando = false;
                    this.textoAlertas = "Error al cargar los datos, intente mas tarde.";
                }
                else{
                    if (error.response.data.success == false) {
                        if(error.response.data.code == 101){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
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
            var url = 'http://127.0.0.1:8000/api/v1/usuario/'+this.datosUsuario.id;
                axios.delete(url,this.$store.state.config)
                .then((result)=>{
                if (result.data.success == true) {
                    this.obtenerProfesores();
                    this.resetEliminarprofesor(); 
                    this.alertaExito = true;
                    this.textoAlertas = "Se elimino el usuario con exito "
                }
                }).catch((error)=>{
                    if (error.message == 'Network Error') {
                        console.log(error)
                        this.alertaError = true;
                        this.textoAlertas = "Error al eliminar el usuario, intente mas tarde."
                    }
                    else{
                        if (error.response.data.success == false) {
                            if(error.response.data.code == 701){
                                console.log(error.response.data.code +' '+ error.response.data.message);
                                console.log(error.response.data);
                                this.textoAlertas = error.response.data.message;
                                this.alertaError = true;
                            }
                            if(error.response.data.code == 702){
                                console.log(error.response.data.code +' '+ error.response.data.message);
                                console.log(error.response.data);
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
            var url =`http://127.0.0.1:8000/api/v1/usuario/restore/${this.datosUsuario.id}`;
            axios.post(url,null,this.$store.state.config)
            .then((result)=>{
                console.log("USUARIO RESTAURADO")
                console.log(result)
            if (result.data.data.usuario==true) {                
                this.obtenerProfesoresDeshabilitados();
                this.dialogHabilitar = false;
                this.alertaExito = true;
                this.textoAlertas = "Es usuario esta habilitado nuevamente.";
            }
            }).catch((error)=>{
                //falta el manejo de errores para implementar las alertas
            });
        }
    }
}
</script>