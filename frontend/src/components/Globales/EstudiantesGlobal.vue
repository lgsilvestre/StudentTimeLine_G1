<template>
    <v-container>
        <v-row >
            <v-col cols="12" md="1">
            </v-col>
            <v-col cols="12" md="10">
                <v-card>
                    <v-img
                    class="mx-auto white--text align-end justify-center"
                    width="100%"
                    height="180px"
                    src="@/assets/Globales/fondo3.jpg"
                    >
                    <v-card-title class="white--text" style="padding:0;" > 
                        <v-row class="px-5"> 
                            <v-col cols="12" class="pt-1">
                                <strong :style=" $vuetify.breakpoint.smAndDown ? 'font-size: 140%;' : 'font-size: 180%;'" style="text-shadow: #000000 3px 3px 4px;" >Estudiantes</strong>
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
                                <v-dialog v-model="dialogAgregarEstudiante" persistent max-width="500px">
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                        fab
                                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                                        bottom
                                        left
                                        v-on="on"
                                        v-show="admin || secretariaEscuela"
                                        >
                                            <v-icon class="mx-2" color="warning">fas fa-plus</v-icon>
                                        </v-btn>
                                    </template>
                                    <v-card elevation="1">
                                        <v-card-title
                                        class="headline primary text--center"
                                        primary-title
                                        >
                                        <h5 class="white--text ">Agregar estudiantes</h5>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            v-if="botonesAgregarEstudiantes==false"
                                            color="primary"
                                            elevation="0"
                                            rounded
                                            dense
                                            @click="volverAgregarEstudiantes"
                                        > 
                                            Volver <i class="fas fa-undo-alt pl-2"></i>
                                        </v-btn>
                                        <v-btn
                                            v-if="botonesAgregarEstudiantes"
                                            color="primary"
                                            elevation="0"
                                            small
                                            fab
                                            @click="dialogAgregarEstudiante = ! dialogAgregarEstudiante"
                                        > 
                                            <v-icon color="warning">fas fa-times</v-icon>
                                        </v-btn>
                                        </v-card-title>
                                        <v-form>
                                            <v-container  v-if="botonesAgregarEstudiantes">
                                                <v-row >
                                                    <v-col sm="6">
                                                        <v-btn 
                                                        x-large
                                                        block
                                                        color="secondary"
                                                        @click="mostrarAgregarEstudiantesUnico" >
                                                            <v-icon class="pr-2">
                                                                fas fa-user-graduate
                                                            </v-icon>
                                                            <h4>Individual</h4>
                                                        </v-btn>
                                                    </v-col>
                                                    <v-col sm="6">
                                                        <v-btn 
                                                        x-large
                                                        block
                                                        color="secondary"
                                                        @click="mostrarAgregarEstudiantesImportar" >
                                                            <v-icon class="pr-2">
                                                                fas fa-file-upload
                                                            </v-icon>
                                                            <h4>Importar xlsx</h4>
                                                        </v-btn>
                                                    </v-col>
                                                </v-row>

                                            </v-container>
                                            <v-container class="px-5 mt-5" color="primary" v-if="containerAgregarEstudianteUnico">
                                                
                                                    <v-text-field  
                                                    v-model="estudianteImportar.matricula"
                                                    label="Matricula" outlined
                                                    color="secondary"
                                                    prepend-inner-icon="fas fa-graduation-cap"
                                                    ></v-text-field>

                                                    <v-text-field  
                                                    v-model="estudianteImportar.rut"
                                                    label="Rut" outlined
                                                    color="secondary"
                                                    prepend-inner-icon="fas fa-address-card"
                                                    ></v-text-field>

                                                    <v-text-field  
                                                    v-model="estudianteImportar.nombre_completo"
                                                    label="Nombre completo" outlined
                                                    color="secondary"
                                                    prepend-inner-icon="mdi-account"
                                                    ></v-text-field>

                                                    <v-text-field 
                                                    v-model="estudianteImportar.correo"
                                                    label="Correo Electronico"
                                                    outlined
                                                    color="secondary"
                                                    prepend-inner-icon="mdi-email"
                                                    ></v-text-field>

                                                    <v-text-field  
                                                    v-model="estudianteImportar.anho_ingreso"
                                                    label="Año ingreso" outlined
                                                    color="secondary"
                                                    prepend-inner-icon="fas fa-hashtag"
                                                    ></v-text-field>

                                                    <v-select   
                                                    v-model="estudianteImportar.situacion_academica"
                                                    :items="listaSituacionAcademica"
                                                    item-text="nombre"
                                                    label="Situacion academica" outlined
                                                    color="secondary"
                                                    prepend-inner-icon="fas fa-address-book"
                                                    ></v-select >

                                                    <v-select 
                                                    v-model="estudianteImportar.escuela" 
                                                    :items="listaEscuela"
                                                    item-text="nombre"
                                                    item-value="id"
                                                    label="Escuela"
                                                    outlined
                                                    prepend-inner-icon="fas fa-book"
                                                    ></v-select>
                                                    <div style="text-align:right;" class="mb-1">
                                                        <v-btn rounded color="warning" 
                                                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                                                        @click="volverYcerrarAgregarEstudiantes"
                                                        >
                                                            <h4 class="white--text">Cancelar</h4>
                                                        </v-btn>
                                                        <v-btn 
                                                        @click="agregarEstudiantesUnico"
                                                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                                                        rounded color="secondary" class="ml-2"   >
                                                            <h4 class="white--text">Aceptar</h4>
                                                        </v-btn>
                                                    </div>
                                                
                                            </v-container>
                                            <v-container v-if="containerAgregarEstudianteImportar" class="px-5 mt-5">
                                                <v-file-input 
                                                id="file" 
                                                v-model="file"
                                                ref="file" 
                                                type="file"
                                                label="Seleccione un archivo"
                                                color="secondary"
                                                outlined
                                                prepend-icon=""   
                                                prepend-inner-icon="fas fa-file-excel"
                                                >
                                                </v-file-input>
                                                <div style="text-align:right;" class="mb-1">
                                                    <v-btn rounded color="warning" 
                                                    :small="$vuetify.breakpoint.smAndDown ? true : false"
                                                    @click="volverYcerrarAgregarEstudiantes"
                                                    >
                                                        <h4 class="white--text">Cancelar</h4>
                                                    </v-btn>
                                                    <v-btn rounded color="secondary" class="ml-2"   
                                                    :small="$vuetify.breakpoint.smAndDown ? true : false"
                                                    @click="agregarEstudiantesImportar">
                                                        <h4 class="white--text">Aceptar</h4>
                                                    </v-btn>
                                                </div>
                                            </v-container>
                                            
                                        </v-form> 
                                    </v-card>
                                </v-dialog>
                                <v-dialog v-model="dialogExportar" persistent max-width="600px">
                                    <template v-slot:activator="{ on}" >
                                        <v-btn
                                        fab
                                        bottom
                                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                                        left
                                        v-on="on"
                                        class="ml-2"
                                        >
                                            <v-icon class="mx-2" color="secondary">fas fa-file-download</v-icon>
                                        </v-btn>
                                    </template>
                                    <v-card elevation="1">
                                        <v-card-title
                                        class="headline primary text--center"
                                        primary-title
                                        >
                                        <strong class="white--text "> Exportar estudiantes</strong>
                                        </v-card-title>
                                        <h4 class="px-5 pt-6">Ingrese el periodo de datos que desea exportar:</h4>
                                        <v-container class="pt-0">
                                            <v-row class="justify-right px-5">
                                                <v-col cols="1"> 
                                                    <v-radio-group column class="pt-0 mt-0">
                                                        <v-radio
                                                            class="pb-2 mt-3"
                                                            color="secondary"
                                                            @mousedown="todosLosAnhos"                                                        
                                                        >
                                                        </v-radio>
                                                        <v-radio
                                                            class="pb-2 mt-6"
                                                            color="warning"
                                                            @mousedown="unAnho" 
                                                        ></v-radio>
                                                        <v-radio
                                                            class="pb-2 mt-6"
                                                            color="accent"
                                                            @mousedown="rangoAnhos" 
                                                        ></v-radio>
                                                    </v-radio-group>
                                                </v-col>
                                                <v-col cols="5" class="mt-3">
                                                    <h4 class="mb-10">Todos los años </h4>
                                                    <h4 class="mb-10">Ingrese el año a exportar :</h4>
                                                    <h4 >Ingrese el rango de años  :</h4>
                                            
                                                </v-col>
                                                <v-col cols="6">
                                                    <v-row class="mt-12 pt-5 mb-0 pb-0">
                                                        <v-col cols="6" class="mt-0 pt-0 mb-0 pb-0">
                                                            <v-text-field
                                                            v-model="anhov1"
                                                            dense
                                                            outlined
                                                            color="secondary"
                                                            :disabled="unAnhoVariable"
                                                            :rules="rules"
                                                            type="number"
                                                            ></v-text-field>
                                                        </v-col>
                                                    </v-row>
                                                    <v-row class="mt-0 pt-0 mb-0 pb-0">
                                                        
                                                        <v-col cols="6" class="mt-0 pt-0 mb-0 pb-0">
                                                            
                                                            <v-text-field
                                                            v-model="anhov2"
                                                            dense
                                                            outlined
                                                            color="secondary"
                                                            :disabled="rangoAnhosVariable"
                                                            :rules="rules"
                                                            type="number"
                                                            ></v-text-field>
                                                        </v-col>
                                                        <v-col cols="6" class="mt-0 pt-0 mb-0 pb-0">
                                                            <v-text-field
                                                            v-model="anhov3"
                                                            dense
                                                            color="secondary"
                                                            :disabled="rangoAnhosVariable"
                                                            :rules="rules"
                                                            outlined
                                                            type="number"
                                                            ></v-text-field>
                                                        </v-col>
                                                    </v-row>
                                                    
                                                </v-col>
                                            </v-row>
                                            <v-alert 
                                            v-model="alertaErrorRangoAnhos"
                                            dismissible
                                            type="error">
                                            El año de inicio no puede ser mayor al del final
                                            </v-alert>
                                            <div style="text-align:right;" class="mb-1 mr-5">
                                                <v-btn rounded color="warning" 
                                                :small="$vuetify.breakpoint.smAndDown ? true : false"
                                                @click="resetYCerrarExportar"
                                                >
                                                    <h4 class="white--text">Cancelar</h4>
                                                </v-btn>
                                                <v-btn rounded color="secondary" class="ml-2"  
                                                :small="$vuetify.breakpoint.smAndDown ? true : false"
                                                @click="exportarEstudiantes" >
                                                    <h4 class="white--text">Aceptar</h4>
                                                </v-btn>
                                            </div>
                                        </v-container>
                                            
                                    </v-card>
                                </v-dialog>
                            </v-col>
                        </v-row>
                    </v-card-title>
                    </v-img>
                <v-data-table
                :headers="headers"
                :items="listaEstudiantes"
                :search="buscar"
                :loading="cargando"
                style="font-size: 140%;"
                class="elevation-1 "
                >
                    <template v-slot:item.actions="{ item }">
                        <v-tooltip bottom color="primary">
                            <template v-slot:activator="{ on }">
                                <v-btn color="white" fab small depressed class="mr-2 py-2" v-on="on" @click="perfilEstudiante(item)">
                                    <v-icon  
                                    color="primary"
                                    >
                                    fas fa-external-link-alt
                                    </v-icon>
                                </v-btn>
                            </template>
                            <span><strong>Ver Perfil</strong></span>
                        </v-tooltip>
                    </template>                                                         
                </v-data-table>
                </v-card>
            </v-col>
            <v-col cols="12" md="1">
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
        dialog: false,
        dialogModificar: false,
        dialogEliminar: false,
        dialogAgregarEstudiante: false,

        headers: [
            { text: 'Matricula',align: 'start',value: 'matricula',sortable: true},
            { text: 'Rut', value: 'rut',sortable: true, },
            { text: 'Nombre Completo', value: 'nombre_completo',sortable: false, },
            { text: 'Correo', value: 'correo',sortable: false, },
            { text: 'Ingreso', value: 'anho_ingreso',sortable: true, },
            { text: 'Situación Acad.', value: 'situacion_academica',sortable: false, },
            { text: 'Escuela', value: 'escuela',sortable: false, },
            { text: 'Ir',align: 'center', value: 'actions', sortable: false },
        ],
        buscar: '',
        botonesAgregarEstudiantes: true,
        containerAgregarEstudianteUnico:false,
        containerAgregarEstudianteImportar:false,

        listaEstudiantes:[],
        listaEstudiantesAux:[],
        dessertsAux:[],
        listaEscuelaAux:[],
        todosLosAnhosVariable: true,
        unAnhoVariable: true,
        rangoAnhosVariable: true,
        anhov1: new Date().getFullYear(),
        anhov2: new Date().getFullYear(),
        anhov3: new Date().getFullYear(),
        alertaErrorRangoAnhos: false,
        dialogExportar: false,
        rules: [
        value => !!value || 'Requerido',
        value => value <= new Date().getFullYear()|| 'El año no debe ser mayor al actual',
        value => value >= 1981 || 'El año no debe ser menor a 1981',
        ],
        //archivo
        file: null,
        import_file: '',
        //estudiante
        estudianteImportar: {
            matricula:'',
            rut:'',
            nombre_completo:'',
            correo:'',
            anho_ingreso:'',
            situacion_academica:'',
            escuela:'',
        },
        cargando: true,    
        alertError: false,
        textoError: '',
        alertAcept: false,
        textoAcept: '',
        delay: 4000,
        listaSituacionAcademica:[
            'Regular ','Egresado ', 'Eliminado ', 'Titulado',
            'Intercambio','Postergación','Retiro','Temporal'
        ]

    }),
    computed: {
        ...mapState(['admin','secretariaEscuela'])
    },
    watch: {
    },
    beforeMount(){
        this.obtenerEstudiantes();
    },
    //beforeCreate(){
        //this.obtenerEstudiantes();
    //},
    created () {
        this.obtenerEscuelas();
    },
    methods: {
        nada(item){
            
        },
        volverAgregarEstudiantes(){
            this.botonesAgregarEstudiantes= true;
            this.containerAgregarEstudianteUnico= false;
            this.containerAgregarEstudianteImportar=false;
        },
        volverYcerrarAgregarEstudiantes(){
            this.dialogAgregarEstudiante = ! this.dialogAgregarEstudiante;
            this.botonesAgregarEstudiantes= true;
            this.containerAgregarEstudianteUnico= false;
            this.containerAgregarEstudianteImportar=false;
        },
        mostrarAgregarEstudiantesUnico(){
            this.botonesAgregarEstudiantes= false;
            this.containerAgregarEstudianteUnico= true;
        },
        agregarEstudiantesImportar(){
            let formData = new FormData();
            formData.append('file',this.file);
            var url = 'http://127.0.0.1:8000/api/v1/estudiante/importar';
            axios.post(url,formData,this.$store.state.config)
            .then((result)=>{
                console.log(result);
                if (result.data.success == true) {
                    this.resetImportarEstudiantes();
                    this.obtenerEstudiantes();
                }
            })
            .catch((error)=>{
                console.log(error);
                if (error.message == 'Network Error') {
                    console.log(error);
                    this.alertError = true;
                    this.cargando = false;
                    console.log(err)
                    this.textoError = 'Error al importar los datos, intente más tarde'
                }
            })
        },
        obtenerEstudiantes(){
            this.cargando = true;
            this.listaEstudiantes = [];
            var url = 'http://127.0.0.1:8000/api/v1/estudiante';
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                console.log(result.data);
                if (result.data.success == true) {
                    for (let index = 0; index < result.data.data.estudiantes.length; index++) {
                    const element = result.data.data.estudiantes[index];
                    console.log(element)
                    let estudiante = {
                        id: element.id,
                        matricula: element.matricula,
                        rut: element.rut,
                        nombre_completo: element.nombre_completo,
                        correo: element.correo,
                        anho_ingreso: element.anho_ingreso,
                        situacion_academica: element.situacion_academica,
                        escuela: element.escuela,
                    };
                    this.listaEstudiantesAux[index]=estudiante;
                    }
                    this.cargando = false;
                    this.listaEstudiantes = this.listaEstudiantesAux;
                }
            })
            .catch((error)=>{
                if (error.message == 'Network Error') {
                    console.log(error);
                    this.alertError = true;
                    this.cargando = false;
                    console.log(err)
                    this.textoError = 'Error al cargar los datos, intente más tarde'
                } else {
                    if (error.response.data.success == false) {
                        switch (error.response.data.code) {
                        case 301:
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
        agregarEstudiantesUnico() {
            var url = 'http://127.0.0.1:8000/api/v1/estudiante';
            var escuelaAux = 1;
            for (let index = 0; index < this.listaEscuela.length; index++) {
                const element = this.listaEscuela[index];
                if (element.nombre == this.estudianteImportar.escuela) {
                    escuelaAux = element.id;
                    break;
                }
            }
            let post = {
                "matricula": this.estudianteImportar.matricula,
                "rut": this.estudianteImportar.rut,
                "nombre_completo": this.estudianteImportar.nombre_completo,
                "correo": this.estudianteImportar.correo,
                "anho_ingreso": this.estudianteImportar.anho_ingreso,
                "situacion_academica": this.estudianteImportar.situacion_academica,
                "porcentaje_avance":0,
                "creditos_aprobados":0,
                "escuela": this.estudianteImportar.escuela
            };
            axios.post(url,post,this.$store.state.config)
            .then((result)=>{
                if (result.data.success == true)  {
                    console.log('se cargo el estudiante');
                    this.resetUnicoEstudiante();
                    this.alertAcept = true;
                    this.textoAcept = 'Se agregó el estudiante correctamente '
                    this.obtenerEstudiantes();
                }
            })
            .catch((error)=>{
                if (error.message == 'Network Error') {
                    console.log(error);
                    this.alertError = true;
                    this.resetUnicoEstudiante();
                    this.textoError = 'Error al cargar los datos, intente más tarde'
                } else {
                    if (error.response.data.success == false) {
                        switch (error.response.data.code) {
                        case 302:
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
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
        mostrarAgregarEstudiantesImportar(){
            this.botonesAgregarEstudiantes= false;
            this.containerAgregarEstudianteImportar= true;
        },
        obtenerEscuelas(){
            this.listaEscuelaAux = [];
            var url = 'http://127.0.0.1:8000/api/v1/escuela';
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                if (result.data.success == true) {
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
            })
            .catch((error) => {
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
        todosLosAnhos(){
            this.todosLosAnhosVariable= false;
            this.unAnhoVariable= true;
            this.rangoAnhosVariable= true;
            this.anhov1= new Date().getFullYear();
            this.anhov2= new Date().getFullYear();
            this.anhov3= new Date().getFullYear();
            
        },
        unAnho(){
            this.todosLosAnhosVariable= true;
            this.unAnhoVariable= false;
            this.rangoAnhosVariable= true;
            this.anhov2= new Date().getFullYear();
            this.anhov3= new Date().getFullYear();
            
        },
        rangoAnhos(){
            this.todosLosAnhosVariable= true;
            this.unAnhoVariable= true;
            this.rangoAnhosVariable=false;
            this.anhov1= new Date().getFullYear();
            
        },
        resetYCerrarExportar(){
            this.dialogExportar = false;
            this.anhov1= new Date().getFullYear();
            this.anhov2= new Date().getFullYear();
            this.anhov3= new Date().getFullYear();
        },
        exportarEstudiantes(){
            //if (this.anhov2 > this.anhov3) {
                //this.alertaErrorRangoAnhos = true;
                //console.log('rango mal');
            //}
            var url = 'http://127.0.0.1:8000/api/v1/exportar';
            axios.get(url,this.$store.state.config2)
            .then((result)=>{
                console.log(result);
                //var fileDownload = require('js-file-download');
                //fileDownload(result.data, 'archivo.xlsx');
                

                const url = URL.createObjectURL(new Blob([result.data], {
                    type: 'application/vnd.ms-excel'
                }))
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'estudiante.xlsx');
                document.body.appendChild(link);
                link.click();
                this.alertAcept = true;
                this.textoAcept = 'Se realizó la operación correctamente'
                
            })
            .catch((error) => {
                onsole.log(error);
                if (error.message == 'Network Error') {
                    console.log(error);
                    this.alertError = true;
                    this.textoError = 'Error, intente más tarde'
                } else {
                    console.log(error);
                    this.alertError = true;
                    this.textoError = 'Error, intente más tarde'
                } 
            });
        },
        resetImportarEstudiantes(){
            this.file = null;
            this.dialogAgregarEstudiante= false;
        },
        resetUnicoEstudiante(){
            this.estudianteImportar.matricula='';
            this.estudianteImportar.rut="";
            this.estudianteImportar.nombre_completo="";
            this.estudianteImportar.correo="";
            this.estudianteImportar.anho_ingreso="";
            this.estudianteImportar.situacion_academica="";
            this.estudianteImportar.escuela="";
            this.dialogAgregarEstudiante= false;
        },
        perfilEstudiante(item){
            this.$store.state.perfilEstudiante = item;
            this.$router.push({path:'/administrador/estudiantes/'+item.rut});
        },

    },
}
</script>
