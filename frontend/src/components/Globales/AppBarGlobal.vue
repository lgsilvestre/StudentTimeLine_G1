<template>
  <div>
    <v-app-bar
      color="primary"
      
      elevate-on-scroll 
      :collapse=false
    >
        <!-- Logo Institucional -->
        <div class="d-flex align-center">
        <v-img 
            class="shrink mr-2 d-none d-sm-flex"
            src="@/assets/Globales/utalca.png"
            width="300"
        />
        <v-img 
            class="shrink mr-2 d-flex d-sm-none"
            src="@/assets/Globales/utalca2.png"
            width="45"
        />
        </div>
        <v-spacer></v-spacer>
        <!-- Boton que abrira las notificaciones-->
        <div class="d-flex align-center">
          <v-tooltip bottom color="primary">
            <template v-slot:activator="{ on }">
              <v-btn class="ma-2"  v-on="on" fab depressed small dark color="primary" @click="dialogContactar = true" v-show="user != 'admin'">
                <v-icon color="white">fas fa-envelope</v-icon>
              </v-btn>   
            </template>   
            <span><strong>Contactar</strong></span>
          </v-tooltip>

        <!-- Boton que llamará al panel lateral-->
          <v-btn class="ma-2" fab elevation="3" small dark color="white"
            @click="drawel"
            >
            <v-icon color="primary" 
            :class="icono== true ? 'd-flex':'d-none'"
            >fas fa-list-ul</v-icon>
            <v-icon color="primary" 
            :class="icono== true ? 'd-none':'d-flex'"
            >fas fa-ellipsis-v</v-icon>
          </v-btn>
        </div>
    </v-app-bar>


    <v-dialog v-model="dialogContactar" persistent max-width="500px" :key="keyContactar">
      <v-card class="mx-auto" max-width="500" >
          <v-card-title class="headline primary text--center" primary-title >
              <h5 class="white--text ">Contactar Superior</h5>
          </v-card-title>
          <v-container class="px-5 mt-5">
              <v-form ref="contactar" v-model="formContactar" lazy-validation>
                  <v-select
                      v-model="datosContactar.rolDestinatario"
                      label="Tipo Destinatario"
                      :items="listaRoles"
                      item-text="nombre"
                      item-value="id"
                      :rules="[() => !!datosContactar.rolDestinatario ||'Requerido']"
                      outlined
                      prepend-inner-icon="mdi-account-tie"
                  >                                
                  </v-select>
                  <v-autocomplete
                      v-model="datosContactar.idDestinatario"
                      label="Administrador"
                      :items="listaAdmin"
                      item-text="nombre"
                      item-value="id"
                      :rules="[v => v.length > 0 || 'Debe seleccionar al menos un Destinatario']"
                      required
                      outlined
                      multiple
                      chips
                      small-chips
                      prepend-inner-icon="mdi-account"
                      v-show="datosContactar.rolDestinatario == 'Administrador'"
                  >                                
                  </v-autocomplete>
                  <v-autocomplete
                      v-model="datosContactar.idDestinatario"
                      label="Secretaría de Escuela"
                      :items="listaSecEscuela"
                      item-text="nombre"
                      item-value="id"
                      :rules="[v => v.length > 0 || 'Debe seleccionar al menos un Destinatario']"
                      outlined
                      multiple
                      chips
                      small-chips
                      prepend-inner-icon="mdi-account"
                      v-show="datosContactar.rolDestinatario == 'Secretaría de Escuela'"
                  >                                
                  </v-autocomplete>
                  <v-text-field
                      v-model="datosContactar.motivo"
                      label="Motivo"
                      outlined
                      :rules="[() => !!datosContactar.motivo ||'Requerido']"
                      prepend-inner-icon="fas fa-question-circle"
                  >
                  </v-text-field>
                  <v-textarea
                      v-model="datosContactar.descripcion"
                      outlined
                      color="secondary"
                      :rules="[() => !!datosContactar.descripcion ||'Requerido']"
                      label="Descripcion"
                  >
                  </v-textarea>
                  <div class="pb-1" style="text-align:right;">  
                      <v-btn 
                      :small="$vuetify.breakpoint.smAndDown ? true : false"
                      rounded 
                      color="warning" 
                      @click="resetContactar()"
                      >
                          <h4 class="white--text">Cancelar</h4>
                      </v-btn>
                      <v-btn 
                      :disabled="!formContactar"
                      :loading="cargando"
                      :small="$vuetify.breakpoint.smAndDown ? true : false"
                      rounded 
                      color="secondary" 
                      class="ml-2" 
                      @click="validarContactar()"
                      >
                          <h4 class="white--text">Enviar</h4>
                      </v-btn>
                  </div>
              </v-form>
          </v-container>
      </v-card>
    </v-dialog>
        
    <!-- Alertas -->
    <!-- Alerta de Error -->
    <v-snackbar 
        v-model="alertaError" 
        :timeout="timeout"
        bottom 
        color= "warning" 
        left 
        class="pb-12"  
    >
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
    <v-snackbar 
      v-model="alertaExito" 
      :timeout="timeout" 
      bottom
      color= "secondary" 
      left 
      class="pb-12"  
    >
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

  </div>
