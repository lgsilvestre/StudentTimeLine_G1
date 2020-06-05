<template>
    <v-card
        class="mx-auto my-10"
        max-width="70%"        
    >
        <v-img
            class="mx-auto white--text align-end justify-center"
            height="180px"        
            src="@/assets/Globales/background-panel-07.jpg"            
            >                    
            <v-card-title>     
                <v-icon class="mx-3" color="white">fas fa-users</v-icon>    

                <!-- Titulo -->
                <strong> Lista Usuarios </strong>

                <v-spacer></v-spacer>
                
                 <v-dialog v-model="modUsuarioActivo" persistent max-width="500px">
                          <v-card elevation="1" shaped>
                              <v-card-title
                              class="headline primary text--center"
                              primary-title
                              >
                              <h5 class="white--text ">Modificar Usuario</h5>
                              </v-card-title>
                                <v-form @submit.prevent="modificarUsuario">
                                  <v-container class="px-10 pt-10">

                                      <v-text-field 
                                          v-model="usuario.nombre"
                                          label="Nombre de usuario"
                                          outlined
                                          color="secondary"
                                          prepend-inner-icon="fas fa-scroll"
                                      ></v-text-field>

                                      <v-select
                                        :items="listaEscuela"
                                        item-text="nombre"
                                        item-value="id"
                                        label="Seleccione una opcion"
                                        outlined
                                        v-model="usuario.idEs"
                                        ></v-select>

                                        <v-select
                                        :items="Roles"
                                        item-value="id"
                                        label="Seleccione una opcion"
                                        outlined
                                        v-model="usuario.rol"
                                        ></v-select>


                                      <v-file-input  accept="image/png, image/jpeg, image/bmp" 
                                        label="Seleccione una imagen"
                                        color="secondary"
                                        outlined
                                        prepend-icon=""
                                            
                                        prepend-inner-icon="mdi-camera">
                                        </v-file-input>

                                      <v-text-field 
                                          v-model="usuario.correo"
                                          label="Correo del usuario"
                                          outlined
                                          color="secondary"
                                          prepend-inner-icon="fas fa-scroll"
                                      ></v-text-field>

                                      <v-text-field 
                                          v-model="usuario.contraseña"
                                          label="Contraseña "
                                          outlined
                                          color="secondary"
                                          prepend-inner-icon="fas fa-scroll"
                                      ></v-text-field>
                                      
                                  </v-container>
                                  <v-container class="px-10" style="text-align:right;">

                                    <v-btn rounded color="red"  @click="resetModificacionUsuario">
                                        <h4 class="white--text">Cancelar</h4>
                                    </v-btn>

                                    <v-btn rounded color="primary" class="ml-2"  type="submit">
                                      <h4 class="white--text">Modificar</h4>
                                    </v-btn>
                                  </v-container>
                              </v-form> 


                          </v-card>
                        
                        </v-dialog>
                
            
            
            </v-card-title>                                                                                   
        </v-img>

        <v-card-subtitle>
            <!-- campo de filtrado -->
            <v-text-field
                v-model="search"
                label="Filtrar"
                outlined
                hide-details
            ></v-text-field>
        </v-card-subtitle>
        
        <!-- propiedades tablas -->
        <v-data-table        
            :headers="usuario"
            :items="desserts"
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

            modUsuarioActivo: false,
            dialog: false,
            search:'',
            listaEscuela:[
                { text: 'ID',align: 'start',value: 'id',sortable: false},
                { text: 'Nombre', value: 'nombre',sortable: false, },
                // { text: 'Codigo carrera', value: 'cod_car',sortable: false, },
            ],
            Roles:['admin','secretaria de escuela','profesor'],
            listaEscuelaAux:[],
            usuario:[
                {text:'ID', value:'id'},
                {text:'escuela', value:'idEs'},
                {text:'Nombre', value:'nombre'},
                {text:'Rol', value:'rol'},

                {text:'Foto', value:null},                             
                {text:'Correo', value:'correo'},
                {text:'contraseña', value:'contraseña'},
                {text:'Opciones', value:'opciones'},
            ],
            desserts:[],
            dessertsAux:[],

        }

    },

    created () {
      this.obtenerUsuarios();
      this.obtenerEscuelas()
    },
    

    methods: {
        ...mapMutations(['updateDatosUsuarioPerfil']),

        obtenerUsuarios(){
            this.dessertsAux = [];
            var url = 'http://127.0.0.1:8000/api/v1/usuario';
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                for (let index = 0; index < result.data.length; index++) {
                const element = result.data[index];
                let usuario = {
                    id: element.id,
                    nombre: element.nombre,
                    idEs: element.escuela,
                    rol: element.rol,
                    foto: element.foto,
                    correo: element.email,

                };
                //console.log(escuela);
                this.dessertsAux[index]=usuario;
                }
                this.desserts = this.dessertsAux;
            }
            );
      },
    //   crearUsuario(){
         
    //     this.dessertsAux = [];
    //         var url = 'http://127.0.0.1:8000/api/v1/usuario';
    //         let post ={
    //             nombre: this.usuario.nombre,
    //             escuela: this.usuario.idEs,
    //             rol: this.usuario.rol,
    //             foto: null,
    //             email: this.usuario.correo,
    //             password: this.usuario.contraseña
            
    //         }
    //          console.log(post)
    //         axios.post(url,post,this.$store.state.config)
    //         .then((result)=>{
    //         // console.log(result.statusText);
    //         if (result.statusText=='OK') {
                
    //             this.obtenerUsuarios(); 
    //             this.resetCreacionUsuario();
    //         }
    //         });

    //   },
        MostrarPanelModificar(item){
            this.modUsuarioActivo = true;
            this.usuario.id= item.id
            this.usuario.nombre= item.nombre
            this.usuario.idEs= item.idEs
            this.usuario.rol= item.rol
            this.usuario.foto= item.foto
            this.usuario.correo= item.correo
            this.usuario.contraseña= item.contraseña

           
  

        },

        modificarUsuario(){
            var url =`http://127.0.0.1:8000/api/v1/usuario/${this.usuario.id}`;
            let put ={
                "nombre": this.usuario.nombre,
                "escuela": this.usuario.idEs,
                "role": "admin",

                "foto": null,
                "email": this.usuario.correo,
                "password": this.usuario.contraseña,
            }

            console.log(put);
            axios.put(url,put,this.$store.state.config)
            .then((result)=>{
            if (result.statusText=='OK') {
                this.obtenerUsuarios(); 
                this.resetModificacionUsuario();
            }
            }).catch((err)=>{
                console.log(err)
            });

        },

        eliminarUsuario(item){
            var url = 'http://127.0.0.1:8000/api/v1/usuario/'+item.id;
                axios.delete(url,this.$store.state.config)
                .then((result)=>{
                if (result.statusText=='OK') {
                    this.obtenerUsuarios();
                    this.resetModificacionUsuario(); 
                }
                });
            
        },

         resetModificacionUsuario(){
            this.modUsuarioActivo = false;
            this.usuario.nombre='';
            this.usuario.idEs='';
            this.usuario.rol='';    
            this.usuario.foto=null;
            this.usuario.correo='';
            this.usuario.contraseña=''; 
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