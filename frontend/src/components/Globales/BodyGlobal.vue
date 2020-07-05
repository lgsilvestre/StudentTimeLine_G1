<template>
    <v-container  fluid >
        <v-row   class="align-start justify-center" no-wrap>
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
            <v-snackbar v-model="alertAcept" :timeout=delay bottom
            color="secondary" left class="mb-1 pb-12 pr-0 mr-0">
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


            <v-col cols="12" md="2">
                </v-col>
                <v-col  cols="12" md="3">
                   <v-card elevation="1"  min-width="350px" class="d-flex flex-column flex-wrap"> 
                        <v-card-title
                        class="headline primary text--center"
                        primary-title>
                            <h5 class="white--text ">Perfil de usuario</h5>
                        </v-card-title>
                        <v-container fluid class="px-10 text-center">
                            <v-avatar size="100">
                                <img
                                    :src="datosUsuario.foto"
                                > 
                                <!-- src="https://randomuser.me/api/portraits/men/85.jpg" -->
                            </v-avatar>
                        </v-container >
                        <v-divider></v-divider>
                        <v-container fluid class="px-5 text-center">
                            <p class="font-weight-black">Nombre: {{ datosUsuario.nombre }} </p>
                            <p class="font-weight-black">Rol: {{ datosUsuario.rol}}</p>
                            <p class="font-weight-black">Escuela:  {{datosUsuario.escuela  }}</p>
                            <p class="font-weight-black">Correo: {{ datosUsuario.email }}</p>

                        </v-container>

                    </v-card>

                </v-col>
                <v-col cols="12" md="1"></v-col>
                <v-col cols="12" md="4">
                    <v-card elevation="1" class="d-flex flex-column flex-wrap">
                    <v-card-title  class="headline primary text--center" primary-title > 
                        <h5 class="white--text ">Modificar Usuario</h5>
                            </v-card-title>
                                <v-form  @submit.prevent="modificarUsuario" class=" px-8 pt-4 " >
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
                                        v-show="modificar"
                                        ></v-select>

                                        <v-select v-model="datosUsuarioModificar.role"
                                        label="Rol" 
                                        :items="roles"
                                        outlined
                                        prepend-inner-icon="mdi-account-tie"
                                        v-show="modificar"
                                        ></v-select>
                                      <v-file-input  accept="image/png, image/jpeg, image/bmp" 
                                        label="Seleccione una imagen"
                                        color="secondary"
                                        outlined
                                        prepend-icon=""   
                                        prepend-inner-icon="mdi-camera"
                                        @change="convertirImagen"
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
            alertError: false,
            textoError: '',
            alertAcept: false,
            textoAcept: '',
            delay: 4000,
            modificar: true,

            mostrar: false, 
            datosUsuarioModificar:[ {nombre:''},{escuela:''},{role:''},{correo:''},{contrasena:''} ,{imagen:null}],
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
            var url =`http://127.0.0.1:8000/api/v1/usuario/${this.$store.state.usuario.usuario.id}/edit`;
            axios.get(url,this.$store.state.config)
            .then((result)=>{
            if (result.data.code==500) {
                this.datosUsuarioAux=result.data.data.usuario;
                if (this.datosUsuarioAux == "admin") {
                    this.datosUsuarioAux.role= this.roles[0];
                };
                if (this.datosUsuarioAux.rol  == "secretaria de escuela") {
                    this.datosUsuarioAux.rol= this.roles[1];
                };
                if (this.datosUsuarioAux.rol  == "profesor") {
                    this.datosUsuarioAux.role= this.roles[2];
                };
                //para asignarle un nombre a la 
                this.listaEscuela.forEach(element => {
                    if(element.id == this.datosUsuarioAux.escuela){
                        this.datosUsuarioAux.escuela = element.nombre;
                        //obtenemos toda la informacion de la escuela del usuario
                        this.miEscuela=element;
                    }
                });
                
                this.datosUsuario = this.datosUsuarioAux;
                if(this.datosUsuario.rol != "admin"){
                    this.modificar = false;
                };
            }
            }).catch((err)=>{
                if (error.message == 'Network Error') {
                    console.log(error);
                    state.verificacionLogin= true;
                    state.cargaLogin=false;
                    state.mensajeErrorLogin= 'Error al comunicarse con el servidor, intente más tarde';
                } else {
                    if (error.response.data.success == false) {
                        switch (error.response.data.code) {
                            case 501:
                                console.log(error.response.data.code +' '+ error.response.data.message);
                                console.log(error.response.data);
                                break;
                            case 502:
                                console.log(error.response.data.code +' '+ error.response.data.message);
                                console.log(error.response.data);

                                break;
                            default:
                                break;
                        }
                    }
                }
            });
        },
        /**
         * Obtiene lista de las escuelas registradas.
         */
        obtenerEscuelas(){
            this.dessertsAux = [];
            var url = 'http://127.0.0.1:8000/api/v1/escuela';
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                if (result.data.success == true) {
                    for (let index = 0; index < result.data.data.escuelas.length; index++) {
                        const element = result.data.data.escuelas[index];
                        let escuela = {
                        id: element.id,
                        nombre: element.nombre,
                        cod_car: element.cod_carrera,
                        };
                        this.dessertsAux[index]=escuela;
                }
                    this.listaEscuela = this.dessertsAux;
                    
            }
                
            })
            .catch((error) => {
                console.log(error);
            if (error.message == 'Network Error') {
              console.log(error);
              //this.textoError = 'Error al cargar los datos, intente más tarde'
            } else {
              if (error.response.data.success == false) {
                switch (error.response.data.code) {
                  case 101:
                      console.log(error.response.data.code +' '+ error.response.data.message);
                      console.log(error.response.data);
                      //this.textoError = error.response.data.message;
                      break;
                  default:
                      break;
                }
              }
            }
                
            });
      },
        /**
         * Modica la informacion del usuario logeado.
         */
      modificarUsuario(e){
            var correo = '';
            var contrasena  =  '';
            correo= this.datosUsuarioModificar.correo;
            contrasena = this.datosUsuarioModificar.contrasena;
            // validamos que el correo puede ser null o segun la regla establecida
            if( /.+@utalca.cl/.test(correo) || correo == null || correo == ''){
                if(contrasena == null || contrasena =='' || contrasena.length >= 8 ){
                    //conversion del rol, para guardarla en la base de datos.
                    var aux;
                    if ( this.datosUsuarioModificar.role == "Administrador") {
                        aux = "admin";
                    }; 
                    if ( this.datosUsuarioModificar.role == "Secretaría de Escuela") {
                        aux = "secretaria de escuela";
                    };
                    if ( this.datosUsuarioModificar.role == "Profesor") {
                        aux = "profesor";
                    };
                    var url =`http://127.0.0.1:8000/api/v1/usuario/${this.datosUsuario.id}`;

                    let put ={
                        "nombre": this.datosUsuarioModificar.nombre,
                        "escuela": this.datosUsuarioModificar.escuela,
                        "role": aux,
                        "foto":this.imagenMiniatura,
                        "email":correo,
                        "password": contrasena,
                    }
                    axios.put(url,put,this.$store.state.config)
                    .then((result)=>{
                    if (result.data.success == true){
                        this.obtenerUsuario();
                        this.resetModificacionUsuario();
                        this.alertAcept = true;
                        var mensaje=result.data.message;
                        this.textoAcept=mensaje;
                        
                        console.log('se modifico correctamente');
                    }
                    }).catch((err)=>{
                        console.log(err);
                        this.resetModificacionUsuario();
                        if (error.message == 'Network Error') {
                            console.log(error);
                            this.alertError = true;
                            var mensaje=result.data.message;
                            this.textoAcept=mensaje;
                        } else {
                        if (error.response.data.success == false) {
                            switch (error.response.data.code) {
                            case 601:
                                console.log(error.response.data.code +' '+ error.response.data.message);
                                console.log(error.response.data);
                                this.alertError = true;
                                var mensaje=result.data.message;
                                this.textoAcept=mensaje;
                                //this.textoError = error.response.data.message;
                                break;
                            case 602:
                                console.log(error.response.data.code +' '+ error.response.data.message);
                                console.log(error.response.data);
                                this.alertError = true;
                                var mensaje=result.data.message;
                                this.textoAcept=mensaje;
                                break;
                            case 603:
                                console.log(error.response.data.code +' '+ error.response.data.message);
                                console.log(error.response.data);
                                this.alertError = true;
                                var mensaje=result.data.message;
                                this.textoAcept=mensaje;
                                break;
                            case 604:
                                console.log(error.response.data.code +' '+ error.response.data.message);
                                console.log(error.response.data);
                                this.alertError = true;
                                var mensaje=result.data.message;
                                this.textoAcept=mensaje;
                                break;
                            default:
                                break;
                            }
                        }
                        }
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
            this.alertError= false;
            this.textoError= '';
            this.alertAcept= false;
            this.textoAcept= '';
            
         },
    }
}
</script>