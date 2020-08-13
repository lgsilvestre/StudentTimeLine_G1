<template>   
    <v-container>
    <v-row>
        <v-col cols="0" sm="1">

        </v-col>
        <v-col  cols="12" sm="10" >
            <v-card flat   elevation="1">
                <v-img class="mx-auto white--text align-end justify-center"
                width="100%" height="180px"       
                src="@/assets/Globales/fondo3.jpg">
                <v-card-title class="white--text" style="padding:0;">
                    <v-row class="px-5">
                        <v-col cols="12" class="pt-1">
                            <strong :style=" $vuetify.breakpoint.smAndDown ? 'font-size: 140%;' : 'font-size: 180%;'" style="text-shadow: #000000 3px 3px 4px;" >Semestres</strong>
                        </v-col>
                        <v-col cols="7" sm="9" md="9" class="align-self-end" >
                            <v-text-field
                            v-model="search"
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
                                    :small="$vuetify.breakpoint.smAndDown ? true : false"
                                    class="mr-2" fab 
                                    bottom left v-on="on" @click="abrirDialogAgregarSemestre " 
                                    :disabled="!usuarioValido">
                                        <v-icon class="mx-2" color="warning">fas fa-plus</v-icon>
                                    </v-btn>
                                </template>
                                <span><strong>Agregar Semestre</strong></span>
                            </v-tooltip>
                        </v-col>
                    </v-row>
                    
                </v-card-title> 
                </v-img>
                <!-- <v-container> -->
                    <v-data-iterator :items="listaSemestres" :search="search" class="px-2 py-2" :loading="cargando"  >
                        <template v-slot:default="props">
                            <v-row >
                                <v-col v-for="item in props.items" :key="item.nomCurso" cols="12" sm="6" md="4" lg="3">
                                <v-card class="mx-1"  dark color="#F7FFF7"  style=" border-style:solid; border-color:rgba(0,0,0,0.5);" > 
                                <v-container class="pt-0 mt-0 pb-0 ">
                                    <v-row >
                                        <v-col cols="12" class=" pt-0 pl-0 pr-0 pb-0" >
                                            <v-card-title style="padding:0;" >
                                                <v-img class="mx-auto white--text align-end justify-center "
                                                        width="100%" height="30px"       
                                                        src="@/assets/Globales/background-panel-08.jpg"
                                                        v-show="item.semestre == 1">
                                                </v-img>
                                                <v-img class="mx-auto white--text align-end justify-center "
                                                        width="100%" height="30px"       
                                                        src="@/assets/Globales/background-panel-09.jpg"
                                                        v-show="item.semestre == 2">
                                                </v-img>
                                                <v-img class="mx-auto white--text align-end justify-center "
                                                        width="100%" height="30px"       
                                                        src="@/assets/Globales/background-panel-10.jpg"
                                                        v-show="item.semestre == 3">
                                                </v-img>
                                            </v-card-title>
                                        </v-col>
                                            
                                        <v-col cols="12" class=" pt-1 pl-0 pr-0 pb-0  text-right" >
                                            <v-menu class="text-left " offset-y  :disabled="!usuarioValido">
                                                <template   v-slot:activator="{ on, attrs }">
                                                    <v-btn  fab  color="primary" x-small icon v-bind="attrs" v-on="on" :disabled="!usuarioValido">
                                                        <v-icon>fas fa-ellipsis-v</v-icon>
                                                    </v-btn>
                                                </template>
                                                <v-list v-if="item.deleted_at == null">
                                                    <v-list-item  v-for="(accion, index) in accionesSemestre" :key="index"
                                                    @click="acionesSobreSemestre(accion,item)" >
                                                        <v-list-item-title>{{ accion }}</v-list-item-title>
                                                    </v-list-item>
                                                </v-list>
                                                <v-list v-if="item.deleted_at != null">
                                                    <v-list-item  v-for="(accion, index) in accionesSemestreEliminado" :key="index"
                                                    @click="acionesSobreSemestre(accion,item)" >
                                                        <v-list-item-title>{{ accion }}</v-list-item-title>
                                                    </v-list-item>
                                                </v-list>
                                            </v-menu>
                                        </v-col>
                                        <v-col cols="6"  class=" pt-0 pl-1 pr-0 pb-1 "  >
                                            <v-card-text class=" pt-0 pl-2 pr-0 pb-0 " v-if="item.deleted_at == null">
                                                <div class="text--primary " >
                                                    <!-- <p class="font-weight-black"   @click="calcularRol(semestre)"> {{ semestre.anio }} - {{semestre.semestre}}</p> -->
                                                    <strong style=" font-size: 115%;">  <a   @click="calcularRol(item)">{{ item.anio }} - {{item.semestre}}</a> </strong>
                                                </div>
                                            </v-card-text>
                                            <v-card-text class=" pt-0 pl-2 pr-0 pb-0 " v-if="item.deleted_at != null">
                                                    <!-- <p class="font-weight-black"  > {{ semestre.anio }} # {{semestre.semestre}}</p> -->
                                                    <strong style=" font-size: 115%;"> <a   @click="calcularRol(item)">{{ item.anio }} - {{item.semestre}}</a> </strong>
                                            </v-card-text>
                                        </v-col>
                                        <v-col cols="6"  class=" pt-0 pl-0 pr-1 pb-0 " >
                                            <div style="text-align:right;" v-if="item.deleted_at != null">
                                            <v-chip
                                            color="warning"
                                            outlined
                                            pill
                                            x-small
                                            >CERRADO
                                            </v-chip>
                                            </div>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card>
                            </v-col>
                        </v-row>
                </template>
                    </v-data-iterator>
                <!-- </v-container> -->
            </v-card>
        </v-col>
        <v-col cols="0" sm="1">
        </v-col>
    </v-row>
        <!-- Dialogo para agregar un semestre -->
    <v-dialog v-model="dialogAñadirSemestre" rtransition="scroll-y-reverse-transition"  persistent max-width="500px">
        <v-card class="mx-auto" max-width="500" >
                <v-card-title class="headline primary text--center" primary-title >
                    <h5 class="white--text ">Registrar Semestre</h5>
                </v-card-title>
                <v-container class="px-5 mt-5" >
                    <v-form  ref="form_nuevoSemestre" style="margin:0;padding:0;" v-model="formularioNuevoSemestreValido" lazy-validation>
                        <v-row >
                            <v-col cols="6" >
                                <strong>Año</strong>
                            </v-col>
                            <v-col cols="6" class="mt-0 pt-0 mb-0 pb-0">
                                <v-text-field  v-model="añoActual" dense
                                    outlined  color="secondary" 
                                    :disabled="unAnhoVariable"
                                    :rules="rules" type="number" required
                                    ></v-text-field>
                            </v-col>
                            <v-col cols="6" >
                                <strong>Semestre</strong>
                            </v-col>
                            <v-col cols="6" class="mt-0 pt-0 mb-0 pb-0">
                                <v-select
                                    v-model="semestreActual"
                                    :items="listaSemestres_reg"
                                    item-text="sem"
                                    dense
                                    outlined
                                    color="secondary"
                                    ></v-select>
                            </v-col>
                            
                        </v-row>
                        <div style="text-align:right;" class="pb-1">
                            <v-btn rounded color="warning" @click="dialogAñadirSemestre=false">
                                <h4 class="white--text">Cancelar</h4>
                            </v-btn>
                            <v-btn rounded color="secondary" class="ml-2" @click="registrarSemestre()" 
                            :disabled="!formularioNuevoSemestreValido">
                                <h4 class="white--text">Registrar</h4>
                            </v-btn>
                        </div>  
                    </v-form>
                    
                </v-container>
            </v-card>
    </v-dialog>
    <!-- dialog modificar para modificar un semestre -->
    <v-dialog v-model="dialogModificarSemestre" rtransition="scroll-y-reverse-transition"  persistent max-width="500px">
        <v-card class="mx-auto" max-width="500" >
                <v-card-title class="headline primary text--center" primary-title >
                    <h5 class="white--text ">Modificar Semestre</h5>
                </v-card-title>
                <v-container class="px-5 mt-5" >
                    <v-form  ref="form_modificarSemestre" v-model="formularioModificarSemestreValido" lazy-validation> 
                        <v-row >
                            <v-col cols="6" >
                                <strong>Año</strong>
                            </v-col>
                            <v-col cols="6" class="mt-0 pt-0 mb-0 pb-0">
                                <v-text-field  v-model="añoActual" dense
                                outlined  color="secondary" 
                                :disabled="unAnhoVariable"
                                :rules="rules" type="number" required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="6" >
                                <strong>Semestre</strong>
                            </v-col>
                            <v-col cols="6" class="mt-0 pt-0 mb-0 pb-0">
                                <v-select
                                    v-model="semestreActual"
                                    :items="listaSemestres_reg"
                                    item-text="sem"
                                    dense
                                    outlined
                                    color="secondary"
                                    ></v-select>
                            </v-col>
                        </v-row>
                        <div  style="text-align:right;" class="pb-1">
                            <v-btn rounded color="warning" @click="dialogModificarSemestre=false">
                                <h4 class="white--text">Cancelar</h4>
                            </v-btn>
                            <v-btn rounded color="secondary" class="ml-2 " @click="modificarSemestre()" 
                             :disabled="!formularioModificarSemestreValido">
                                <h4 class="white--text">Registrar</h4>
                            </v-btn>
                        </div>  
                        
                    </v-form>
                </v-container>
            </v-card>
    </v-dialog>
    <!-- dialogo para eliminar un semestre -->
    <v-dialog v-model="dialogEliminarSemestre" ref="form" persistent max-width="450px">
        <v-card class="mx-auto" max-width="450"  >
            <v-card-title
                class="headline primary text--center"
                primary-title
                >
                <h5 class="white--text ">Cerrar Semestre</h5>
                </v-card-title> 
                <v-card-title class="text-justify" style="font-size: 100%;">Esta seguro que desea cerrar el semestre?</v-card-title>
                <v-card-text>Año : {{ semestreActual_1.anio }}</v-card-text>
                <v-card-text>Semetre : {{ semestreActual_1.semestre }}</v-card-text>
                <div style="text-align:right;">
                    <v-btn rounded color="warning" class=" mb-4 "  @click="dialogEliminarSemestre = false">
                        <h4 class="white--text">Cancelar</h4>
                    </v-btn>
                    <v-btn rounded color="secondary"   class=" mb-4 ml-2 mr-5" @click="eliminarSemestre()">
                        <h4 class="white--text">Eliminar</h4>
                    </v-btn>
                </div> 
        </v-card>
    </v-dialog>

    <!-- dialofo para re-abrir el semestre -->
    <v-dialog v-model="dialogReAbrirSemestre" ref="form" persistent max-width="450px"> 
        <v-card class="mx-auto" max-width="450"  >
            <v-card-title
                class="headline primary text--center"
                primary-title
                >
                <h5 class="white--text ">Cerrar Semestre</h5>
                </v-card-title> 
                <v-card-title class="text-justify" style="font-size: 100%;">Esta seguro que desea reabrir el semestre?</v-card-title>
                <v-card-text>Año : {{ semestreActual_1.anio }}</v-card-text>
                <v-card-text>Semetre : {{ semestreActual_1.semestre }}</v-card-text>
                <div style="text-align:right;">
                    <v-btn rounded color="warning" class=" mb-4 "  @click="dialogReAbrirSemestre = false">
                        <h4 class="white--text">Cancelar</h4>
                    </v-btn>
                    <v-btn rounded color="secondary"   class=" mb-4 ml-2 mr-5" @click="reabrirSemestre()">
                        <h4 class="white--text">Aceptar</h4>
                    </v-btn>
                </div> 
        </v-card>
    </v-dialog>
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
            fas fa-check-circle  
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
     
 </v-container>  
