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
                <v-dialog transition="scroll-y-reverse-transition" v-model="dialog" persistent max-width="500px" :key="keyDialog">
                  <template v-slot:activator="{ on }">
                    <v-btn
                    fab

                    :small="$vuetify.breakpoint.smAndDown ? true : false"
                    bottom
                    left
                    v-on="on"
                    >
                      <v-icon class="mx-2" color="warning">fas fa-plus</v-icon>
                    </v-btn>
                  </template>
                  <v-card elevation="1">
                    <v-card-title
                    class="headline primary text--center"
                    primary-title
                    >
                    <h5 class="white--text ">Agregar una escuela</h5>
                    </v-card-title>
                    <v-container class="px-5 mt-5" color="primary">
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
                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                        rounded color="secondary" class="ml-2" @click="crearEscuela" >
                          <h4 class="white--text">Guardar</h4>
                        </v-btn>
                      </div>
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
                      >
                        <v-icon  color="secondary">fas fa-trash-restore-alt</v-icon>
                    </v-btn>
                  </template>
                  <span><strong>Recuperar Escuela</strong></span>
                </v-tooltip>
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
                label="Codigo Carrera"
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
                  :small="$vuetify.breakpoint.smAndDown ? true : false"
                  rounded color="secondary" class="ml-2" @click="editarEscuela(escuelaEditar)">
                    <h4 class="white--text">Modificar</h4>
                  </v-btn>
                </div>    
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
                <v-card-text>Codigo Carrera: {{ escuelaEliminar.cod }}</v-card-text>   
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
      dialog: false,
      keyDialog: 1,
      dialogModificar: false,
      keyDialogModicar: 1,
      dialogEliminar: false,
      alertError: false,
      textoError: '',
      alertAcept: false,
      textoAcept: '',
      delay: 4000,
      cargar: null,
      cargando: true,
      headers: [
        { text: 'ID',align: 'start',value: 'id',sortable: true},
        { text: 'Nombre', value: 'nombre',sortable: true},
        { text: 'Codigo carrera', value: 'cod_car',sortable: true },
        { text: 'Opciones', value: 'actions', sortable: false, align:'center' },
      ],
      desserts:[],
      dessertsAux:[],
      escuela:[{nombre:''},{cod:''}],
      escuelaEditar:[{id:''},{nombre:''},{cod:''}],
      escuelaEliminar:[{nombre:''},{cod:''}],
      reglasNombreEscuela: [
        value => !!value || 'Requerido',
        value => (value || '').length <= 40 || 'Max. 40 caracteres',
      ],
      reglasCodigoCarrera: [
        value => !!value || 'Requerido',
        value => value  >= 0 || 'El valor debe ser mayor o igual a 0', 
      ],
    }),
    computed: {
    },
    watch: {
    },
    created () {
      this.obtenerEscuelas();
    },
    methods: {
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
            console.log(result);
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
            console.log(error);
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
        this.keyDialog ++;
      },
      resetEditarEscuela(){
        this.dialogModificar=false;
        this.keyDialogModicar ++;
      },
    },
  }
</script>