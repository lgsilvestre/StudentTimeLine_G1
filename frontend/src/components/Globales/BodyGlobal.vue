<template>
    <v-container  fluid >
        <v-row   class="align-center justify-center" >
            <!-- Alertas -->
            <v-snackbar v-model="alertaCorrecto" :timeout="timeout"  bottom
            color="success"
            left
            class="mb-1 pb-12 pr-0 mr-0">
            <div>
                <strong>{{aletaText}}</strong>
            </div>
                <v-btn color="white" elevation="0" x-small fab
                @click="alertaCorrecto = !alertaCorrecto"
                > 
                    <v-icon color="secondary">fas fa-times</v-icon>
                </v-btn>
            </v-snackbar>

            <v-snackbar v-model="alertaError" :timeout="timeout"  bottom
            color="warning"
            left
            class="mb-1 pb-12 pr-0 mr-0">
            <div>
                <strong>{{aletaText}}</strong>
            </div>
                <v-btn color="white" elevation="0" x-small fab
                @click="alertaError = !alertaError"
                > 
                    <v-icon color="secondary">fas fa-times</v-icon>
                </v-btn>
            </v-snackbar>


            <v-col cols="12" md="1">
                </v-col>
                <v-col  cols="12" md="3">
                   <v-card elevation="1"  min-width="350px" color=""> 
                        <v-card-title
                        class="headline primary text--center"
                        primary-title>
                            <h5 class="white--text ">Perfil de usuario</h5>
                        </v-card-title>
                        <v-container fluid class="px-10 text-center">
                            <v-avatar size="100">
                                <img
                                    src="https://randomuser.me/api/portraits/men/85.jpg"
                                > 
                            </v-avatar>
                        </v-container >
                        <v-divider></v-divider>
                        <v-container fluid class="px-5 text-left">
                            <p class="font-weight-black">Nombre: {{ datosUsuario.nombre }} </p>
                            <p class="font-weight-black">Rol: {{ datosUsuario.rol}}</p>
                            <p class="font-weight-black">Escuela:  {{datosUsuario.escuela  }}</p>
                            <p class="font-weight-black">Correo: {{ datosUsuario.email }}</p>

                        </v-container>

                    </v-card>

                </v-col>
                <v-col cols="12" md="2"></v-col>
                <v-col cols="12" md="4">
                    <v-card elevation="1" shaped>
                    <v-card-title  class="headline primary text--center" primary-title > 
                        <h5 class="white--text ">Modificar Usuario</h5>
                            </v-card-title>
                                <v-form  @submit.prevent="modificarUsuario" class=" px-8 pt-4 "  >
                                        <v-text-field v-model="datosUsuarioModificar.nombre" label="Nombre de usuario" outlined
                                          color="secondary"
                                          :rules="[() => !!datosUsuario.nombre ]"
                                          prepend-inner-icon="mdi-account"
                                          
                                        ></v-text-field>

                                        <v-select  v-model="datosUsuarioModificar.escuela"
                                        :items="listaEscuela"
                                        item-text="nombre"
                                        item-value="id"
                                        label="Escuela"
                                        outlined
                                        prepend-inner-icon="mdi-school"
                                        v-show="datosUsuario.rol == 'admin' "
                                        ></v-select>

                                        <v-select v-model="datosUsuarioModificar.role"
                                        label="Rol" 
                                        :items="roles"
                                        outlined
                                        prepend-inner-icon="mdi-account-tie"
                                        v-show="datosUsuario.rol == 'admin' "
                                        ></v-select>
                                      <v-file-input  accept="image/png, image/jpeg, image/bmp" 
                                        label="Seleccione una imagen"
                                        color="secondary"
                                        outlined
                                        prepend-icon=""   
                                        prepend-inner-icon="mdi-camera"
                                        v-model="datosUsuarioModificar.imagen">
                                        </v-file-input>

                                      <v-text-field 
                                          v-model="datosUsuarioModificar.correo"
                                          label="Correo Electronico"
                                          outlined
                                          color="secondary"
                                          prepend-inner-icon="mdi-email"
                                        hint="ejemplo@utalca.cl"
                                          
                                      ></v-text-field>

                                      <v-text-field v-model="datosUsuarioModificar.contrasena" label="Contraseña "
                                        :prepend-inner-icon= "mostrar ? 'mdi-eye' : 'mdi-eye-off'"
                                        :type="mostrar ? 'text' : 'password'"
                                        outlined
                                        color="secondary"
                                        hint="Al menos 8 caracteres"
                                        @click:prepend-inner="mostrar = !mostrar"
                                      ></v-text-field>

                                      <div style="text-align:right;">
                                          
                                                <v-btn rounded color="primary" class="mb-4 ml-2"    type="submit">
                                                    <h4 class="white--text">Modificar</h4>
                                                </v-btn>
                                      </div>
                              </v-form> 


                          </v-card>

                </v-col>
                <v-col cols="12" md="2">
                </v-col>
            </v-row>
      </v-container> 
    
   
