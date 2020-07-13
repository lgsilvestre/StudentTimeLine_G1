<template>
    <v-container >
        <v-row class="justify-center">
            <v-col cols="12" md="3" >
                <v-card                    
                    max-width="300"
                    shaped
                >
                    <v-list rounded dense>
                        <v-list-item class="difuminado"  active-class="activacion" @click="calcularRolVuelta">
                        <v-list-item-icon><v-icon color="primary"> fas fa-arrow-circle-left</v-icon> </v-list-item-icon>
                        <v-list-item-title> Volver </v-list-item-title>
                    </v-list-item>      
                    <v-divider></v-divider>
                    <v-subheader><strong>Acciones sobre curso</strong></v-subheader>

                    <v-list-item class="difuminado" active-class="activacion" @click="dialogListaCursos = true">
                        <v-list-item-title> Lista de Cursos</v-list-item-title>
                    </v-list-item>

                    <v-list-item  class="difuminado" active-class="activacion" @click="dialogCrearCurso = true">
                        <v-list-item-title> Crear Curso</v-list-item-title>
                    </v-list-item>
                    <v-list-item  class="difuminado" active-class="activacion" @click="dialogAgregarCursoSemestre = true">
                        <v-list-item-title> Agregar Curso al Semestre</v-list-item-title>
                    </v-list-item>
                    </v-list>
                </v-card>               
            </v-col>    
                        
            <v-col cols="12" md="8">
                <!-- aca ira la lista de las instancias de curso -->
                <v-card class="justify-center">
                    <v-img
                        class="mx-auto white--text align-end justify-center"
                        width="100%"
                        height="180px"       
                        src="@/assets/Globales/background-panel-08.jpg" >
                        <v-card-title class="white--text" style="font-size: 200%;text-shadow: #555 2px 2px 3px;">
                            <strong > Cursos </strong>
                            <v-spacer></v-spacer>
                            <v-btn class="mr-2" fab large bottom left >
                                <v-icon class="mx-2" color="warning">fas fa-plus</v-icon>
                             </v-btn>
                        </v-card-title> 
                    </v-img>
                    <v-data-iterator :items="listaInsCursos" :search="search" :sort-by="sortBy.toLowerCase()" >
                       <template v-slot:header>
                           <v-toolbar>
                                <v-text-field
                                    v-model="search"
                                    append-icon="mdi-magnify"
                                    label="Search"
                                    single-line
                                    hide-details
                                ></v-text-field>
                           </v-toolbar>
                       </template>
                        <template v-slot:default="props">
                            <v-row>
                                <v-col v-for="item in props.items" :key="item.nomCurso" cols="12"  sm="6" md="4" lg="3">
                                    <v-card class="ml-5" style="background-color:#FFE66D; border-style:solid; border-color:rgba(0,0,0,0.5); ">
                                        <v-card-title class="subheading font-weight-bold">{{ item.nomCurso }}</v-card-title>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </template>
                    
                    </v-data-iterator>
                </v-card>
            </v-col>
            <v-col cols="12" md="1">                        
            </v-col>
        </v-row>

        <!-- Dialog para mostrar la lista de los Cursos Existentes -->
        <v-dialog v-model="dialogListaCursos" fullscreen hide-overlay transition="dialog-bottom-transition">
            <v-card class="mx-auto my-10 " max-width="70%">
                <v-toolbar color="primary">
                    <v-btn icon dark @click="dialogListaCursos = false">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title class="white--text"> <strong>Volver</strong></v-toolbar-title>
                </v-toolbar>

                <v-container>
                    <v-row>
                        <v-col cols="12" md="1"></v-col>
                        <v-col cols="12" md="10">
                            <v-img class="mx-auto white--text align-end justify-center"
                                width="100%" height="180px"       
                                src="@/assets/Globales/fondo3.jpg" >                    
                                <v-card-title class="white--text" style="font-size: 200%;text-shadow: #555 2px 2px 3px;">     
                                    <v-icon class="mx-3" color="white">fas fa-users</v-icon>    

                                    <!-- Titulo -->
                                    <strong> Lista Cursos Existentes </strong>
                                </v-card-title>
                            </v-img>
                            <v-data-table  :headers="colCursos" :items="listaCursos"
                                :search="search" :loading="cargando" :items-per-page="10"  >            
                                 <template v-slot:item.opciones="{ item }">
                                <!-- boton para modificar usuario seleccionado -->
                                    <v-btn color="white" fab small depressed class="mr-2 py-2">
                                        <v-icon color="primary" @click="modificarCurso(item)" >
                                            fas fa-edit
                                        </v-icon>
                                    </v-btn>
                                <!-- boton para eliminar usuario seleccionado -->
                                    <v-btn color="white" fab small depressed class="mr-2 py-2">
                                        <v-icon color="warning" @click="setEliminarCurso(item)" >
                                            fas fa-trash-alt
                                        </v-icon>
                                    </v-btn>
                                </template>
                            </v-data-table>
                        </v-col>
                        <v-col cols="12" md="1"></v-col>
                    </v-row>                    
                </v-container>                            
            </v-card>
        </v-dialog>

        <!-- Dialog para crear un Curso -->

        <v-dialog v-model="dialogCrearCurso" persistent max-width="500px">            
            <v-card class="mx-auto" max-width="800" shaped >
                <v-card-title class="headline primary text--center" primary-title >
                    <h5 class="white--text ">Crear Curso</h5>
                </v-card-title>
                <v-card-text class="px-12 mt-10" >
                    <v-form  ref="form" >
                        <v-text-field
                            class="mx-2"
                            v-model="datosCurso.nombre"
                            label="Nombre del Curso"
                            :rules="[() => !!datosCurso.nombre ||'Requerido']"
                            outlined
                            prepend-inner-icon="mdi-account"
                        ></v-text-field>
                        <v-text-field
                            class="mx-2"
                            v-model="datosCurso.plan"
                            label="Plan al que Pertenece el Curso"
                            :rules="[() => !!datosCurso.plan ||'Requerido']"
                            outlined
                            prepend-inner-icon="mdi-account"
                        ></v-text-field>
                        <v-select
                            class="mx-2"
                            v-model="datosCurso.escuela"
                            label="Escuela"
                            :items="listaEscuela"
                            item-text="nombre"
                            item-value="id"
                            :rules="[() => !!datosCurso.escuela ||'Requerido']"
                            outlined
                            prepend-inner-icon="mdi-school"
                        ></v-select>
                        <v-text-field
                            class="mx-2"
                            v-model="datosCurso.descripcion"
                            label="Descripcion"
                            :rules="[() => !!datosCurso.descripcion ||'Requerido']"
                            outlined
                            prepend-inner-icon="mdi-account"
                        ></v-text-field>
                        
                        <v-container  style="text-align:right;">
                            <v-btn rounded color="warning" @click="resetCrearCurso()">
                                <h4 class="white--text">Cancelar</h4>
                            </v-btn>
                            <v-btn rounded color="secondary" class="ml-2 mr'5" @click="crearCurso()" >
                                <h4 class="white--text">Registrar</h4>
                            </v-btn>
                        </v-container>  
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog> 

        <!-- Dialog para Eliminar un Curso -->
        <v-dialog v-model="dialogEliminarCurso" ref="form" persistent max-width="450px">
            <v-card class="mx-auto" max-width="450"  >
                <v-card-title
                    class="headline primary text--center"
                    primary-title
                    >
                    <h5 class="white--text ">Eliminar Curso</h5>
                    </v-card-title> 
                    <!-- <v-container fluid class=" text-left"> -->
                    <v-card-title class="text-justify" style="font-size: 100%;">Esta seguro que desea eliminar el siguiente Curso?</v-card-title>
                    <v-card-text>Nombre : {{ this.datosCurso.nombre }}</v-card-text>
                    <v-card-text>Plan : {{ this.datosCurso.plan }}</v-card-text>
                    <v-card-text>Escuela : {{ this.datosCurso.escuela }}</v-card-text>
                    <v-card-text>Descripcion : {{ this.datosCurso.descripcion }}</v-card-text>
                    <!-- </v-container > -->
                    <div style="text-align:right;">
                        <v-btn rounded color="warning" class=" mb-4 "  @click="dialogEliminarCurso = false">
                            <h4 class="white--text">Cancelar</h4>
                        </v-btn>
                        <v-btn rounded color="secondary"   class=" mb-4 ml-2 mr-5" @click="eliminarCurso()">
                            <h4 class="white--text">Eliminar</h4>
                        </v-btn>
                    </div> 
            </v-card>
        </v-dialog>



        <!-- Dialog para Eliminar una Instancia de Curso -->
        <v-dialog v-model="dialogEliminarInsCurso" ref="form" persistent max-width="450px">
            <v-card class="mx-auto" max-width="450"  >
                <v-card-title
                    class="headline primary text--center"
                    primary-title
                    >
                    <h5 class="white--text ">Eliminar Curso</h5>
                    </v-card-title> 
                    <!-- <v-container fluid class=" text-left"> -->
                    <v-card-title class="text-justify" style="font-size: 100%;">Esta seguro que desea eliminar el siguiente Curso?</v-card-title>
                    <v-card-text>Curso : {{ this.datosInsCurso.nomCurso }}</v-card-text>
                    <!-- </v-container > -->
                    <div style="text-align:right;">
                        <v-btn rounded color="warning" class=" mb-4 "  @click="resetEliminarInstanciaCurso">
                            <h4 class="white--text">Cancelar</h4>
                        </v-btn>
                        <v-btn rounded color="secondary"   class=" mb-4 ml-2 mr-5" @click="eliminarInstanciaCurso()">
                            <h4 class="white--text">Eliminar</h4>
                        </v-btn>
                    </div> 
            </v-card>
        </v-dialog>

        <!-- Dialog para mostrar la lista de los Cursos Existentes -->
        <v-dialog v-model="dialogAgregarCursoSemestre" fullscreen hide-overlay transition="dialog-bottom-transition">
            <v-card class="mx-auto my-10 " max-width="70%">
                <v-toolbar dark color="primary">
                <v-spacer></v-spacer>
                <v-btn  depressed color="primary" @click="dialogAgregarCursoSemestre = false">
                    <v-icon>mdi-close</v-icon>
                    
                <v-toolbar-title>Cerrar</v-toolbar-title>
                </v-btn>
                
                </v-toolbar>
                <v-container>
                    <!-- fila para el toolbar -->
                    <v-row>
                        <v-col cols="12" >
                            <v-card flat   >
                                <v-img class="mx-auto white--text align-end justify-center"
                                        width="100%" height="150px"       
                                        src="@/assets/Globales/background-panel-08.jpg">
                                        <v-card-title class="white--text" style="font-size: 200%;text-shadow: #555 2px 2px 3px;">
                                            <strong > Semestres </strong>
                                            <v-spacer></v-spacer>
                                            <!-- <v-btn class="mr-2" fab large bottom left @click="dialogAñadirSemestre =true" >
                                                <v-icon class="mx-2" color="warning">fas fa-plus</v-icon>
                                            </v-btn> -->
                                        </v-card-title>

                                </v-img>
                            </v-card>
                        </v-col>
                        <v-col cols="12">
                            <v-card class="mx-auto" >
                            <v-container>
                                <v-row >
                                    <v-col
                                    v-for="(curso, index) in listaCursos" :key="index"
                                    cols="12" sm="6" md="4" lg="3">
                                    <v-card dark height="120px" style="background-color:#4ECDC4; border-style:solid; border-color:rgba(0,0,0,0.5); "
                                     @click="asignarCursoASementre(curso)">
                                            <div class="d-flex flex-no-wrap justify-space-between">
                                                <div>
                                                    <v-card-title
                                                    class="black--text"
                                                    >  {{ curso.nombre }} </v-card-title>

                                                    <v-card-subtitle  class="black--text"> Plan {{curso.plan}}</v-card-subtitle>
                                                    <!-- <v-card-subtitle  class="black--text"> Escuela {{curso.escuela}}</v-card-subtitle> -->
                                                </div>
                                            
                                            </div>
                                    </v-card>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card>

                        </v-col>
                    </v-row>
                    
                </v-container>
            
                
            </v-card>
        </v-dialog>

        <!-- Alertas -->

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

    </v-container>
