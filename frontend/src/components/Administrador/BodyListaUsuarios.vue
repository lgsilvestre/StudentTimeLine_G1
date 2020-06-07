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
                <strong> Lista Usuarios </strong>

                <v-spacer></v-spacer>



                <v-dialog v-model="dialog" persistent max-width="500px">
                    <template v-slot:activator="{ on }">
                        <v-btn
                        fab
                        large
                        bottom
                        left
                        v-on="on"
                        >
                            <v-icon class="mx-2" color="red">fas fa-plus</v-icon>
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
                                    <v-btn rounded color="red" @click="resetRegistrarUsuario">
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

            <v-dialog v-model="modUsuarioActivo" persistent max-width="500px">
                <v-card elevation="1" shaped>
                    <v-card-title  class="headline primary text--center" primary-title > 
                        <h5 class="white--text ">Modificar Usuario</h5>
                            </v-card-title>
                                <v-form @submit.prevent="modificarUsuario" class=" px-10 pt-8 "  >
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
                                        :rules="[() => !!datosUsuario.escuela ||'Requerido']"
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
                                        prepend-icon=""   
                                        prepend-inner-icon="mdi-camera"
                                        v-model="datosUsuario.imagen">
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

                                      <div style="text-align:right;">
                                          <v-btn rounded color="red"   class="mb-4 "  @click="resetModificacionUsuario">  
                                                    <h4 class="white--text">Cancelar</h4>
                                            </v-btn>
                                                <v-btn rounded color="primary" class="mb-4 ml-2"    type="submit">
                                                    <h4 class="white--text">Modificar</h4>
                                                </v-btn>
                                      </div>
                              </v-form> 


                          </v-card>
                        
                        </v-dialog>

                        <v-dialog v-model="dialogEliminar" persistent max-width="450px">
                            <v-card class="mx-auto" max-width="450"  >
                                <v-card-title
                                    class="headline primary text--center"
                                    primary-title
                                    >
                                    <h5 class="white--text ">Eliminar Usuario</h5>
                                    </v-card-title> 
                                    <!-- <v-container fluid class=" text-left"> -->
                                    <v-card-title class="text-justify" style="font-size: 100%;">Esta seguro que desea eliminar el siguiente Usuario?</v-card-title>
                                    <v-card-text>Nombre : {{ this.datosUsuario.nombre }}</v-card-text>
                                    <v-card-text>Rol : {{ this.datosUsuario.role }}</v-card-text>
                                    <v-card-text>Email : {{ this.datosUsuario.correo }}</v-card-text>
                                    <!-- </v-container > -->
                                    <div style="text-align:right;">
                                        <v-btn rounded color="red" class=" mb-4 "  @click="dialogEliminar = false">
                                            <h4 class="white--text">Cancelar</h4>
                                        </v-btn>
                                        <v-btn rounded color="primary"   class=" mb-4 ml-2 mr-2" @click="eliminarUsuario()">
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
            :items="listaUsuarios"
            :search="search"
            :items-per-page="10"            
        >            
            <template v-slot:item.opciones="{ item }">
                <!-- boton para modificar usuario seleccionado -->
                <v-icon     
                    class="mx-1 justify-center"           
                    @click="MostrarPanelModificar(item)"
                >
                fas fa-edit
                </v-icon>
                <!-- boton para eliminar usuario seleccionado -->
                <v-icon
                    class="mx-1 justify-center"            
                    @click="EliminarUsuario(item)"
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
            // ==================================
            // variables para la modificacion de usuario
            listaUsuarios:[],
            listaUsuariosAux:[],
            modUsuarioActivo: false,
            dialogEliminar: false,
            // datosAlumnos:[

            //     /* Datos de prueba */
            //     {nombre: 'pinky', escuela: 'Ingenieria Civil en Computacion', role: 'admin', correo: 'mpizarro16@utalca.cl'},
            //     {nombre: 'pinky', escuela: 'Ingenieria Civil en Computacion', role: 'admin', correo: 'mpizarro16@utalca.cl'},
            //     {nombre: 'pinky', escuela: 'Ingenieria Civil en Computacion', role: 'admin', correo: 'mpizarro16@utalca.cl'},
            //     {nombre: 'pinky', escuela: 'Ingenieria Civil en Computacion', role: 'admin', correo: 'mpizarro16@utalca.cl'},
            //     {nombre: 'pinky', escuela: 'Ingenieria Civil en Computacion', role: 'admin', correo: 'mpizarro16@utalca.cl'},
            //     {nombre: 'pinky', escuela: 'Ingenieria Civil en Computacion', role: 'admin', correo: 'mpizarro16@utalca.cl'},
            // ],
        }

    },
    created () {      
        this.obtenerUsuarios();
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
            this.datosUsuario.imagen=null;
            // this.$refs.form.resetValidation();
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
      /**
       * Obtiene una lista de todos los usuarios registrados en la base de datos.
       * Desde el bakend no envian: contraseña y (rol) aun esta por definir.
       */
       obtenerUsuarios(){
            this.listaUsuariosAux = [];
            var url = 'http://127.0.0.1:8000/api/v1/usuario';
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                for (let index = 0; index < result.data.length; index++) {
                    const element = result.data[index];
                    let usuario = {
                        id: element.id,
                        nombre: element.nombre,
                        role: element.rol,
                        imagen: element.imegen,
                        correo: element.email,
                        escuela: element.escuela,
                    };
                    this.listaUsuariosAux[index]=usuario;
                }
                this.listaUsuarios = this.listaUsuariosAux;
            }
            );
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
        },

        resetModificacionUsuario(){
            this.modUsuarioActivo = false;
            this.datosUsuario.nombre='';
            this.datosUsuario.escuela='';
            this.datosUsuario.role='';
            this.datosUsuario.correo='';
            this.datosUsuario.contrasena='';
            this.datosUsuario.imagen=null;
            
         },
        modificarUsuario(){
            console.log('modificar usuario')
             console.log(this.datosUsuario)
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
                "rol": aux,
                "foto": null,
                "email":this.datosUsuario.correo,
                "password": this.datosUsuario.contraseña,
            }

            console.log(put);
            axios.put(url,put,this.$store.state.config)
            .then((result)=>{
            if (result.statusText=='OK') {
                //  console.log(result.data)
                 this.obtenerUsuarios(); 
                 this.resetModificacionUsuario();
            }
            }).catch((err)=>{
                console.log(err)
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
                }
                });
            
        },
        EliminarUsuario(item){
            // console.log(item.id);
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