</template>

<script>
import {mapState, mapMutations} from 'vuex';
import axios from 'axios'
  export default {
    components: {
    },
    data () {
      return {
        icono:false,
        //Varibales para Alertas
        timeout: 4000,
        textoAlertas: '',
        alertaError: false,
        alertaExito: false,
        user: '',
        //Variables Dialog Contactar
        dialogContactar: false,
        keyContactar: 1,
        formContactar: true,
        cargando: false,
        //Variables para almacenar datos
        listaRoles: ['Administrador','Secretaría de Escuela'],
        listaAdmin: [],
        listaSecEscuela: [],
        listaAdminAux: [],      
        listaSecEscuelaAux: [],      
        datosContactar: [{rolDestinatario:''},{idDestinatario:null},{motivo:''},{descripcion:''}],

      }
    },
    beforeMount(){
      this.obtenerUsuarios();
      this.user = this.$store.state.usuario.usuario.rol;
    },
    methods:{
      drawel(){
        //console.log(this.$vuetify.breakpoint.name );
        if(this.$vuetify.breakpoint.name == 'sm' || this.$vuetify.breakpoint.name == 'xs'){
            this.$store.state.drawers.drawer = !this.$store.state.drawers.drawer;
            this.$store.state.drawers.miniVarianteAdm = false;
            //console.log(this.icono);
            this.icono=true;
        }
        else{
            this.$store.state.drawers.drawer = true;
            this.$store.state.drawers.miniVarianteAdm = !this.$store.state.drawers.miniVarianteAdm;
            this.$store.state.drawerProfesor = !this.$store.state.drawerProfesor;     
            this.icono=this.$store.state.drawerProfesor;

        }
      },
      //Funcion utilizada para obtener la lista de los usuarios existentes en el sistema
      //Solo usuarios con rol Administrador o Secretaría de Escuela
      obtenerUsuarios(){            
          this.listaAdminAux = [];
          this.listaSecEscuelaAux = [];
          var c1 = 0;
          var c2 = 0;
          var url = this.$store.state.rutaDinamica+'api/v1/usuario/listarEncargados';
          
          axios.get(url,this.$store.state.config)
          .then((result)=>{                
                  for (let index = 0; index < result.data.data.usuarios.length; index++) {
                      const element = result.data.data.usuarios[index];
                      let usuario = {
                          id: element.id,
                          nombre: element.nombre,
                          rol: element.rol,
                      };                   
                      if(usuario.rol == 'admin'){
                          this.listaAdminAux[c1] = usuario;
                          c1++;                            
                      }
                      else if(usuario.rol == 'secretaria de escuela'){
                          this.listaSecEscuelaAux[c2] = usuario;
                          c2++;                            
                      }                    
                  }
                  this.listaAdmin = this.listaAdminAux;                              
                  this.listaSecEscuela = this.listaSecEscuelaAux;                    
              }
              ).catch((error)=>{
                  if (error.message == 'Network Error') {
                      this.alertaError = true;                        
                      this.textoAlertas = "Error al cargar los datos, intente mas tarde.";
                  }
                  else{
                    if (error.response.data.success == false) {
                        this.alertaError = true;                        
                        this.textoAlertas = error.response.data.message;
                    }
                  }
          })
      },
      //Funcion que valida los datos ingresados en el Dialog Contactar
      validarContactar(){            
          if(this.$refs.contactar.validate()){
              this.contactar();
          }
          else{
              this.$refs.contactar.validate();
          }
      },
      //Funcion que reinicia los valores usados en el dialog, ademas de las validaciones relacionadas a este.
      resetContactar(){
          this.$refs.contactar.reset();
          this.datosContactar.rolDestinatario = '';
          this.datosContactar.idDestinatario = [];
          this.datosContactar.motivo = '';
          this.datosContactar.descripcion = '';
          this.keyDialogCreacion++;
          this.dialogContactar = false;
      },
      //Funcion que se encarga de solicitar (a backend) el envio de los distintos correos electronicos
      contactar(){
          this.cargando = true;
          let post ={
              "destinatarios": this.datosContactar.idDestinatario,
              "motivo": this.datosContactar.motivo,
              "descripcion": this.datosContactar.descripcion,
          };                     
          //console.log(post.destinatarios);
          var url = this.$store.state.rutaDinamica+'api/v1/usuario/contactar';
          axios.post(url, post, this.$store.state.config)
          .then((result)=>{       
                  this.cargando = false;
                  this.dialogContactar = false;
                  this.alertaExito = true;
                  this.resetContactar();
                  this.textoAlertas = "Se ha enviado el/los correos correctamente."
              }
              ).catch((error)=>{
                  if (error.message == 'Network Error') {
                      this.cargando = false;
                      this.alertaError = true;         
                      this.resetContactar();               
                      this.textoAlertas = "Error al cargar los datos, intente mas tarde.";
                  }else{
                    if (error.response.data.success == false) {
                        this.cargando = false;
                        this.alertaError = true;
                        this.resetContactar(); 
                        this.textoAlertas = error.response.data.message;
                    }
                  }
          })
      },
    }
  }
</script>