</template>


<script>
import { mapState, mapMutations } from 'vuex'
import axios from 'axios'
export default {
    data(){
        return{
            /* Variables Alertas */
            dialogAgregarCursoSemestre:false,
            alertaExito: false,
            alertaError: false,
            textoAlertas: '',
            timeout: 6000,
            /* --------------- */
            datosCurso: [{id:''},{nombre:''},{plan:''},{escuela:''},{descripcion:''}],
            datosInsCurso: [{id:''},{semestre:''},{curso:''},{nomCurso:''}],

            search: '',
            cargando: true,
            colInsCursos:[
                {text:'ID', value:'id'},
                // {text:'Semestre', value:'semestre'},
                {text:'Curso', value:'nomCurso'},   
                {text:'Opciones', value:'opciones'},                
            ],
            colCursos:[
                {text:'ID', value:'id'},
                {text:'Nombre', value:'nombre'},
                {text:'Plan', value:'plan'},   
                {text:'Escuela', value:'nomEscuela'},
                {text:'Descripcion', value:'descripcion'},
                {text:'Opciones', value:'opciones'},
            ],
            
            listaEscuela: [],
            listaEscuelaAux: [],

            listaCursos: [],
            listaCursosAux: [],
            dialogListaCursos: false,
            dialogCrearCurso: false,
            dialogModificarCurso: false,
            dialogEliminarCurso: false,


            listaInsCursos: [],
            listaInsCursosAux: [],
            dialogCrearInsCurso: false,
            dialogModificarInsCurso: false,
            dialogEliminarInsCurso: false,

            // listaOpcionesDeCursos:[],
            search: '',
            sortBy:'nomCurso',
            headers: [
         
          { text: 'id', value: 'id' },
          { text: 'semestre', value: 'semestre' },
          { text: 'Curso ', value: 'curso' },
          { text: 'Nombre curso', value: 'nomCurso' },
        ]
        }
    },
  _props: {
    item: {
      id: '',semestre: '',curso: '',nomCurso: ''
    }
  },
    get props() {
      return this._props
    },
    set props(value) {
      this._props=value
    },
    created () {   
        this.obtenerEscuelas();
        this.obtenerCursos();
        this.obtenerInstanciasCursos();    
    },
    computed: {
        
    },
    methods: {
        ...mapMutations(['calcularRolVuelta']),
        

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

        //Metodo para obtener los datos del semestre al cual ingresamos.
        obtenerDatosSemestre(){
            var aux;
            var url = `http://127.0.0.1:8000/api/v1/semestre/${this.$route.params.id}`;
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                // console.log("obtener semestres")        
                // console.log(result.data.data);
                for (let index = 0; index < result.data.data.semestres.length; index++) {
                    const element = result.data.data.semestres[index];
                    let semestre = {
                        id: element.id,
                        semestre: element.semestre,
                        anio: element.anio,
                    };                    
                    
                    this.listaSemestresAux[index]=semestre;
                }
                this.listaSemestres = this.listaSemestresAux;
            }
            ).catch((error)=>{
                console.log(error.response)
            });
        },

        //Metodo para obtener Todos los Cursos existentes.
        obtenerCursos(){
            this.cargando = true;
            this.listaCursosAux = [];
            var aux;
            var url = `http://127.0.0.1:8000/api/v1/curso`;
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                for( let index=0; index < result.data.data.cursos.length; index++){
                    const element = result.data.data.cursos[index];
                    let curso = {
                        id: element.id,
                        nombre: element.nombre,
                        plan: element.plan,
                        descripcion: element.descripcion,
                        escuela: element.escuela,
                        nomEscuela: '',
                    };
                    for (let j = 0; j < this.listaEscuela.length; j++){
                        /* console.log("id curso: "+this.listaCursos[j].id); */
                        if(this.listaEscuela[j].id == curso.escuela){
                            curso.nomEscuela = this.listaEscuela[j].nombre;
                            break;
                        };
                    };
                    this.listaCursosAux[index]=curso;
                }
                this.listaCursos = this.listaCursosAux;  
                this.cargando = false;                   
            }
            ).catch((error)=>{
                this.cargando = false;   
                console.log(error.response)
            });
        },


        //Metodo para obtener Todas las Instancias de Curso asociadas al Semestre actual.
        obtenerInstanciasCursos(){
            this.listaInsCursosAux = [];
            var listaBrayan=[];
            var aux;            
            var url = `http://127.0.0.1:8000/api/v1/instanciaCurso/${this.$store.infoSemestre.id}`;
            axios.get(url,this.$store.state.config)
            .then((result)=>{   
                for (let index = 0; index < result.data.data.insCurso.length; index++) {
                    const element = result.data.data.insCurso[index];                    
                    let insCurso = {
                        id: element.id,
                        semestre: element.semestre,
                        curso: element.curso,
                        nomCurso: '',
                    }; 
                    for (let j = 0; j < this.listaCursos.length; j++){
                        /* console.log("id curso: "+this.listaCursos[j].id); */
                        if(this.listaCursos[j].id == insCurso.curso){
                            insCurso.nomCurso = this.listaCursos[j].nombre;
                        };
                    };  

                    this.listaInsCursosAux[index]=insCurso;                                                         
                }
                this.listaInsCursos = this.listaInsCursosAux;  
                this.cargando = false;              
            }
            ).catch((error)=>{
                this.cargando = false;
                console.log(error.response)
            });
        },        
        
        crearCurso(){         
            let post = {
                "nombre": this.datosCurso.nombre,
                "plan": this.datosCurso.plan,
                "escuela": this.datosCurso.escuela,
                "descripcion": this.datosCurso.descripcion,
            }
            var url = 'http://127.0.0.1:8000/api/v1/curso';
            
            axios.post(url, post, this.$store.state.config)
            .then((result) => {
                console.log(result);
                console.log(result.data);
                this.alertaExito = true;
                this.textoAlertas = "Se creó el curso con exito."
                this.resetCrearCurso();
                this.obtenerCursos();  
            }).catch((error)=>{
                console.log(error);
                if (error.message == 'Network Error') {
                    console.log(error)
                    this.alertaError = true;
                    this.textoAlertas = "Error al crear el curso, intente mas tarde."
                    this.resetRegistrarUsuario();
                };                        
            });
        },

        resetCrearCurso(){
            this.datosCurso.nombre ="";
            this.datosCurso.plan ="";
            this.datosCurso.escuela ="";
            this.datosCurso.descripcion ="";
            this.dialogCrearCurso = false;
        },

        modificarCurso(){
            
        },
        
        setEliminarCurso(item){
            console.log("seteando curso")
            this.datosCurso.id= item.id;
            this.datosCurso.nombre = item.nombre;
            this.datosCurso.plan = item.plan;
            this.datosCurso.escuela = item.escuela;
            this.datosCurso.descripcion = item.descripcion;
            this.dialogEliminarCurso = true;
        },
        resetEliminarCurso(){
            this.datosCurso.id= '';
            this.datosCurso.nombre = '';
            this.datosCurso.plan = '';
            this.datosCurso.escuela = '';
            this.datosCurso.descripcion = '';
            this.dialogEliminarCurso = false;
        },
        eliminarCurso(){
            var url = 'http://127.0.0.1:8000/api/v1/curso/'+this.datosCurso.id;
            axios.delete(url,this.$store.state.config)
            .then((result)=>{
            if (result.statusText=='OK') {
                this.obtenerCursos();
                this.resetEliminarCurso(); 
                this.alertaExito = true;
                this.textoAlertas = "Se elimino el curso con exito "
            }
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    console.log(error)
                    this.alertaError = true;
                    this.textoAlertas = "Error al eliminar el usuario, intente mas tarde."
                }
                //Mensajes de error proximamente                
            });

        },


        asignarCursoASementre(curso){
            console.log(curso.id)
            console.log(curso.nombre);
            // api/v1/instanciaCurso  
        },


        modificarInstanciaCurso(item){

        },

        setEliminarInstanciaCurso(item){
            console.log("seteando curso")
            this.datosInsCurso.id = item.id;
            this.datosInsCurso.semestre = item.semestre;
            this.datosInsCurso.curso = item.curso;
            this.datosInsCurso.nomCurso = item.nomCurso;            
            this.dialogEliminarInsCurso = true;
        },
        resetEliminarInstanciaCurso(){
            this.datosInsCurso.id = '';
            this.datosInsCurso.semestre = '';
            this.datosInsCurso.curso = '';
            this.datosInsCurso.nomCurso = '';
            this.dialogEliminarInsCurso = false;
        },

        eliminarInstanciaCurso(){
            var url = 'http://127.0.0.1:8000/api/v1/instanciaCurso/'+this.datosInsCurso.id;
            axios.delete(url,this.$store.state.config)
            .then((result)=>{
            if (result.statusText=='OK') {
                this.obtenerInstanciasCursos();
                this.resetEliminarInstanciaCurso(); 
                this.alertaExito = true;
                this.textoAlertas = "Se elimino el curso con exito "
            }
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    console.log(error)
                    this.alertaError = true;
                    this.textoAlertas = "Error al eliminar el usuario, intente mas tarde."
                }
                //Mensajes de error proximamente                
            });
        },        
    }
    
}
</script>