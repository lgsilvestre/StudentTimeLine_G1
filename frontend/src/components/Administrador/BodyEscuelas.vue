<template>  
  <v-container>
    <v-row >
      <v-col cols="12" md="2"  
      align-self="end">
      </v-col>
      <v-col cols="12" md="8">
        <v-card>
          <v-img
            class="mx-auto white--text align-end justify-center"
            width="100%"
            height="180px"
            src="@/assets/Globales/fondo3.jpg"
          >
          
          <v-card-title class="white--text" style="padding:0;"> 
            <v-row class="px-5">
              <v-col cols="12" class="pt-1">
                <strong :style=" $vuetify.breakpoint.smAndDown ? 'font-size: 140%;' : 'font-size: 180%;'" style="text-shadow: #000000 3px 3px 4px;" > Escuelas</strong>
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

                    :small="$vuetify.breakpoint.smAndDown ? true : false"
                    bottom
                    left
                    v-on="on"
                    @click="dialog = true"
                    >
                      <v-icon class="mx-2" color="warning">fas fa-plus</v-icon>
                    </v-btn>
                  </template>
                  <span><strong>Crear Escuela</strong></span>
                </v-tooltip>

                <v-dialog transition="scroll-y-reverse-transition" v-model="dialog" persistent max-width="500px" :key="keyDialog">
                  
                  <v-card elevation="1">
                    <v-card-title
                    class="headline primary text--center"
                    primary-title
                    >
                    <h5 class="white--text ">Agregar una escuela</h5>
                    </v-card-title>
                    <v-container class="px-5 mt-5" color="primary">
                      <v-form ref="agregarEscuela" v-model="formAgregar" lazy-validation>
                        <v-text-field 
                        v-model="escuela.nombre"
                        label="Nombre de la escuela"
                        outlined
                        :rules="reglasNombreEscuela"
                        color="secondary"
                        prepend-inner-icon="fas fa-scroll"
                        ></v-text-field>
                        <v-text-field 
                        v-model="escuela.cod"
                        label="Codigo de carrera"
                        outlined
                        :rules="reglasCodigoCarrera"
                        color="secondary"
                        prepend-inner-icon="fas fa-hashtag"
                        >
                        </v-text-field>
                        <div class="pb-1" style="text-align:right;">
                          <v-btn 
                          :small="$vuetify.breakpoint.smAndDown ? true : false"
                          rounded color="warning" @click="resetCreacionEscuela">
                            <h4 class="white--text">Cancelar</h4>
                          </v-btn>
                          <v-btn
                          :disabled="!formAgregar"
                          :small="$vuetify.breakpoint.smAndDown ? true : false"
                          rounded color="secondary" class="ml-2" @click="validarCrearEscuela" >
                            <h4 class="white--text">Guardar</h4>
                          </v-btn>
                        </div>
                      </v-form>
                    </v-container>
                  </v-card>
                </v-dialog>

                <v-tooltip bottom color="primary">
                  <template v-slot:activator="{ on }">
                    <v-btn
                      class="ml-2"
                      fab
                      :small="$vuetify.breakpoint.smAndDown ? true : false"
                      bottom
                      left
                      v-on="on"
                      @click="dialogEscuelasEliminadas = true"
                      >
                        <v-icon  color="secondary">fas fa-trash-restore-alt</v-icon>
                    </v-btn>
                  </template>
                  <span><strong>Recuperar Escuela</strong></span>
                </v-tooltip>
              <v-dialog v-model="dialogEscuelasEliminadas" fullscreen   transition="dialog-bottom-transition" >
                  <v-card class="mx-auto my-10 " max-width="100%" style="display: block; background-color:#F7FFF7;">
                      <v-toolbar dark color="primary">
                      <v-spacer></v-spacer>
                      <v-btn 
                      rounded depressed color="primary" @click="dialogEscuelasEliminadas = false">
                          <strong> Cerrar </strong>
                          <v-icon class="ml-1">mdi-close</v-icon>
                      </v-btn>
                      </v-toolbar>
                      <v-container style="background-color: #F7FFF7;">
                          <v-row>
                              <v-col cols="12" md="2"></v-col>
                              <v-col cols="12" md="8" >
                                  <v-card elevation="1">
                                  <v-img class="mx-auto white--text align-end justify-center"  
                                      width="100%" height="180px"       
                                      src="@/assets/Globales/fondo3.jpg" >     
                                      <v-row>
                                          <v-col cols="12" md="6">
                                              <v-card-title class="white--text" style="text-shadow: #000000 3px 3px 4px;">     
                                                  <!-- Titulo -->
                                                  <strong :style=" $vuetify.breakpoint.smAndDown ? 'font-size: 140%;' : 'font-size: 180%;'"> Escuelas Eliminadas </strong>
                                              </v-card-title>
                                          </v-col>
                                          <v-col cols="12" md="6" class="align-self-end d-none d-md-flex">
                                              <v-text-field
                                              v-model="buscar2"
                                              append-icon="mdi-magnify"
                                              label="Buscar"
                                              hide-details
                                              outlined
                                              class="px-5 pb-2"
                                              clearable
                                              dense
                                              solo
                                              rounded
                                              color="secondary"
                                              background-color="white"
                                              ></v-text-field>
                                          </v-col>              
                                      </v-row> 
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
                                      :headers="headers2" 
                                      :items="listaEscuelasEliminadas"
                                      :search="buscar2" 
                                      :loading="cargando" 
                                      :items-per-page="10" 
                                      class="elevation-1 "
                                      >            
                                      <template v-slot:item.actions="{ item }">
                                      <!-- boton para modificar usuario seleccionado -->
                                      <v-tooltip bottom color="primary">
                                          <template v-slot:activator="{ on }">
                                          <v-btn color="white" fab small depressed class="mr-2 py-2" v-on="on" @click="setRestaurarEscuelaEliminada(item)">
                                              <v-icon color="secondary"  >
                                                  fas fa-trash-restore-alt
                                              </v-icon>
                                          </v-btn>
                                          </template>
                                          <span><strong>Recuperar Escuela</strong></span>
                                      </v-tooltip>
                                      </template>
                                  </v-data-table>
                                  </v-card>
                              </v-col>
                              <v-col cols="12" md="2"></v-col>
                          </v-row>
                          
                      </v-container>
                  
                      
                  </v-card>
              </v-dialog>

              <v-dialog  v-model="dialogRestaurarEscuela" ref="form" persistent max-width="450px">
                <v-card class="mx-auto" max-width="500"  >
                    <v-card-title class="headline primary text--center" primary-title >
                        <h5 class="white--text ">Restaurar Usuario</h5>
                    </v-card-title> 
                    <!-- <v-container fluid class=" text-left"> -->
                    <v-card-title class="text-justify" :style="$vuetify.breakpoint.smAndDown ? 'font-size: 90%;' :'font-size: 110%;'">Esta seguro que desea restaurar la siguiente Escuela?</v-card-title>
                    <v-card-text>Nombre : {{ this.escuelaEditar.nombre }}</v-card-text>
                    <v-card-text>Código de Escuela : {{ this.escuelaEditar.cod_car }}</v-card-text>                    
                    <!-- </v-container > -->
                    <div style="text-align:right;">
                        <v-btn 
                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                        rounded color="warning" class=" mb-4 "  @click="dialogRestaurarEscuela = false">
                            <h4 class="white--text">Cancelar</h4>
                        </v-btn>
                        <v-btn 
                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                        rounded color="secondary"   class=" mb-4 ml-2 mr-5" @click="restaurarEscuelaEliminada()">
                            <h4 class="white--text">Restaurar</h4>
                        </v-btn>
                    </div> 
                </v-card>
              </v-dialog>



              </v-col>
            </v-row>
          </v-card-title>
          </v-img>
          <v-data-table
          :headers="headers"
          :items="desserts"
          :loading="cargando"
          :search="buscar"
          class="elevation-1 "
          >
            <template v-slot:item.actions="{ item }">
              <v-tooltip bottom color="primary">
                <template v-slot:activator="{ on }">
                  <v-btn color="white" fab small depressed class="mr-2 py-2" v-on="on" @click="ModificarEscuela(item)">
                    <v-icon  
                    color="primary"
                    >
                    fas fa-edit
                    </v-icon>
                  </v-btn>
                </template>
                <span><strong>Modificar Escuela</strong></span>
              </v-tooltip>
              <v-tooltip bottom color="primary">
                <template v-slot:activator="{ on }">
                  <v-btn color="white" fab small depressed class="mr-2 py-2" v-on="on" @click="EliminarEscuela(item)">
                    <v-icon
                    color="warning"
                    >
                    fas fa-trash-alt
                    </v-icon>
                  </v-btn>
                </template>
                <span><strong>Eliminar Escuela</strong></span>
              </v-tooltip>
            </template>                                                         
          </v-data-table>
          <v-dialog transition="scroll-y-reverse-transition" :key="keyDialogModicar" v-model="dialogModificar" persistent max-width="500px">
            <v-card
            elevation="1"
            >
              <v-card-title
                class="headline primary text--center"
                primary-title
                >
                <h5 class="white--text ">Modificar Escuela</h5>
              </v-card-title>
              <v-container class="px-5 pt-7">
                <v-form ref="modificarEscuela" v-model="formModificar" lazy-validation>
                  <v-text-field
                  v-model="escuelaEditar.nombre"
                  label="Nombre de Escuela"
                  :rules="reglasNombreEscuela"
                  outlined
                  prepend-inner-icon="fas fa-scroll"
                  >
                  </v-text-field>                                  
                  <v-text-field
                  v-model="escuelaEditar.cod"
                  label="Código Carrera"
                  :rules="reglasCodigoCarrera"                                      
                  outlined
                  prepend-inner-icon="fas fa-hashtag"
                  >
                  </v-text-field> 
                  <div class=" pb-1" style="text-align:right;">
                    <v-btn 
                    :small="$vuetify.breakpoint.smAndDown ? true : false"
                    rounded color="warning" @click="resetEditarEscuela">
                      <h4 class="white--text">Cancelar</h4>
                    </v-btn>
                    <v-btn 
                    :disabled="!formModificar"
                    :small="$vuetify.breakpoint.smAndDown ? true : false"
                    rounded color="secondary" class="ml-2" @click="validarModificarEscuela(escuelaEditar)">
                      <h4 class="white--text">Modificar</h4>
                    </v-btn>
                  </div>
                </v-form>
              </v-container>         
            </v-card>
          </v-dialog>
            <v-dialog transition="scroll-y-reverse-transition" v-model="dialogEliminar" persistent max-width="500px">
              <v-card
              class="mx-auto"
              max-width="800"
              >
                <v-card-title
                class="headline primary text--center"
                primary-title
                >
                  <h5 class="white--text ">Eliminar Escuela</h5>
                </v-card-title>
                <v-card-title class="text-justify" :style="$vuetify.breakpoint.smAndDown ? 'font-size: 90%;' :'font-size: 110%;'">Esta seguro que desea eliminar la siguiente Escuela?</v-card-title>
                <v-card-text class="pt-2">Nombre Escuela: {{ escuelaEliminar.nombre }}</v-card-text>
                <v-card-text>Código Carrera: {{ escuelaEliminar.cod }}</v-card-text>   
                <div class="px-5  pb-4" style="text-align:right;">
                  <v-btn 
                  :small="$vuetify.breakpoint.smAndDown ? true : false"
                  rounded color="warning" @click="dialogEliminar = false">
                    <h4 class="white--text">Cancelar</h4>
                  </v-btn>
                  <v-btn 
                  :small="$vuetify.breakpoint.smAndDown ? true : false"
                  rounded color="secondary" class="ml-2" @click="borrarEscuela(escuelaEliminar)">
                    <h4 class="white--text">Eliminar</h4>
                  </v-btn>
                </div>  
                
              </v-card>
            </v-dialog> 
        </v-card>
        </v-col>
        <v-col cols="12" md="2">
        </v-col>          
    </v-row>
    <v-snackbar
      v-model="alertError"
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
        <strong>{{textoError}} </strong>
      </div>
      <v-btn
          color="white"
          elevation="0"
          x-small
          fab
          @click="alertError = ! alertError"
      > 
          <v-icon color="warning">fas fa-times</v-icon>
      </v-btn>
    </v-snackbar>
    <v-snackbar
      v-model="alertAcept"
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
        <strong>{{textoAcept}}</strong>
      </div>
      <v-btn
        color="white"
        elevation="0"
        x-small
        fab
        @click="alertAcept = ! alertAcept"
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
    data: () => ({
      buscar: '',
      buscar2: '',
      dialog: false,
      keyDialog: 1,
      formAgregar: true,
      formModificar: true,
      dialogModificar: false,
      keyDialogModicar: 1,
      dialogEliminar: false,
      dialogEscuelasEliminadas: false,
      dialogRestaurarEscuela: false,
      alertError: false,
      textoError: '',
      alertAcept: false,
      textoAcept: '',
      delay: 4000,
      cargar: null,
      cargando: true,
      headers: [
        //{ text: 'ID',align: 'start',value: 'id',sortable: true},
        { text: '', value: '',sortable: false, width:50},
        { text: 'Nombre', value: 'nombre',sortable: true, width:350},
        { text: 'Codigo carrera', value: 'cod_car',sortable: true , align:'center',width:350  },
        { text: 'Opciones', value: 'actions', sortable: false, align:'end',class:'pr-12'},
        { text: '', value: '',sortable: false, width:50},
      ],
      headers2: [
        //{ text: 'ID',align: 'start',value: 'id',sortable: true},
        { text: '', value: '',sortable: false, width:50},
        { text: 'Nombre', value: 'nombre',sortable: true, width:350},
        { text: 'Código carrera', value: 'cod_car',sortable: true , align:'center',width:350  },
        { text: 'Opciones', value: 'actions', sortable: false, align:'end',class:'pr-6'},
        { text: '', value: '',sortable: false, width:50},
      ],
      desserts:[],
      dessertsAux:[],
      escuela:[{nombre:''},{cod:''}],
      escuelaEditar:[{id:''},{nombre:''},{cod:''}],
      escuelaEliminar:[{nombre:''},{cod:''}],
      listaEscuelasEliminadas: [],
      listaEscuelasEliminadasAux: [],
      reglasNombreEscuela: [
        value => !!value || 'Requerido',
        value => (value || '').length <= 40 || 'Max. 40 caracteres',
      ],
      reglasCodigoCarrera: [
        value => !!value || 'Requerido',
        value => value  >= 0 || 'El valor debe ser mayor o igual a 0', 
        value =>  /^[0-9]+$/.test(value) || 'Código de Carrera solo debe contener Números',
        value =>  /^[0-9]{1,999999}$/.test(value) || 'Max. 999999 caracteres',
      ],
      
    }),
    computed: {
    },
    watch: {
    },
    created () {
      this.obtenerEscuelas();
      this.obtenerEscuelasEliminadas();
    },
    methods: {
      validarCrearEscuela(){
        if(this.$refs.agregarEscuela.validate()){
            this.crearEscuela();
        }
      },
      validarModificarEscuela(escuelaEditar){
        if(this.$refs.modificarEscuela.validate()){
            this.editarEscuela(escuelaEditar);
        }
      },
      ModificarEscuela(item){
        console.log(item.id);
        this.escuelaEditar.id = item.id;
        this.escuelaEditar.nombre = item.nombre;
        this.escuelaEditar.cod = item.cod_car;
        this.dialogModificar = true;
      },
      EliminarEscuela(item){
        console.log(item.id);
        this.escuelaEliminar.id = item.id;
        this.escuelaEliminar.nombre = item.nombre;
        this.escuelaEliminar.cod = item.cod_car;
        this.dialogEliminar = true;
      },
      obtenerEscuelas(){
        this.cargando =true;
        this.dessertsAux = [];
        var url = 'http://127.0.0.1:8000/api/v1/escuela';
        axios.get(url,this.$store.state.config)
          .then((result)=>{
            // console.log(result);
            if (result.data.success == true) {
              for (let index = 0; index < result.data.data.escuelas.length; index++) {
                const element = result.data.data.escuelas[index];
                let escuela = {
                  id: element.id,
                  nombre: element.nombre,
                  cod_car: element.cod_escuela,
                };
                this.dessertsAux[index]=escuela;
              }
              this.cargando =false;
              this.desserts = this.dessertsAux;
            }
          })
          .catch((error) => {
            // console.log(error);
            if (error.message == 'Network Error') {
              console.log(error);
              this.alertError = true;
              this.cargando = false;
              this.textoError = 'Error al cargar los datos, intente más tarde'
            } else {
              if (error.response.data.success == false) {
                switch (error.response.data.code) {
                  case 101:
                      console.log(error.response.data.code +' '+ error.response.data.message);
                      console.log(error.response.data);
                      this.alertError = true;
                      this.cargando = false;
                      this.textoError = error.response.data.message;
                      break;
                  default:
                      break;
                }
              }
            } 
          });
      },

      obtenerEscuelasEliminadas(){
        this.cargando =true;
        this.listaEscuelasEliminadasAux = [];
        var url = 'http://127.0.0.1:8000/api/v1/escuela/disabled';
        axios.get(url,this.$store.state.config)
          .then((result)=>{
            console.log(result);
            if (result.data.success == true) {
              for (let index = 0; index < result.data.data.escuela.length; index++) {
                const element = result.data.data.escuela[index];
                let escuela = {
                  id: element.id,
                  nombre: element.nombre,
                  cod_car: element.cod_escuela,
                };
                this.listaEscuelasEliminadasAux[index]=escuela;
              }
              this.cargando =false;
              this.listaEscuelasEliminadas = this.listaEscuelasEliminadasAux;
            }
          })
          .catch((error) => {
            console.log(error);
            if (error.message == 'Network Error') {
              console.log(error);
              this.alertError = true;
              this.cargando = false;
              this.textoError = 'Error al cargar los datos, intente más tarde'
            } else {
              if (error.response.data.success == false) {
                switch (error.response.data.code) {
                  case 801:
                      console.log(error.response.data.code +' '+ error.response.data.message);
                      console.log(error.response.data);
                      this.alertError = true;
                      this.cargando = false;
                      this.textoError = error.response.data.message;
                      break;
                  default:
                      break;
                }
              }
            } 
          });
      },


      setRestaurarEscuelaEliminada(item){
        this.escuelaEditar = item;        
        this.dialogRestaurarEscuela = true;
      },

      restaurarEscuelaEliminada(){
        
        console.log("id: "+this.escuelaEditar.id);
        var url =`http://127.0.0.1:8000/api/v1/escuela/restore/${this.escuelaEditar.id}`;
        axios.post(url,null,this.$store.state.config)
        .then((result)=>{
        if (result.data.success == true) {
            this.obtenerEscuelasEliminadas();
            this.obtenerEscuelas(); 
            this.alertAcept = true;
            this.textoAcept = result.data.message;
            this.dialogRestaurarEscuela= false;
        }
        }).catch((error)=>{
          this.dialogRestaurarEscuela= false;
            console.log(error);
            if (error.message == 'Network Error') {
                console.log(error)
                this.alertError = true;
                this.textoError = "Error al modificar el usuario, intente mas tarde."
            }
            else{
                if (error.response.data.success == false) {
                    if(error.response.data.code == 901){
                        console.log(error.response.data.code +' '+ error.response.data.message);
                        console.log(error.response.data);
                        this.textoError = error.response.data.message;
                        this.alertError = true;
                    }
                    if(error.response.data.code == 902){
                        console.log(error.response.data.code +' '+ error.response.data.message);
                        console.log(error.response.data);
                        this.textoError = error.response.data.message;
                        this.alertError = true;
                    }                    
                }
            }
        });
      },

      crearEscuela(){
        this.dessertsAux = [];
        var url = 'http://127.0.0.1:8000/api/v1/escuela';
        let post ={
          "nombre": this.escuela.nombre,
          "cod_escuela":this.escuela.cod,
        };
        axios.post(url,post,this.$store.state.config)
        .then((result)=>{
          if (result.data.success== true) {
            this.obtenerEscuelas(); 
            this.resetCreacionEscuela();
            this.alertAcept = true;
            this.textoAcept = 'La escuela se creó correctamente'
          }
        })
        .catch((error) => {
          if (error.message == 'Network Error') {
            console.log(error);
            this.resetCreacionEscuela();
            this.alertError = true;
            this.textoError = 'Error en la conexion, intente más tarde';
          } else {
            if (error.response.data.success == false) {
              switch (error.response.data.code) {
                case 301:
                    console.log(error.response.data.code +' '+ error.response.data.message);
                    console.log(error.response.data);
                    this.resetCreacionEscuela();
                    this.alertError = true;
                    this.textoError = error.response.data.message;
                    break;
                case 302:
                    console.log(error.response.data.code +' '+ error.response.data.message);
                    console.log(error.response.data);
                    this.resetCreacionEscuela();
                    this.alertError = true;
                    this.textoError = error.response.data.message;
                    break;
                default:
                    break;
              }
            }
          } 
        });
      },
      editarEscuela(item) {
        var url = 'http://127.0.0.1:8000/api/v1/escuela/'+item.id;
        let put ={
          "nombre": this.escuelaEditar.nombre,
          "cod_escuela":  this.escuelaEditar.cod,
        }
        axios.put(url,put,this.$store.state.config)
        .then((result)=>{
          if (result.data.success == true) {
            this.obtenerEscuelas(); 
            this.resetEditarEscuela();
            this.dialogModificar=false;
            this.alertAcept = true;
            this.textoAcept = 'La escuela se modificó correctamente'
          }
        })
        .catch((error) => {
          if (error.message == 'Network Error') {
            console.log(error);
            this.resetEditarEscuela();
            this.alertError = true;
            this.textoError = 'Error en la conexion, intente más tarde';
          } else {
            if (error.response.data.success == false) {
              switch (error.response.data.code) {
                case 1:
                    console.log(error.response.data.code +' '+ error.response.data.message);
                    console.log(error.response.data);
                    this.resetEditarEscuela();
                    this.dialogModificar=false;
                    this.alertError = true;
                    this.textoError = error.response.data.message;
                    break;
                case 602:
                    console.log(error.response.data.code +' '+ error.response.data.message);
                    console.log(error.response.data);
                    this.resetEditarEscuela();
                    this.dialogModificar=false;
                    this.alertError = true;
                    this.textoError = error.response.data.message;
                    break;
                case 604:
                    console.log(error.response.data.code +' '+ error.response.data.message);
                    console.log(error.response.data);
                    this.resetEditarEscuela();
                    this.dialogModificar=false;
                    this.alertError = true;
                    this.textoError = error.response.data.message;
                    break;
                default:
                    break;
              }
            }
          } 
        });
      },
      borrarEscuela (item) {
        var url = 'http://127.0.0.1:8000/api/v1/escuela/'+item.id;
        axios.delete(url,this.$store.state.config)
        .then((result)=>{
          if (result.data.success == true) {
            this.obtenerEscuelas();
            this.obtenerEscuelasEliminadas();
            this.dialogEliminar=false;
            this.alertAcept = true;
            this.textoAcept = 'La escuela se borró correctamente';
          }
        })
        .catch((error) => {
          if (error.message == 'Network Error') {
            console.log(error);
            this.dialogEliminar=false;
            this.alertError = true;
            this.textoError = 'Error al borrar escuela, intente más tarde';
          } else {
            if (error.response.data.success == false) {
              switch (error.response.data.code) {
                case 701:
                    console.log(error.response.data.code +' '+ error.response.data.message);
                    console.log(error.response.data);
                    this.dialogEliminar = false;
                    this.alertError = true;
                    this.textoError = error.response.data.message;
                    break;
                case 702:
                    console.log(error.response.data.code +' '+ error.response.data.message);
                    console.log(error.response.data);
                    this.dialogEliminar = false;
                    this.alertError = true;
                    this.textoError = error.response.data.message;
                    break;
                default:
                    break;
              }
            }
          }
        });
      },
      resetCreacionEscuela(){
        this.dialog = false;
        this.escuela.nombre='';
        this.escuela.cod=null;
        this.$refs.agregarEscuela.reset();
      },
      resetEditarEscuela(){
        this.dialogModificar=false;
        this.$refs.modificarEscuela.reset();
      },
    },
  }
</script>