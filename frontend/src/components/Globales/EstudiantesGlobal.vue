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
                                                   <v-form ref="form_AgregarEstudiante" style="margin:0;padding:0;" v-model="form_AgregarEstudianteValido" lazy-validation>
                                                        <v-text-field  
                                                        v-model="estudianteImportar.matricula"
                                                        label="Matricula" outlined
                                                        color="secondary"
                                                        prepend-inner-icon="fas fa-graduation-cap"
                                                        type="number"
                                                        :rules="reglas_matricula"
                                                        ></v-text-field>

                                                        <v-text-field  
                                                        v-model="estudianteImportar.rut"
                                                        label="Rut" outlined
                                                        color="secondary"
                                                        prepend-inner-icon="fas fa-address-card"
                                                        :rules="reglas_rut"
                                                        ></v-text-field>

                                                        <v-text-field  
                                                        v-model="estudianteImportar.nombre_completo"
                                                        label="Nombre completo" outlined
                                                        color="secondary"
                                                        prepend-inner-icon="mdi-account"
                                                        :rules="reglas_Nombre"
                                                        ></v-text-field>

                                                        <v-text-field 
                                                        v-model="estudianteImportar.correo"
                                                        label="Correo Electronico"
                                                        outlined
                                                        color="secondary"
                                                        prepend-inner-icon="mdi-email"
                                                        :rules="regla_Email"
                                                        ></v-text-field>

                                                        <v-text-field  
                                                        v-model="estudianteImportar.anho_ingreso"
                                                        label="Año ingreso" outlined
                                                        color="secondary"
                                                        prepend-inner-icon="fas fa-hashtag"
                                                        type="number"
                                                        :rules="regla_anio"
                                                        ></v-text-field>

                                                        <v-select   
                                                        v-model="estudianteImportar.situacion_academica"
                                                        :items="listaSituacionAcademica"
                                                        item-text="nombre"
                                                        label="Situacion academica" outlined
                                                        color="secondary"
                                                        prepend-inner-icon="fas fa-address-book"
                                                        :rules="[v => !!v || 'La situación academica es requerida']"
                                                        ></v-select >

                                                        <v-select 
                                                        v-model="estudianteImportar.escuela" 
                                                        :items="listaEscuela"
                                                        item-text="nombre"
                                                        item-value="id"
                                                        label="Escuela"
                                                        outlined
                                                        prepend-inner-icon="fas fa-book"
                                                        :rules="[v => !!v || 'La Escuela es requerida']"
                                                        ></v-select>
                                                        <v-file-input  accept="image/png, image/jpeg, image/bmp" 
                                                        label="Seleccione una imagen"
                                                        color="secondary"
                                                        outlined
                                                        prepend-icon=""   
                                                        prepend-inner-icon="mdi-camera"
                                                        @change="convertirImagen"
                                                        v-model="estudianteImportar.foto">
                                                        </v-file-input>

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
                                                            rounded color="secondary" class="ml-2"   
                                                            :disabled="!form_AgregarEstudianteValido">
                                                                <h4 class="white--text">Aceptar</h4>
                                                            </v-btn>
                                                        </div>
                                                
                                                   </v-form>
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

                                <!-- Dialog exportar observaciones -->
                                <v-dialog v-model="dialogExportar" persistent max-width="500px">
                                    <template v-slot:activator="{ on}" >
                                        <v-btn fab bottom
                                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                                        left v-on="on" class="ml-2" >
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
                                                    <v-form ref="form2"  >
                                                    <v-radio-group column class="pt-0 mt-0">
                                                        <v-radio
                                                            class="pb-2 mt-5"
                                                            color="warning"
                                                            @mousedown="unAnho" 
                                                        ></v-radio>
                                                        <v-radio
                                                            class="pb-2 mt-9"
                                                            color="accent"
                                                            @mousedown="rangoAnhos" 
                                                        ></v-radio>
                                                    </v-radio-group>
                                                    </v-form>
                                                </v-col>
                                                <v-col cols="5" class="mt-5">
                                                    <h4 class="mb-8">Por Escuela :</h4>
                                                    <h4 class="pt-5" >Por rango de fecha:</h4>
                                                </v-col>
                                                <v-col cols="6">
                                                    <v-row class="mt-1 pt-1 mb-0 pb-0">
                                                        <v-col cols="12" class="mt-0 pt-0 mb-0 pb-0 ">
                                                            <v-form ref="form"  >
                                                                
                                                            <v-select   
                                                                v-model="escuelaExportar"
                                                                :items="listaEscuela"
                                                                item-text="nombre"
                                                                item-value="id"
                                                                label="Escuela" 
                                                                :disabled="unAnhoVariable"
                                                                outlined
                                                                dense
                                                                color="secondary"
                                                                ></v-select >
                                                            </v-form>
                                                        </v-col>
                                                    </v-row>
                                                    <v-row class="mt-0 pt-0 mb-0 pb-0">
                                                        
                                                        <v-col cols="6" class="mt-0 pt-0 mb-0 pb-0">
                                                            <v-menu ref="menu" v-model="menu" :close-on-content-click="false"
                                                            transition="scale-transition"
                                                            offset-y
                                                            min-width="290px"
                                                            :disabled="rangoAnhosVariable"> 
                                                                <template v-slot:activator="{ on, attrs }">
                                                                    <v-text-field v-model="fechaIni" 
                                                                    readonly v-bind="attrs" v-on="on" >
                                                                    </v-text-field>
                                                                </template>
                                                                <v-date-picker
                                                                ref="picker"
                                                                v-model="fechaIni"
                                                                :max="new Date().toISOString().substr(0, 10)"
                                                                min="1950-01-01"
                                                                @change="save"
                                                                @input="menu = false"
                                                                
                                                                ></v-date-picker>

                                                            </v-menu>
                                                           
                                                        </v-col>
                                                        <v-col cols="6" class="mt-0 pt-0 mb-0 pb-0">  
                                                            <v-menu ref="menu2" v-model="menu2" :close-on-content-click="false"
                                                            transition="scale-transition"
                                                            offset-y
                                                            min-width="290px"
                                                            :disabled="rangoAnhosVariable"> 
                                                                <template v-slot:activator="{ on, attrs }">
                                                                    <v-text-field v-model="fechaTer" 
                                                                    readonly v-bind="attrs" v-on="on" >
                                                                    </v-text-field>
                                                                </template>
                                                                <v-date-picker
                                                                ref="picker"
                                                                v-model="fechaTer"
                                                                :max="new Date().toISOString().substr(0, 10)"
                                                                min="1950-01-01"
                                                                
                                                                @change="save"
                                                                @input="menu2 = false"
                                                                
                                                                ></v-date-picker>

                                                            </v-menu>
                                                           
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
        listaEscuela:[],
        
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
            foto:null,
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
        ],
        escuelaExportar:'',
        // todosLosAnhosVariable: true,
        unAnhoVariable: true,
        rangoAnhosVariable: true,
        // anhov1: new Date().getFullYear(),
        // anhov2: new Date().getFullYear(),
        // anhov3: new Date().getFullYear(),
        //mis varaibles para trabjar las fechas.

        
         fechaIni: new Date().toISOString().substr(0, 10),
        menu: false,

        menu2:false,
        fechaTer: new Date().toISOString().substr(0, 10),
        imagenMiniatura:null,
        /**
        Variables para la validacion de formularios.
         */
         form_AgregarEstudianteValido:true,
         reglas_matricula:[
             value => !!value || 'Requerido',
             value => value.length == 10 || 'La esta compuesta de 10 numeros',
         ],
         reglas_rut:[
             value => !!value || 'Requerido',
             value =>/^\d{1,2}\.\d{3}\.\d{3}[\-][0-9kK]{1}/.test(value) && value.length <= 12 || 'El Rut debe ser por ejemplo: 1.111.111-1',
         ],
         reglas_Nombre:[
                value => !!value || 'Requerido',
                v => /^[a-zA-Z ]{3,40}$/.test(v) || 'Largo del Nombre no Válido',
                v => /^[a-zA-Z ]+$/.test(v) || 'Nombre no Válido.'
        ],
        regla_Email: [
            value => !!value || 'Requerido',
            v => /.+@utalca.cl/.test(v) || /.+@alumnos.utalca.cl/.test(v) || 'Correo no Válido', 
        ],
        regla_Contraseña:[
            value => !!value || 'Requerido',
            v => /^[a-zA-Z0-9!"#$%&'()*+,\-./:;<=>?@[\\\]^_`{|}~]{8,}$/.test(v)  || 'Contraseña muy corta',
        ],
        regla_anio:[
            value => !!value || 'Requerido',
            value => value <= new Date().getFullYear()|| 'El año no debe ser mayor al actual',
            value => value >= 1981 || 'El año no debe ser menor a 1981'
        ],
    }),
    computed: {
        ...mapState(['admin','secretariaEscuela']),
    //     computedDateFormatted () {
    //     return this.formatDate(this.date)
    //   },
    },
     watch: {
         menu (val) {
        val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
      },
    },
    beforeMount(){
        this.obtenerEstudiantes();
        this.obtenerEscuelas();
    },
    created () {
        this.obtenerEscuelas();
    },
    methods: {

         save (date) {
        this.$refs.menu.save(date)
      },
      reset() {
        this.$refs.form.reset();
        this.$refs.form2.reset();
      },
      

        
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
                //console.log(result);
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
               //console.log(result.data);
                if (result.data.success == true) {
                    for (let index = 0; index < result.data.data.estudiantes.length; index++) {
                    const element = result.data.data.estudiantes[index];
                    //console.log(element)
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
            var valido=this.$refs.form_AgregarEstudiante.validate();
            console.log("semestre valido :" + valido)
            if(valido == true){

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
                    "escuela": this.estudianteImportar.escuela,
                    "foto": this.imagenMiniatura,
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
            }

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
            this.unAnhoVariable= true;
            this.rangoAnhosVariable= true;

            
        },
        unAnho(){
            this.unAnhoVariable= false;
            this.rangoAnhosVariable= true;
            
        },
        rangoAnhos(){
            this.unAnhoVariable= true;
            this.rangoAnhosVariable=false;
            
        },
        resetYCerrarExportar(){
            this.dialogExportar = false;
            this.reset();
            this.unAnhoVariable=true;
            this.rangoAnhosVariable=true;
            this.fechaIni= new Date().toISOString().substr(0, 10);
            this.fechaTer=new Date().toISOString().substr(0, 10);
        },
        exportarEstudiantes(){
            // console.log("EXPORTAR POR ESCUELA"+this.unAnhoVariable )
            // console.log("EXPORTAR POR RANGO DE FECHAS"+this.rangoAnhosVariable )
            if(this.unAnhoVariable == false){
                var escuela= this.escuelaExportar;
                 console.log("Exportar por escuela" + escuela)
                this.exportar(1,0,0,0,escuela);
                

            }
            if(this.rangoAnhosVariable == false  ){
                console.log("Exportar por ranfo de fechas")
                this.exportar(2,this.fechaIni,this.fechaTer ,0,0);

            }
        },
        
        //Exporta las observaciones de un estudiantes.
        exportar(tipo, fechaIni,fechaTer,idEstudiante,escuela){
            var fechaInicio=fechaIni;
            var fechaTermino =fechaTer;
             let post = {
                    "tipo": tipo,
                    "fechaInicio" : fechaInicio,
                    "fechaFin": fechaTermino ,
                    "id": idEstudiante,
                    "escuela": escuela
                };
                console.log(post)
            var url = 'http://127.0.0.1:8000/api/v1/estudiante/exportar';
            axios.post(url,post,this.$store.state.config2)
            .then((result)=>{
                console.log(result.data);
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
                this.dialogExportar=false;
                this.resetYCerrarExportar();
                
            })
            .catch((error) => {
                console.log(error);
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
            this.estudianteImportar.foto=null;
            this.dialogAgregarEstudiante= false;
        },
        perfilEstudiante(item){
            var estudiantes = "estudiantes";
            if (this.$store.state.usuario.usuario.rol == "admin") {
                this.$router.push({path:'/administrador/'+estudiantes+'/id='+item.id});
            } else {
                if (this.$store.state.usuario.usuario.rol == "secretaria de escuela") {
                    this.$router.push({path:'/secretariaEscuela/'+estudiantes+'/id='+item.id});
                } else {
                    if (this.$store.state.usuario.usuario.rol == "profesor") {
                        this.$router.push({path:'/profesor/'+estudiantes+'/id='+item.id});
                    }
                }
            }
        },

    },
}
</script>
