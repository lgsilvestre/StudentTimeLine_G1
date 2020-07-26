<template>
    <v-container>
        <v-row >
            <v-col cols="12" md="1"></v-col>
            <v-col cols="12" md="10">
                <v-card >
                    <v-img class="mx-auto white--text align-end justify-center"
                        width="100%" height="180px"       
                        src="@/assets/Globales/fondo3.jpg" >                    
                        <v-card-title class="white--text" style="padding:0;">     
                            <!-- Titulo -->
                            <v-row class="px-5 ">
                                <v-col cols="12" class="pt-1" >
                                    <strong :style=" $vuetify.breakpoint.smAndDown ? 'font-size: 140%;' : 'font-size: 180%;'" style="text-shadow: #000000 3px 3px 4px;" > Usuarios</strong>
                                </v-col>
                                <v-col  cols="7" sm="9" md="9" class="align-self-end" >
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
                                    
                                    <!-- Formulario Registrar Usuario -->
                                    <v-dialog v-model="dialog" persistent max-width="500px" :key="keyDialogCreacion">
                                        <template v-slot:activator="{ on }">
                                            <v-btn 
                                            :small="$vuetify.breakpoint.smAndDown ? true : false"
                                            @click="dialog = true"
                                            fab bottom left v-on="on" >
                                                <v-icon class="mx-2" color="warning">fas fa-plus</v-icon>
                                            </v-btn>
                                        </template>
                                        <span><strong>Registrar Usuario</strong></span>
                                    </v-tooltip>
                                    <!-- Formulario Registrar Usuario -->
                                    <v-dialog v-model="dialog" persistent max-width="500px" :key="keyDialogCreacion">
                                        
                                        <v-card class="mx-auto" max-width="500" >
                                            <v-card-title class="headline primary text--center" primary-title >
                                                <h5 class="white--text ">Registrar Usuario</h5>
                                            </v-card-title>
                                                <v-container class="px-5 mt-5">
                                                    <v-text-field
                                                        v-model="datosUsuario.nombre"
                                                        label="Nombre de Usuario"
                                                        :rules="[() => !!datosUsuario.nombre ||'Requerido']"
                                                        outlined
                                                        prepend-inner-icon="mdi-account"
                                                    ></v-text-field>
                                                    <v-select
                                                        v-model="datosUsuario.escuela"
                                                        label="Escuela"
                                                        :items="listaEscuela"
                                                        item-text="nombre"
                                                        item-value="id"
                                                        :rules="[() => !!datosUsuario.escuela ||'Requerido']"
                                                        outlined
                                                        prepend-inner-icon="mdi-school"
                                                    >                                
                                                    </v-select>
                                                    <v-select v-show="datosUsuario.role!='Profesor'"
                                                        v-model="datosUsuario.escuelaAux"
                                                        label="Escuela Secundaria"
                                                        :items="listaEscuela"
                                                        item-text="nombre"
                                                        item-value="id"
                                                        outlined
                                                        prepend-inner-icon="mdi-school"
                                                    >                                
                                                    </v-select>
                                                    <v-select
                                                        v-model="datosUsuario.role"
                                                        label="Rol"
                                                        :items="roles"
                                                        :rules="[() => !!datosUsuario.role ||'Requerido']"
                                                        outlined
                                                        prepend-inner-icon="mdi-account-tie"
                                                    >                                
                                                    </v-select>
                                                    <v-text-field
                                                        v-model="datosUsuario.correo"
                                                        label="Correo Electronico"
                                                        :rules="reglasEmail"
                                                        outlined
                                                        prepend-inner-icon="mdi-email"
                                                    >
                                                    </v-text-field>
                                                    <v-text-field
                                                        v-model="datosUsuario.contrasena"
                                                        :prepend-inner-icon= "mostrar ? 'mdi-eye' : 'mdi-eye-off'"
                                                        :type="mostrar ? 'text' : 'password'"
                                                        :rules="reglas"
                                                        label="Contraseña"
                                                        outlined
                                                        hint="Al menos 8 caracteres"
                                                        @click:prepend-inner="mostrar = !mostrar"                              
                                                    >
                                                    </v-text-field>
                                                    <v-file-input                                      
                                                        @change="convertirImagen"
                                                        chips
                                                        solo
                                                        label="Fotografia del Usuario"
                                                        placeholder="Seleccionar Imagen"
                                                        outlined                                
                                                        prepend-inner-icon="mdi-camera"
                                                        prepend-icon=""
                                                    ></v-file-input>   
                                                    <div class="pb-1" style="text-align:right;">  
                                                        <v-btn 
                                                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                                                        rounded color="warning" @click="resetRegistrarUsuario()">
                                                            <h4 class="white--text">Cancelar</h4>
                                                        </v-btn>
                                                        <v-btn 
                                                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                                                        rounded color="secondary" class="ml-2" @click="registrarUsuario()" >
                                                            <h4 class="white--text">Registrar</h4>
                                                        </v-btn>
                                                    </div>  
                                                </v-container>
                                            
                                        </v-card>
                                    </v-dialog> 
                                    
                                    <v-tooltip bottom color="primary">
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn 
                                            :small="$vuetify.breakpoint.smAndDown ? true : false"
                                            v-bind="attrs"
                                            v-on="on"
                                            class="ml-2" fab bottom left @click="obtenerListaUsuariosEliminados" >
                                                <v-icon class="mx-2" color="secondary">fas fa-trash-restore-alt</v-icon>
                                            </v-btn>
                                        </template>
                                        <span><strong>Recuperar Usuario</strong></span>
                                    </v-tooltip>
                                    <v-dialog 
                                    v-model="dialogListaUsuariosEliminado" fullscreen   transition="dialog-bottom-transition" >
                                        <v-card class="mx-auto my-10 " max-width="100%" style="display: block; background-color:#F7FFF7;">
                                            <v-toolbar dark color="primary">
                                            <v-spacer></v-spacer>
                                            <v-btn 
                                            rounded depressed color="primary" @click="dialogListaUsuariosEliminado = false">
                                                <strong> Cerrar </strong>
                                                <v-icon class="ml-1">mdi-close</v-icon>
                                            </v-btn>
                                            </v-toolbar>
                                            <v-container style="background-color: #F7FFF7;">
                                                <v-row>
                                                    <v-col cols="12" md="1"></v-col>
                                                    <v-col cols="12" md="10" >
                                                        <v-card elevation="1 " >
                                                        <v-img class="mx-auto white--text align-end justify-center"  
                                                            width="100%" height="180px"       
                                                            src="@/assets/Globales/fondo3.jpg" >     
                                                            <v-card-title class="white--text" style="padding:0;">
                                                            <v-row class="px-5">
                                                                <v-col cols="12"  >
                                                                    <strong :style=" $vuetify.breakpoint.smAndDown ? 'font-size: 140%;' : 'font-size: 180%;'" style="text-shadow: #000000 3px 3px 4px;" > Usuarios Eliminados</strong>
                                                                </v-col>
                                                                <v-col  cols="7" sm="9" md="9" class="align-self-end" >
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
                                                                <v-col  cols="5" sm="3" md="3" class="align-self-end" style="text-align:right;">
                                                                    <v-tooltip bottom color="primary">
                                                                    <template v-slot:activator="{ on }">
                                                                        <v-btn
                                                                        class="ml-2"
                                                                        fab
                                                                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                                                                        bottom
                                                                        left
                                                                        v-on="on"
                                                                        >
                                                                            <v-icon  color="secondary">fas fa-envelope</v-icon>
                                                                        </v-btn>
                                                                    </template>
                                                                    <span><strong>Contactar</strong></span>
                                                                    </v-tooltip>
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
                                                        rounded=""
                                                        clearable
                                                        dense
                                                        solo
                                                        class="px-5 py-2 -sm-flex d-md-none"
                                                        color="secondary"
                                                        background-color="white"
                                                        ></v-text-field>
                                                        <v-data-table  
                                                            :headers="columnas" 
                                                            :items="listaUsuariosEliminados"
                                                            :search="buscar2" 
                                                            :loading="cargando" 
                                                            :items-per-page="10" 
                                                            class="elevation-1 "
                                                            >            
                                                            <template v-slot:item.opciones="{ item }">
                                                            <!-- boton para modificar usuario seleccionado -->
                                                            <v-tooltip bottom color="primary">
                                                                <template v-slot:activator="{ on }">
                                                                <v-btn color="white" fab small depressed class="mr-2 py-2" v-on="on" @click="restaurarUsuarioEliminado(item)">
                                                                    <v-icon color="secondary"  >
                                                                        fas fa-trash-restore-alt
                                                                    </v-icon>
                                                                </v-btn>
                                                                </template>
                                                                <span><strong>Recuperar Usuario</strong></span>
                                                            </v-tooltip>
                                                            </template>
                                                        </v-data-table>
                                                        </v-card>
                                                    </v-col>
                                                    <v-col cols="12" md="1"></v-col>
                                                </v-row>
                                                
                                            </v-container>
                                        
                                            
                                        </v-card>
                                    </v-dialog>
                                    <v-dialog  v-model="dialogRestaurarUsuarioEliminado" ref="form" persistent max-width="500px">
                                        <v-card class="mx-auto" max-width="500"  >
                                            <v-card-title class="headline primary text--center" primary-title >
                                                <h5 class="white--text ">Restaurar Usuario</h5>
                                                    </v-card-title> 
                                                    <!-- <v-container fluid class=" text-left"> -->
                                                    <v-card-title class="text-justify" :style="$vuetify.breakpoint.smAndDown ? 'font-size: 90%;' :'font-size: 110%;'">Esta seguro que desea restaurar el siguiente Usuario?</v-card-title>
                                                    <v-card-text>Nombre : {{ this.datosUsuario.nombre }}</v-card-text>
                                                    <v-card-text>Rol : {{ this.datosUsuario.role }}</v-card-text>
                                                    <v-card-text>Email : {{ this.datosUsuario.correo }}</v-card-text>
                                                    <!-- </v-container > -->
                                                    <div style="text-align:right;">
                                                        <v-btn 
                                                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                                                        rounded color="warning" class=" mb-4 "  @click="dialogRestaurarUsuarioEliminado = false">
                                                            <h4 class="white--text">Cancelar</h4>
                                                        </v-btn>
                                                        <v-btn 
                                                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                                                        rounded color="secondary"   class=" mb-4 ml-2 mr-5" @click="restaurarUsuario()">
                                                            <h4 class="white--text">Restaurar</h4>
                                                        </v-btn>
                                                    </div> 
                                        </v-card>
                                    </v-dialog>
                                </v-col>
                            </v-row>
                            <!-- Formulario Modificar Usuario -->
                            <v-dialog v-model="modUsuarioActivo" persistent max-width="500px" transition="scroll-y-reverse-transition">
                                <v-card elevation="1">
                                    <v-card-title  class="headline primary text--center" primary-title > 
                                        <h5 class="white--text ">Modificar Usuario</h5>
                                    </v-card-title>
                                    <v-container class="px-5 mt-5">
                                        <v-text-field v-model="datosUsuario.nombre" label="Nombre de usuario" outlined
                                            color="secondary"
                                            :rules="[() => !!datosUsuario.nombre ||'Requerido']"
                                            prepend-inner-icon="mdi-account"
                                        ></v-text-field>

                                        <v-select  v-model="datosUsuario.escuela"
                                            :items="listaEscuela"
                                            item-text="nombre"
                                            item-value="id"
                                            label="Escuela"
                                            outlined
                                            :small-chips="$vuetify.breakpoint.smAndDown ? true : false"
                                            :rules="[() => !!datosUsuario.escuela ||'Requerido']"
                                            prepend-inner-icon="mdi-school"
                                        ></v-select>
                                        <v-select  v-model="datosUsuario.escuelaAux"
                                            :items="listaEscuela"
                                            item-text="nombre"
                                            item-value="id"
                                            label="Escuela Secundaria"
                                            outlined
                                            :small-chips="$vuetify.breakpoint.smAndDown ? true : false"
                                            prepend-inner-icon="mdi-school"
                                        ></v-select>

                                        <v-select v-model="datosUsuario.role"
                                            label="Rol" 
                                            :items="roles"
                                            :rules="[() => !!datosUsuario.role ||'Requerido']"
                                            outlined
                                            prepend-inner-icon="mdi-account-tie"
                                            ></v-select>

                                        <v-file-input  accept="image/png, image/jpeg, image/bmp" 
                                            label="Seleccione una imagen"
                                            color="secondary"
                                            outlined
                                            @change="convertirImagen"
                                            prepend-icon=""   
                                            prepend-inner-icon="mdi-camera"
                                            >
                                        </v-file-input>

                                        <v-text-field 
                                            v-model="datosUsuario.correo"
                                            label="Correo Electronico"
                                            :rules="reglasEmail"
                                            outlined
                                            color="secondary"
                                            prepend-inner-icon="mdi-email"
                                        ></v-text-field>

                                        <v-text-field v-model="datosUsuario.contrasena" label="Contraseña "
                                            :prepend-inner-icon= "mostrar ? 'mdi-eye' : 'mdi-eye-off'"
                                            :type="mostrar ? 'text' : 'password'"
                                            outlined
                                            color="secondary"
                                            hint="Al menos 8 caracteres"
                                            @click:prepend-inner="mostrar = !mostrar"
                                        ></v-text-field>

                                        <div style="text-align:right;" class="mb-1 " >
                                            <v-btn 
                                            :small="$vuetify.breakpoint.smAndDown ? true : false"
                                            rounded color="warning"    @click="resetModificacionUsuario">  
                                                <h4 class="white--text">Cancelar</h4>
                                            </v-btn>
                                            <v-btn 
                                            :small="$vuetify.breakpoint.smAndDown ? true : false"
                                            rounded color="secondary" class=" ml-2"    @click="modificarUsuario">
                                                <h4 class="white--text">Modificar</h4>
                                            </v-btn>
                                        </div>
                                    </v-container> 
                                </v-card>                        
                            </v-dialog>

                            <v-dialog v-model="dialogEliminar" ref="form" persistent max-width="500px" transition="scroll-y-reverse-transition">
                                <v-card class="mx-auto" max-width="500px"  >
                                    <v-card-title
                                        class="headline primary text--center"
                                        primary-title
                                        >
                                        <h5 class="white--text ">Eliminar Usuario</h5>
                                        </v-card-title> 
                                        <!-- <v-container fluid class=" text-left"> -->
                                        <v-card-title class="text-justify" :style="$vuetify.breakpoint.smAndDown ? 'font-size: 90%;' :'font-size: 110%;'">Esta seguro que desea eliminar el siguiente Usuario?</v-card-title>
                                        <v-card-text>Nombre : {{ this.datosUsuario.nombre }}</v-card-text>
                                        <v-card-text>Rol : {{ this.datosUsuario.role }}</v-card-text>
                                        <v-card-text>Email : {{ this.datosUsuario.correo }}</v-card-text>
                                        <!-- </v-container > -->
                                        <div style="text-align:right;">
                                            <v-btn 
                                            :small="$vuetify.breakpoint.smAndDown ? true : false"
                                            rounded color="warning" class=" mb-4 "  @click="dialogEliminar = false">
                                                <h4 class="white--text">Cancelar</h4>
                                            </v-btn>
                                            <v-btn 
                                            :small="$vuetify.breakpoint.smAndDown ? true : false"
                                            rounded color="secondary"   class=" mb-4 ml-2 mr-5" @click="eliminarUsuario()">
                                                <h4 class="white--text">Eliminar</h4>
                                            </v-btn>
                                        </div> 
                                </v-card>
                            </v-dialog>                
                        </v-card-title>                                                                                   
                    </v-img>

                    <!-- propiedades tablas -->
                    <v-data-table  :headers="columnas" :items="listaUsuarios"
                        :search="buscar" :loading="cargando" :items-per-page="10"  >            
                        <template v-slot:item.opciones="{ item }" >
                            <!-- boton para modificar usuario seleccionado -->
                            <v-tooltip bottom color="primary">
                                <template v-slot:activator="{ on }">
                                    <v-btn color="white" fab small depressed class="mr-2 py-2"  v-on="on" @click="MostrarPanelModificar(item)">
                                        <v-icon color="primary"  >
                                            fas fa-edit
                                        </v-icon>
                                    </v-btn>
                                </template>
                                <span><strong>Modificar Usuario</strong></span>
                            </v-tooltip>
                            <!-- boton para eliminar usuario seleccionado -->
                            <v-tooltip bottom color="primary">
                                <template v-slot:activator="{ on }">
                                    <v-btn color="white" fab small depressed class="mr-2 py-2" v-on="on" @click="EliminarUsuario(item)">
                                        <v-icon color="warning"  >
                                            fas fa-trash-alt
                                        </v-icon>
                                    </v-btn>
                                </template>
                                <span><strong>Eliminar Usuario</strong></span>
                            </v-tooltip>    
                        </template>
                    </v-data-table>
                </v-card>

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
            </v-col>
            <v-col cols="12" md="1"></v-col>
        </v-row>  

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
            timeout: 4000,
            /*  ----------- */
            dialogListaUsuariosEliminado:false,
            dialogRestaurarUsuarioEliminado:false,
            buscar: '',
            buscar2: '',
            dialog: false,
            mostrar: false, 
            datosUsuario:[ {nombre:''},{escuela:''},{escuelaAux:''},{role:''},{correo:''},{contrasena:''} ,{imagen:null}],  
            listaEscuela:[
                { text: 'ID',align: 'start',value: 'id',sortable: false},
                { text: 'Nombre', value: 'nombre',sortable: false, },                
            ],            
            listaEscuelaAux:[],
            roles: ['Administrador', 'Secretaría de Escuela', 'Profesor'],   
            reglas:[
                value => !!value || 'Requerido.',
                value => (value && value.length >= 8) || 'Minimo 8 characters',
            ],
            reglasEmail: [
                v => !!v || 'E-mail is required',
                v => /.+@utalca.cl/.test(v) || 'E-mail must be valid',
            ],
            search:'',
            columnas:[
                {text:'Nombre', value:'nombre'},
                {text:'Escuela', value:'escuela'},
                {text:'Rol', value:'role'},                             
                {text:'Correo', value:'correo'},
                {text:'Opciones', value:'opciones',sortable: false},
            ],
            // ==================================
            // variables para la modificacion de usuario
            listaUsuarios:[],
            listaUsuariosAux:[],
            modUsuarioActivo: false,
            dialogEliminar: false,
            cargando: true,

            //Varibles para el listado de alumnos eliminados
            listaUsuariosEliminados:[],
            
            keyDialogCreacion: 2,

            keyDialogModificar: 1,
        }
    },
    created () {   
        this.obtenerEscuelas();   
        this.obtenerUsuarios();        
    },
    methods: {
        /* ...mapMutations(['registrarUsuario']), */
        validate () {
            if(this.$refs.form.validate()){
                this.resetRegistrarUsuario();
            };
        },
        obtenerListaUsuariosEliminados(){
             this.dialogListaUsuariosEliminado = true;
            this.listaUsuariosAux = [];
            var aux;
            var url = 'http://127.0.0.1:8000/api/v1/usuario/disabled';
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                for (let index = 0; index < result.data.data.usuarios.length; index++) {
                    const element = result.data.data.usuarios[index];
                    let usuario = {
                        id: element.id,
                        nombre: element.nombre,
                        role: element.rol,
                        imagen: element.imagen,
                        correo: element.email,   
                        escuela: element.nombre_escuela,
                    };                     
                    
                    this.listaUsuariosAux[index]=usuario;
                }
                this.listaUsuariosEliminados = this.listaUsuariosAux;
            }
            ).catch((error)=>{
                console.log(error)
            });

        },
        restaurarUsuarioEliminado(item){
            this.datosUsuario.id= item.id;
            this.datosUsuario.nombre= item.nombre;
            this.datosUsuario.escuela= item.escuela;
            this.datosUsuario.imagen= item.imagen;
            this.datosUsuario.correo= item.correo;
            this.datosUsuario.contrasena= item.contrasena;
            if (item.role == "admin") {
                this.datosUsuario.role= this.roles[0];
            };
            if (item.role  == "secretaria de escuela") {
                this.datosUsuario.role= this.roles[1];
            };
            if (item.role  == "profesor") {
                this.datosUsuario.role= this.roles[1];
            };
            this.dialogRestaurarUsuarioEliminado = true;


        },
        restaurarUsuario(){
            this.dialogRestaurarUsuarioEliminado= false;
             var url =`http://127.0.0.1:8000/api/v1/usuario/restore/${this.datosUsuario.id}`;
            axios.post(url,null,this.$store.state.config)
            .then((result)=>{
            if (result.data.success == true) {
                this.obtenerListaUsuariosEliminados();
                this.obtenerUsuarios(); 
                this.alertaExito = true;
                this.textoAlertas = result.data.message
            }
            }).catch((error)=>{
                console.log(error);
                // if (error.message == 'Network Error') {
                //     console.log(error)
                //     this.alertaError = true;
                //     this.textoAlertas = "Error al modificar el usuario, intente mas tarde."
                // }
                // else{
                //     if (error.response.data.success == false) {
                //         if(error.response.data.code == 601){
                //             console.log(error.response.data.code +' '+ error.response.data.message);
                //             console.log(error.response.data);
                //             this.textoAlertas = error.response.data.message;
                //             this.alertaError = true;
                //         }
                //         if(error.response.data.code == 602){
                //             console.log(error.response.data.code +' '+ error.response.data.message);
                //             console.log(error.response.data);
                //             this.textoAlertas = error.response.data.message;
                //             this.alertaError = true;
                //         }
                //         if(error.response.data.code == 603){
                //             console.log(error.response.data.code +' '+ error.response.data.message);
                //             console.log(error.response.data);
                //             this.textoAlertas = error.response.data.message;
                //             this.alertaError = true;
                //         }
                //         if(error.response.data.code == 604){
                //             console.log(error.response.data.code +' '+ error.response.data.message);
                //             console.log(error.response.data);
                //             this.textoAlertas = error.response.data.message;
                //             this.alertaError = true;
                //         }
                //     }
                // }
            });
        },


        /* Metodo que reinicia los campos del formulario de registrar usuario, asi como las validaciones */
        resetRegistrarUsuario(){
            this.dialog = false;
            this.datosUsuario.nombre='';
            this.datosUsuario.escuela='';
            this.datosUsuario.role='';
            this.datosUsuario.correo='';
            this.datosUsuario.contrasena='';
            this.datosUsuario.imagen=null;
            this.keyDialogCreacion++;
        },

        obtenerEscuelas(){
            this.listaEscuelaAux = [];
            var url = 'http://127.0.0.1:8000/api/v1/escuela';
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                for (let index = 0; index < result.data.data.escuelas.length; index++) {
                const element = result.data.data.escuelas[index];
                let escuela = {
                    id: element.id,
                    nombre: element.nombre,
                };
                // console.log(escuela);
                this.listaEscuelaAux[index]=escuela;
                }
                this.listaEscuela = this.listaEscuelaAux;
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
        /**
         * Obtiene una lista de todos los usuarios registrados en la base de datos.
         * Desde el bakend no envian: contraseña y (rol) aun esta por definir.
         */
        obtenerUsuarios(){
            this.cargando = true;
            this.listaUsuariosAux = [];
            var aux;
            var url = 'http://127.0.0.1:8000/api/v1/usuario';
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                for (let index = 0; index < result.data.data.usuarios.length; index++) {
                    const element = result.data.data.usuarios[index];
                    let usuario = {
                        id: element.id,
                        nombre: element.nombre,
                        role: element.rol,
                        imagen: element.imagen,
                        correo: element.email,   
                        escuela: element.escuela,
                    };                         
                    
                    this.listaUsuariosAux[index]=usuario;
                }
                this.cargando = false;
                this.listaUsuarios = this.listaUsuariosAux;
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

        /* Metodo para registrar Usuarios en la base de datos
            Originalmente estaba en /store/index.js, pero he decidico moverlo aca para facilitar el manejo de las variables utilizadas.
         */
        registrarUsuario() {            
            var aux;
            if (this.datosUsuario.role == "Administrador") {
                aux = "admin"
            };
            if (this.datosUsuario.role == "Secretaría de Escuela") {
                aux = "secretaria de escuela"
            };
            if (this.datosUsuario.role == "Profesor") {
                aux = "profesor"
                this.datosUsuario.escuelaAux=null
            };
            let post = {
                "foto": this.datosUsuario.imagen,
                "nombre": this.datosUsuario.nombre,
                "escuela": this.datosUsuario.escuela,
                "escuelaAux": this.datosUsuario.escuelaAux,
                "rol": aux,
                "email": this.datosUsuario.correo,
                "password": this.datosUsuario.contrasena,
            }
            var url = 'http://127.0.0.1:8000/api/v1/usuario';
            console.log(post);
            axios.post(url, post, this.$store.state.config)
            .then((result) => {
                this.alertaExito = true;
                this.textoAlertas = "Se creó el usuario con exito."
                this.resetRegistrarUsuario()
                this.obtenerUsuarios(); 
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    console.log(error)
                    this.alertaError = true;
                    this.textoAlertas = "Error al modificar el usuario, intente mas tarde."
                    this.resetRegistrarUsuario();
                }
                else{
                    if (error.response.data.success == false) {
                        if(error.response.data.code == 301){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;      
                            this.resetRegistrarUsuario();
                        }
                        if(error.response.data.code == 302){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;  
                            this.resetRegistrarUsuario();   
                        }
                    }
                }                
            });
        },

    // Funcion que convierte la imagen a base64 para poder almacenarla en la base de datos.
        convertirImagen(e){
            if(e != null){
                let image = e;
                let reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {                    
                    this.datosUsuario.imagen = e.target.result;
                }
            }
        },

        /**
       * Abre el panel para modificar los datos de usuario, 
       * este panel no tendra registrado la contraseña, ni tampoco el rol,
       * este ultimo debido a que (admin, profesor, secretaria de escuela) son diferentes a los que mostramos,
       * para solucionar este problema, se deferan definir nuevamente los roles.
       */
        MostrarPanelModificar(item){
            this.modUsuarioActivo = true;
            this.datosUsuario.id= item.id;
            this.datosUsuario.nombre= item.nombre;            
            this.datosUsuario.imagen= item.imagen;
            this.datosUsuario.correo= item.correo;
            this.datosUsuario.contrasena= item.contrasena;            
            if (item.role == "admin") {
                this.datosUsuario.role= this.roles[0];
            };
            if (item.role  == "secretaria de escuela") {
                this.datosUsuario.role= this.roles[1];
            };
            if (item.role  == "profesor") {
                this.datosUsuario.role= this.roles[1];
            };
            for(var numEscuela = 0; numEscuela < this.listaEscuela.length; numEscuela++){                        
                if(item.escuela == this.listaEscuela[numEscuela].nombre){                                                   
                    this.datosUsuario.escuela = this.listaEscuela[numEscuela].id;
                }
            };  
            
        },

        resetModificacionUsuario(){
            this.modUsuarioActivo = false;
            this.datosUsuario.nombre='';
            this.datosUsuario.escuela='';
            this.datosUsuario.role='';
            this.datosUsuario.correo='';
            this.datosUsuario.contrasena='';
            this.datosUsuario.imagen=null;
            this.keyDialogModificar--;
        },
        modificarUsuario(){
            var aux;
            if ( this.datosUsuario.role == "Administrador") {
                aux = "admin"
            };
            if ( this.datosUsuario.role == "Secretaría de Escuela") {
                aux = "secretaria de escuela"
            };
            if ( this.datosUsuario.role == "Profesor") {
                aux = "profesor"
            };
            
            var url =`http://127.0.0.1:8000/api/v1/usuario/${this.datosUsuario.id}`;
            let put ={
                "nombre": this.datosUsuario.nombre,
                "escuela": this.datosUsuario.escuela,
                "role": aux,
                "foto": this.datosUsuario.imagen,
                "email":this.datosUsuario.correo,
                "password": this.datosUsuario.contraseña,
            }
            axios.put(url,put,this.$store.state.config)
            .then((result)=>{
            if (result.statusText=='OK') {
                this.alertaExito = true;
                this.textoAlertas = "Se modificó el usuario con exito."
                this.obtenerUsuarios(); 
                this.resetModificacionUsuario();
            }
            }).catch((error)=>{                
                if (error.message == 'Network Error') {
                    console.log(error)
                    this.alertaError = true;
                    this.textoAlertas = "Error al modificar el usuario, intente mas tarde."
                }
                else{
                    if (error.response.data.success == false) {
                        if(error.response.data.code == 601){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;
                            this.resetModificacionUsuario();
                        }
                        if(error.response.data.code == 602){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;
                            this.resetModificacionUsuario();
                        }
                        if(error.response.data.code == 603){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;
                            this.resetModificacionUsuario();
                        }
                        if(error.response.data.code == 604){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;
                            this.resetModificacionUsuario();
                        }
                    }
                }
            });

        },
        resetEliminarUsuario(){
            this.dialogEliminar = false;
            this.datosUsuario.nombre='';
            this.datosUsuario.escuela='';
            this.datosUsuario.role='';
            this.datosUsuario.correo='';
            this.datosUsuario.contrasena='';
            this.datosUsuario.imagen=null;            
        },

        eliminarUsuario(){
            var url = 'http://127.0.0.1:8000/api/v1/usuario/'+this.datosUsuario.id;
                axios.delete(url,this.$store.state.config)
                .then((result)=>{
                if (result.statusText=='OK') {
                    this.obtenerUsuarios();
                    this.resetEliminarUsuario(); 
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
        EliminarUsuario(item){
            this.datosUsuario.id= item.id;
            this.datosUsuario.nombre= item.nombre;
            this.datosUsuario.escuela= item.escuela;
            this.datosUsuario.imagen= item.imagen;
            this.datosUsuario.correo= item.correo;
            this.datosUsuario.contrasena= item.contrasena;
            if (item.role == "admin") {
                this.datosUsuario.role= this.roles[0];
            };
            if (item.role  == "secretaria de escuela") {
                this.datosUsuario.role= this.roles[1];
            };
            if (item.role  == "profesor") {
                this.datosUsuario.role= this.roles[1];
            };
            this.dialogEliminar = true;
        },
    }
}
</script>