</template>

<script>
import { mapState, mapMutations } from 'vuex'
import axios from 'axios'

export default {
    data() {
        return {
            /**Variables para los dialogos */
            dialogEliminarSemestre:false,
            dialogModificarSemestre:false,
            dialogAñadirSemestre:false,
            dialogReAbrirSemestre:false,
            /**Variables para las alertas */
            alertaError: false,
            alertaExito: false,
            textoAlertas: '',
            timeout: 6000,

            /**Variables para trabjar con los semetres */
            date: new Date().toISOString().substr(0, 10),
            listaSemestres:[],
            listaSemestresAux:[],
            unAnhoVariable: false,
            añoActual: new Date().getFullYear(),
            semestreActual: 1,
            semestreActual_1:[{id:'',semestre:'',anio:'',deleted_at:''}],

            accionesSemestre: [ 'Modificar Semestre' , 'Cerrar Semestre'  ],
            accionesSemestreEliminado:['Re-abrir semestre'],
            listaSemestres_reg:[ {sem: 1},  {sem: 2}, {sem: 3}],

            //busqueda
            cargando: false,
            search: '',
            // sortBy:'anio',
            headers: [
                { text: 'id', value: 'id' },
                { text: 'semestre', value: 'semestre' },
                { text: 'Anio ', value: 'anio' },
                { text: 'deleted_at curso', value: 'deleted_at' },
            ],
            itemsPerPageArray: [4, 8, 12],
            itemsPerPage: 4,
            //Validaciones y reglas para los formulario.
            formularioNuevoSemestreValido:true,
            formularioModificarSemestreValido:true,
            rules: [
                value => !!value || 'Requerido',
                value => value <= new Date().getFullYear()|| 'El año no debe ser mayor al actual',
                value => value >= 1981 || 'El año no debe ser menor a 1981',
                ],
            rules_2: [
                value => !!value || 'Requerido',
                value => value <= 3|| 'El semestre debe ser menor a 3',
                value => value >= 1 || 'El semestre debe ser mayor a 1',
                ],

                //Texto
                errorServidor:"Error al comunicarse con el servidor, intente más tarde",
                exitoCreacionSemestre:"Se creó el semestre satisfactoriamente.",
                ErrorCreacionSemetre:"Error al crear El semestre.",
                ErrorSemestreDuplicado:"Error el semestre ya se encuentra registrado.",
                ErrorDatosIngresados:"Error en los datos Ingresados",
                usuarioValido:true,
        }
    },
    beforeMount(){
        /**
         * Obtenemos la lista de todos los semestres antes de montar la vista.
         */
        this.obtenerListaDeSemestres(); 
        this.validarUsuario();    
    },
    methods: {
        ...mapMutations(['calcularRol']),
        validarUsuario(){
            if(this.$store.state.usuario.usuario.rol== "secretaria de escuela"){
                // console.log("Usuario de secrfetaria de escuela")
                this.usuarioValido=false;
            }else{
                 this.usuarioValido=true;
            }
        },
        /**
         * Valida si la información ingresada por el usuario esta correcta.
         */
        validate () {
            this.$refs.form_nuevoSemestre.validate()
        },
        resetValidacionesCrearNuevoSemestre(){
            this.añoActual= new Date().getFullYear();
            this.semestreActual= 1;
            this.reset();
            this.resetValidation();
        },

        abrirDialogAgregarSemestre(){
            this.añoActual=new Date().getFullYear();
            this.dialogAñadirSemestre =true;
            // this.resetValidacionesCrearNuevoSemestre();
        },
        
        /**
         * Obtiene la lista de todos los 
         *   semestres registrados en la base de datos
         */
        obtenerListaDeSemestres(){
            this.cargando = true;
            this.listaSemestresAux = [];
            var aux;
            var url = this.$store.state.rutaDinamica+'api/v1/semestre';
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                if (result.data.success==true){
                    for (let index = 0; index < result.data.data.semestres.length; index++) {
                        const element = result.data.data.semestres[index];
                        //console.log(element)
                        let semestre = {
                            id: element.id,
                            semestre: element.semestre,
                            anio: element.anio,
                            deleted_at: element.deleted_at 
                        }; 
                        this.listaSemestresAux[index]=semestre;
                    }
                    this.cargando = false;
                    this.listaSemestres = this.listaSemestresAux;
                    this.listaSemestres.reverse();
                }
            }
            ).catch((error)=>{
                if (error.message == "Network Error") {
                    //console.log(error);
                    this.textoAlertas =this.errorServidor;
                    this.alertaError = true;
                    this.cargando = false;
                    // state.mensajeErrorLogin= 'Error al comunicarse con el servidor, intente más tarde';
                } else {
                    if (error.response.data.success == false) {
                        switch (error.response.data.code) {
                            case 101:
                                mensaje= error.response.data.message;
                                this.textoAlertas = mensaje;
                                this.alertaError = true;  
                                this.cargando = false;
                                break;
                            default:
                                mensaje= error.response.data.message;
                                this.textoAlertas = mensaje;
                                this.alertaError = true;  
                                this.cargando = false;
                                break;
                        }
                    }
                }
            });


        },
        /**
         * Registra la información de un semestre en la base de datos.
         */
        registrarSemestre(){
            var valido=this.$refs.form_nuevoSemestre.validate();
            // console.log("semestre valido :" + valido)
            if(valido == true){

                var año_Aux = new Date().getFullYear()
                if(this.añoActual <= año_Aux && this.añoActual>= 1981 && this.semestreActual>=1 && this.semestreActual <= 3){
                    let post = {
                        "semestre": this.semestreActual,
                        "anio": this.añoActual,
                    }
                    var url = this.$store.state.rutaDinamica+'api/v1/semestre ';
                axios.post(url, post, this.$store.state.config)
                .then((result) => {
                    if (result.data.success==true){
                        this.dialogAñadirSemestre = false;
                        
                        this.textoAlertas = "Semestre registrado exitosamente";
                        this.alertaExito=true;
                        this.obtenerListaDeSemestres(); 
                    }
                }).catch((error)=>{ 
                    if (error.message == 'Network Error') {
                        //onsole.log(error)
                        this.alertaError = true;
                        this.textoAlertas =this.errorServidor;
                        this.alertaError = true;  
                    }
                    else{
                        if (error.response.data.success == false) {
                            if(error.response.data.code == 301){
                                this.textoAlertas = error.response.data.message;
                                this.alertaError = true;      
                            }
                            if(error.response.data.code == 302){
                                this.textoAlertas = error.response.data.message;
                                this.alertaError = true;      
                            }
                            else{
                                this.textoAlertas = error.response.data.message;
                                this.alertaError = true;
                            }
                        }
                    }                
                });
                
    
                }
            }


        },
        /**
         * Modifica la informacion de un semestre.
         */
        modificarSemestre(){
            var año_Aux = new Date().getFullYear()
            if(this.añoActual <= año_Aux && this.añoActual>= 1981 && this.semestreActual>=1 && this.semestreActual <= 3){
                //  console.log("ENTRE")
                let put = {
                        "semestre": this.semestreActual,
                        "anio": this.añoActual
                    }
                    // console.log(post)
                    var url = this.$store.state.rutaDinamica+`api/v1/semestre/${this.semestreActual_1.id} `;
                    axios.put(url, put, this.$store.state.config)
                    .then((result) => {
                        if (result.data.success==true){
                            this.dialogModificarSemestre = false;
                            this.añoActual= new Date().getFullYear();
                            this.semestreActual= 1;
                            this.textoAlertas = "Se creó el semestre con exito."
                            this.alertaExito=true;
                            this.obtenerListaDeSemestres();

                        }
                    }).catch((error)=>{
                        
                        if (error.message == 'Network Error') {
                            ///console.log(error)
                            this.textoAlertas = "Error al modificar el semestre, intente mas tarde."
                            this.alertaError = true;
                            this.dialogModificarSemestre = false;
                            this.añoActual= new Date().getFullYear();
                            this.semestreActual= 1;
                        }
                        else{
                            if (error.response.data.success == false) {
                                if(error.response.data.code == 301){
                                    //console.log(error.response.data.code +' '+ error.response.data.message);
                                    //console.log(error.response.data);
                                    this.textoAlertas = error.response.data.message;
                                    this.alertaError = true;   
                                    this.dialogModificarSemestre = false;
                                    this.añoActual= new Date().getFullYear();
                                    this.semestreActual= 1;   
                                }
                                if(error.response.data.code == 601){
                                    //console.log(error.response.data.code +' '+ error.response.data.message);
                                    //console.log(error.response.data);
                                    this.textoAlertas = error.response.data.message;
                                    this.alertaError = true;   
                                    this.dialogModificarSemestre = false;
                                    this.añoActual= new Date().getFullYear();
                                    this.semestreActual= 1;   
                                }
                                if(error.response.data.code == 602){
                                    //console.log(error.response.data.code +' '+ error.response.data.message);
                                    //console.log(error.response.data);
                                    this.textoAlertas = error.response.data.message;
                                    this.alertaError = true;  
                                    this.dialogModificarSemestre = false;
                                    this.añoActual= new Date().getFullYear();
                                    this.semestreActual= 1;    
                                }
                                if(error.response.data.code == 603){
                                    //console.log(error.response.data.code +' '+ error.response.data.message);
                                    //console.log(error.response.data);
                                    this.textoAlertas = "Error al registrar el semestre";
                                    this.alertaError = true; 
                                    this.dialogModificarSemestre = false;
                                    this.añoActual= new Date().getFullYear();
                                    this.semestreActual= 1;     
                                }
                                else{
                                    this.textoAlertas = error.response.data.message;
                                    this.alertaError = true;  
                                    this.dialogModificarSemestre = false;
                                    this.añoActual= new Date().getFullYear();
                                    this.semestreActual= 1;    
                                }
                                //console.log(error.response.data.code +' '+ error.response.data.message);
                            }
                        }                
                    });
            }
            
        },
        /**
         * Procesa la lista de acciones que puede tener un semestre
         */
        acionesSobreSemestre(acciones,item){
            if(acciones =='Modificar Semestre'){
                console.log("Modificar Semestre")  
                this.dialogModificarSemestre=true;
                this.semestreActual_1=item;
                this.añoActual=item.anio;
                this.semestreActual = item.semestre;
                
            }
            if(acciones=='Cerrar Semestre'){
                console.log("Eliminar semestre")
                this.semestreActual_1=item;
                this.dialogEliminarSemestre = true;
                // console.log(this.$store.state.usuario.usuario.rol)
                
            }
            if(acciones=='Re-abrir semestre'){
               // console.log("Re-abrir semestre")
                this.semestreActual_1=item;
                this.dialogReAbrirSemestre = true;
            }
            
        },
        /**
         * deshabilita un semetre del sistema
         */
        eliminarSemestre(){
            var url = this.$store.state.rutaDinamica+'api/v1/semestre/'+this.semestreActual_1.id;
                axios.delete(url,this.$store.state.config)
                .then((result)=>{
                if (result.data.success==true) {
                    this.dialogEliminarSemestre= false;
                    this.obtenerListaDeSemestres();
                    this.alertaExito = true;
                    this.textoAlertas = "Se elimino el semestre con exito "
                }
                }).catch((error)=>{
                    if (error.message == 'Network Error') {
                        // console.log(error)
                        this.textoAlertas = "Error al eliminar el semestre, intente mas tarde."
                        this.alertaError = true;
                    }
                    else{
                        if (error.response.data.success == false) {
                            if(error.response.data.code == 701){
                                // console.log(error.response.data.code +' '+ error.response.data.message);
                                // console.log(error.response.data);
                                this.textoAlertas = error.response.data.message;
                                this.alertaError = true;
                                this.dialogEliminarSemestre= false;
                            }
                            if(error.response.data.code == 702){
                                // console.log(error.response.data.code +' '+ error.response.data.message);
                                // console.log(error.response.data);
                                this.textoAlertas = error.response.data.message;
                                this.alertaError = true;
                                this.dialogEliminarSemestre= false;
                            }
                            else{
                                this.textoAlertas = error.response.data.message;
                                this.alertaError = true;
                                this.dialogEliminarSemestre= false;
                            }
                        }
                    }
                
            });
        },
        /**
         * Reabre un semestre que halla sido cerraado.
         */
        reabrirSemestre(){
            var url = this.$store.state.rutaDinamica+'api/v1/semestre/restore/'+this.semestreActual_1.id;
                axios.post(url,null,this.$store.state.config)
                .then((result)=>{
                if (result.data.success==true) {
                    this.dialogReAbrirSemestre= false;
                    this.obtenerListaDeSemestres();
                    this.alertaExito = true;
                    this.textoAlertas = "El semestre fue reabierto con exito "
                }
                }).catch((error)=>{
                    if (error.message == 'Network Error') {
                        // console.log(error)
                        this.textoAlertas = "Error al eliminar el semestre, intente mas tarde."
                        this.alertaError = true;
                    }
                    else{
                        if (error.response.data.success == false) {
                            if(error.response.data.code == 901){
                                // console.log(error.response.data.code +' '+ error.response.data.message);
                                // console.log(error.response.data);
                                this.textoAlertas = error.response.data.message;
                                this.alertaError = true;
                                this.dialogReAbrirSemestre= false;
                            }
                            if(error.response.data.code == 902){
                                // console.log(error.response.data.code +' '+ error.response.data.message);
                                // console.log(error.response.data);
                                this.textoAlertas =  error.response.data.message;
                                this.alertaError = true;
                                this.dialogReAbrirSemestre= false;
                            }
                            else{
                                this.textoAlertas =  error.response.data.message;
                                this.alertaError = true;
                                this.dialogReAbrirSemestre= false;
                            }
                        }
                    }
                
            });
        }

    },
    
    

}
</script>
<style scoped>
    a {       
        text-decoration-line: none;
}

a:hover {
  text-decoration: underline  ;
}
</style>