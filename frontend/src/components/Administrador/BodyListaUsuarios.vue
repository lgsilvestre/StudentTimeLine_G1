<template>
    <v-card
        class="mx-auto my-10"
        max-width="70%"        
    >
        <v-img
            class="mx-auto white--text align-end justify-center"
            width="100%"
            height="180px"       
            src="@/assets/Globales/background-panel-07.jpg"            
            >                    
            <v-card-title class="white--text" style="font-size: 200%;text-shadow: #555 2px 2px 3px;">     
                <v-icon class="mx-3" color="white">fas fa-users</v-icon>    

                <!-- Titulo -->
                <strong> Lista Usuarios </strong>

                <v-spacer></v-spacer>

                <!-- <v-btn  
                fab
                color="white"
                @click="registrarUsuario()"
                >
                    <v-icon color="red">fas fa-plus</v-icon>
                </v-btn>  -->

                <v-dialog v-model="dialog" persistent max-width="500px">
                    <template v-slot:activator="{ on }">
                        <v-btn
                        fab
                        large
                        bottom
                        left
                        v-on="on"
                        >
                            <v-icon class="mx-2" color="warning">fas fa-plus</v-icon>
                        </v-btn>
                    </template>
                    <v-card
                        class="mx-auto"
                        max-width="800"
                        shaped
                    >
                        <v-card-title
                              class="headline primary text--center"
                              primary-title
                              >
                              <h5 class="white--text ">Registrar Usuario</h5>
                              </v-card-title>

                        <v-card-text class="px-12 mt-10" >
                            <v-form 
                            ref="form"
                            >
                                <v-text-field
                                    class="mx-2"
                                    v-model="datosUsuario.nombre"
                                    label="Nombre de Usuario"
                                    :rules="[() => !!datosUsuario.nombre ||'Requerido']"
                                    outlined
                                    prepend-inner-icon="mdi-account"
                                ></v-text-field>
                                <v-select
                                    class="mx-2"
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
                                <v-select
                                    class="mx-2"
                                    v-model="datosUsuario.role"
                                    label="Rol"
                                    :items="roles"
                                    :rules="[() => !!datosUsuario.role ||'Requerido']"
                                    outlined
                                    prepend-inner-icon="mdi-account-tie"
                                >                                
                                </v-select>
                                <v-text-field
                                    class="mx-2"
                                    v-model="datosUsuario.correo"
                                    label="Correo Electronico"
                                    :rules="reglasEmail"
                                    outlined
                                    prepend-inner-icon="mdi-email"
                                >
                                </v-text-field>
                                <v-text-field
                                    class="mx-2"
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
                                    class="mx-2"
                                    chips
                                    solo
                                    label="Fotografia del Usuario"
                                    placeholder="Seleccionar Imagen"
                                    outlined                                
                                    prepend-inner-icon="mdi-camera"
                                    prepend-icon=""
                                ></v-file-input>   

                                <v-container class="px-10" style="text-align:right;">
                                    <v-btn rounded color="warning" @click="resetRegistrarUsuario">
                                      <h4 class="white--text">Cancelar</h4>
                                    </v-btn>
                                    <v-btn rounded color="primary" class="ml-2" @click="registrarUsuario(datosUsuario)" >
                                      <h4 class="white--text">Registrar</h4>
                                    </v-btn>
                                  </v-container>  
                            </v-form>
                        </v-card-text>
                    </v-card>
                </v-dialog>                
            </v-card-title>                                                                                   
        </v-img>


        <!-- propiedades tablas -->
        <v-data-table        
            :headers="columnas"
            :items="datosAlumnos"
            :search="search"
            :items-per-page="10"            
        >            
            <template v-slot:item.opciones="{ item }">
                <!-- boton para modificar usuario seleccionado -->
                <v-icon     
                    class="mx-1 justify-center"           
                    @click="modificarUsuario(item)"
                >
                fas fa-edit
                </v-icon>
                <!-- boton para eliminar usuario seleccionado -->
                <v-icon
                    class="mx-1 justify-center"            
                    @click="eliminarUsuario(item)"
                >
                fas fa-trash-alt
                </v-icon>
            </template>
        </v-data-table>
    </v-card>
</template>

<script>
import { mapState, mapMutations } from 'vuex'
import axios from 'axios'

export default {    
    data() {
        name: 'listaEstudiantes'
        return{
            dialog: false,
            mostrar: false, 
            datosUsuario:[ {nombre:''},{escuela:''},{role:''},{correo:''},{contrasena:''} ,{imagen:''}],  
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
                {text:'Opciones', value:'opciones'},
            ],
            datosAlumnos:[

                /* Datos de prueba */
                {nombre: 'pinky', escuela: 'Ingenieria Civil en Computacion', role: 'admin', correo: 'mpizarro16@utalca.cl'},
                {nombre: 'pinky', escuela: 'Ingenieria Civil en Computacion', role: 'admin', correo: 'mpizarro16@utalca.cl'},
                {nombre: 'pinky', escuela: 'Ingenieria Civil en Computacion', role: 'admin', correo: 'mpizarro16@utalca.cl'},
                {nombre: 'pinky', escuela: 'Ingenieria Civil en Computacion', role: 'admin', correo: 'mpizarro16@utalca.cl'},
                {nombre: 'pinky', escuela: 'Ingenieria Civil en Computacion', role: 'admin', correo: 'mpizarro16@utalca.cl'},
                {nombre: 'pinky', escuela: 'Ingenieria Civil en Computacion', role: 'admin', correo: 'mpizarro16@utalca.cl'},
            ],
        }

    },
    created () {      
      this.obtenerEscuelas();
    },
    methods: {
        ...mapMutations(['registrarUsuario']),
        validate () {
            if(this.$refs.form.validate()){
                console.log("exito");
                this.resetRegistrarUsuario();
            };
        },
        resetRegistrarUsuario(){
        this.dialog = false;
        this.datosUsuario.nombre='';
        this.datosUsuario.escuela='';
        this.datosUsuario.role='';
        this.datosUsuario.correo='';
        this.datosUsuario.contrasena='';
        this.datosUsuario.imagen='';
        this.$refs.form.resetValidation();
      },

      obtenerEscuelas(){
            this.listaEscuelaAux = [];
            var url = 'http://127.0.0.1:8000/api/v1/escuela';
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                for (let index = 0; index < result.data.length; index++) {
                const element = result.data[index];
                let escuela = {
                    id: element.id,
                    nombre: element.nombre,
                };
                // console.log(escuela);
                this.listaEscuelaAux[index]=escuela;
                }
                this.listaEscuela = this.listaEscuelaAux;
            }
            );
      },
    }
}
</script>