</template>

<script>
import { mapState,mapMutations } from 'vuex'
import axios from 'axios'

export default {
    data() {
        return {
            alertaCorrecto: false,
            alertaError: false,
            aletaText: '',
            timeout: 4000,

            mostrar: false, 
            datosUsuarioModificar:[ {nombre:''},{escuela:''},{role:''},{correo:''},{contrasena:''} ,{imagen:''}],
            datosUsuario:[], 
            datosUsuarioAux:[],
            // miUsuario: null, 
            listaEscuela:[
                { text: 'ID',align: 'start',value: 'id',sortable: false},
                { text: 'Nombre', value: 'nombre',sortable: false, },                
            ],            
            listaEscuelaAux:[],
            roles: ['Administrador', 'Secretaría de Escuela', 'Profesor'],   
            // ==================================
            // variables para la modificacion de usuario
            listaUsuarios:[],
            listaUsuariosAux:[],
        }
    },
    computed:{
        ...mapState(['usuario']),   
    },
     created() {
         
        this.obtenerEscuelas();
        this.obtenerUsuario();
     },
    methods:{
        obtenerUsuario(){
            var url =`http://127.0.0.1:8000/api/v1/usuario/${this.$store.state.usuario.user.id}`;
            axios.get(url,this.$store.state.config)
            .then((result)=>{
            if (result.statusText=='OK') {
                this.datosUsuarioAux=result.data;
                if (this.datosUsuarioAux == "admin") {
                    this.datosUsuarioAux.role= this.roles[0];
                };
                if (this.datosUsuarioAux.rol  == "secretaria de escuela") {
                    this.datosUsuarioAux.rol= this.roles[1];
                };
                if (this.datosUsuarioAux.rol  == "profesor") {
                    this.datosUsuarioAux.role= this.roles[1];
                };
                this.listaEscuela.forEach(element => {
                    if(element.id == this.datosUsuarioAux.escuela){
                        this.datosUsuarioAux.escuela = element.nombre;
                    }
                });

                this.datosUsuario = this.datosUsuarioAux           
            }
            }).catch((err)=>{
                console.log(err)
            });
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
                    this.listaEscuelaAux[index]=escuela;
                    }
                    this.listaEscuela = this.listaEscuelaAux;
                }
                );
      },

      modificarUsuario(){
            var correo = '';
            correo= this.datosUsuarioModificar.correo;
            var contrasena  =  '';
            contrasena = this.datosUsuarioModificar.contrasena;
            // validamos que el correo puede ser null o segun la regla establecida
            if( /.+@utalca.cl/.test(correo) || correo == null || correo == ''){
                if(contrasena == null || contrasena =='' || contrasena.length >= 8 ){
                    var aux;
                    if ( this.datosUsuarioModificar.role == "Administrador") {
                        aux = "admin"
                    }; 
                    if ( this.datosUsuarioModificar.role == "Secretaría de Escuela") {
                        aux = "secretaria de escuela"
                    };
                    if ( this.datosUsuarioModificar.role == "Profesor") {
                        aux = "profesor"
                    };
                    var url =`http://127.0.0.1:8000/api/v1/usuario/${this.datosUsuario.id}`;
                    let put ={
                        "nombre": this.datosUsuarioModificar.nombre,
                        "escuela": this.datosUsuarioModificar.escuela,
                        "role": aux,
                        "foto": null,
                        "email":correo,
                        "password": contrasena,
                    }
                    axios.put(url,put,this.$store.state.config)
                    .then((result)=>{
                    if (result.statusText=='OK') {
                         this.obtenerUsuario();
                        this.resetModificacionUsuario();
                        this.alertaCorrecto = true;
                         this.aletaText='La modificación fue exitosa.';
                        console.log('se modifico correctamente')
                    }
                    }).catch((err)=>{
                        console.log(err);
                        this.resetModificacionUsuario();
                    });
                }else{
                    this.alertaError= true;
                   this.aletaText='La contraseña es incorrecta.';

                }
                // this.resetModificacionUsuario();
            }else{
                console.log('el correo es invalido00000'+correo)
                this.alertaError = true;
                this.aletaText='el correo es invalido.';
            }

    },
        resetModificacionUsuario(){
            this.datosUsuarioModificar.nombre='';
            this.datosUsuarioModificar.escuela='';
            this.datosUsuarioModificar.role='';
            this.datosUsuarioModificar.correo='';
            this.datosUsuarioModificar.contrasena='';
            this.datosUsuarioModificar.imagen=null;
            this.alertaCorrecto =false;
            this.alertaError =false;
            this.aletaText =''
            
         },
    }
}
</script>