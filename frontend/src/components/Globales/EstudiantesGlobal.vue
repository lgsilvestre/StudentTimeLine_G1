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
                    <v-card-title class="white--text " > 
                            <v-col md="3" class="align-self-end" style="text-align:left; text-shadow: #555 2px 2px 3px; font-size:150% ;">
                                        <v-icon class="pb-2" color="white" style="font-size:100% ;">fas fa-user-graduate</v-icon>
                                        <strong class="pl-2" style="font-size:95% ">Estudiantes</strong>
                            </v-col>
                            <v-col  md="6" class="align-self-end" style="text-align:center;">
                                <v-text-field
                                    v-model="buscar"
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
                            <v-col  md="3" class="align-self-end" style="text-align:right;">
                                <v-dialog v-model="dialog"  max-width="500px">
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                        fab
                                        large
                                        bottom
                                        left
                                        v-on="on"
                                        v-show="admin || secretariaEscuela"
                                        >
                                            <v-icon class="mx-2" color="warning">fas fa-plus</v-icon>
                                        </v-btn>
                                    </template>
                                    <v-card elevation="1" shaped>
                                        <v-card-title
                                        class="headline primary text--center"
                                        primary-title
                                        >
                                        <h5 class="white--text ">Agregar estudiantes</h5>
                                        </v-card-title>
                                        <v-form>
                                            <v-container class="px-10">
                                                <h2>agregando estudiantes</h2>
                                            </v-container>
                                            
                                        </v-form> 
                                    </v-card>
                                </v-dialog>
                                <v-dialog  max-width="500px">
                                    <template v-slot:activator="{ on}" >
                                        <v-btn
                                        fab
                                        large
                                        bottom
                                        left
                                        v-on="on"
                                        class="ml-2"
                                        >
                                            <v-icon class="mx-2" color="secondary">fas fa-file-download</v-icon>
                                        </v-btn>
                                    </template>
                                    <v-card elevation="1" shaped>
                                        <v-card-title
                                        class="headline primary text--center"
                                        primary-title
                                        >
                                        <h5 class="white--text ">Exportar estudiantes</h5>
                                        </v-card-title>
                                        <v-form>
                                            <v-container class="px-10 ">
                                                <h2>exportando estudiantes</h2>
                                            </v-container>
                                        </v-form> 
                                    </v-card>
                                </v-dialog>
                            </v-col>
                    </v-card-title>
                    </v-img>
                <v-data-table
                :headers="headers"
                :items="desserts"
                :search="buscar"
                class="elevation-1 "
                >
                    <template v-slot:item.actions="{ item }">
                    <v-btn color="white" fab small depressed class="mr-2 py-2">
                        <v-icon  
                        color="primary"
                        @click="nada(item)"
                        >
                        fas fa-edit
                        </v-icon>
                    </v-btn>
                    
                    </template>                                                         
                </v-data-table>
                    
                </v-card>
            </v-col>
            <v-col cols="12" md="1">
            </v-col>          
        </v-row>
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
        headers: [
            { text: 'Matricula',align: 'start',value: 'matricula',sortable: true},
            { text: 'Rut', value: 'rut',sortable: true, },
            { text: 'Nombre Completo', value: 'nombre_completo',sortable: false, },
            { text: 'Correo', value: 'correo',sortable: false, },
            { text: 'Año ingreso', value: 'anho_ingreso',sortable: true, },
            { text: 'Situación academica', value: 'situacion_academica',sortable: false, },
            { text: 'Escuela', value: 'escuela',sortable: false, },
            { text: 'Opciones', value: 'actions', sortable: false },
        ],
        buscar: '',
        desserts:[
            {
                matricula: '2000407026',
                rut: '13352079',
                nombre_completo:'BUSTAMANTE GONZÁLEZ RODRIGO ARTURO',
                correo:'robustamante@utalca.cl',
                anho_ingreso:'2000',
                situacion_academica:'REGULAR',
                escuela:'INGENIERIA CIVIL EN COMPUTACIÓN',
            },
            {
                matricula: '2000407026',
                rut: '13352079',
                nombre_completo:'Felipe Milla Calquin',
                correo:'robustamante@utalca.cl',
                anho_ingreso:'2000',
                situacion_academica:'REGULAR',
                escuela:'INGENIERIA CIVIL EN COMPUTACIÓN',
            },
            {
                matricula: '2015407423',
                rut: '19550773',
                nombre_completo:'BUSTAMANTE GONZÁLEZ RODRIGO ARTURO',
                correo:'robustamante@utalca.cl',
                anho_ingreso:'2000',
                situacion_academica:'REGULAR',
                escuela:'INGENIERIA CIVIL EN COMPUTACIÓN',
            },
            {
                matricula: '2000407026',
                rut: '13352079',
                nombre_completo:'BUSTAMANTE GONZÁLEZ RODRIGO ARTURO',
                correo:'robustamante@utalca.cl',
                anho_ingreso:'2015',
                situacion_academica:'REGULAR',
                escuela:'INGENIERIA CIVIL EN COMPUTACIÓN',
            },
            {
                matricula: '2000407026',
                rut: '13352079',
                nombre_completo:'BUSTAMANTE GONZÁLEZ RODRIGO ARTURO',
                correo:'robustamante@utalca.cl',
                anho_ingreso:'2022',
                situacion_academica:'REGULAR',
                escuela:'INGENIERIA CIVIL EN COMPUTACIÓN',
            },
            {
                matricula: '2000407026',
                rut: '13352079',
                nombre_completo:'BUSTAMANTE GONZÁLEZ RODRIGO ARTURO',
                correo:'robustamante@utalca.cl',
                anho_ingreso:'2012',
                situacion_academica:'REGULAR',
                escuela:'INGENIERIA CIVIL EN COMPUTACIÓN',
            },
            {
                matricula: '2000407026',
                rut: '13352079',
                nombre_completo:'BUSTAMANTE GONZÁLEZ RODRIGO ARTURO',
                correo:'robustamante@utalca.cl',
                anho_ingreso:'2020',
                situacion_academica:'REGULAR',
                escuela:'INGENIERIA CIVIL EN COMPUTACIÓN',
            },
            {
                matricula: '2000407026',
                rut: '13352079',
                nombre_completo:'BUSTAMANTE GONZÁLEZ RODRIGO ARTURO',
                correo:'robustamante@utalca.cl',
                anho_ingreso:'2000',
                situacion_academica:'REGULAR',
                escuela:'INGENIERIA CIVIL EN COMPUTACIÓN',
            },
            {
                matricula: '2000407026',
                rut: '13352079',
                nombre_completo:'BUSTAMANTE GONZÁLEZ RODRIGO ARTURO',
                correo:'robustamante@utalca.cl',
                anho_ingreso:'2010',
                situacion_academica:'REGULAR',
                escuela:'INGENIERIA CIVIL EN COMPUTACIÓN',
            },
            {
                matricula: '2000407026',
                rut: '13352079',
                nombre_completo:'BUSTAMANTE GONZÁLEZ RODRIGO ARTURO',
                correo:'robustamante@utalca.cl',
                anho_ingreso:'2030',
                situacion_academica:'REGULAR',
                escuela:'INGENIERIA CIVIL EN COMPUTACIÓN',
            },
            {
                matricula: '2000407026',
                rut: '13352079',
                nombre_completo:'BUSTAMANTE GONZÁLEZ RODRIGO ARTURO',
                correo:'robustamante@utalca.cl',
                anho_ingreso:'2000',
                situacion_academica:'REGULAR',
                escuela:'INGENIERIA CIVIL EN COMPUTACIÓN',
            },
            {
                matricula: '2000407026',
                rut: '13352079',
                nombre_completo:'BUSTAMANTE GONZÁLEZ RODRIGO ARTURO',
                correo:'robustamante@utalca.cl',
                anho_ingreso:'2000',
                situacion_academica:'REGULAR',
                escuela:'INGENIERIA CIVIL EN COMPUTACIÓN',
            },
            {
                matricula: '2000407026',
                rut: '13352079',
                nombre_completo:'BUSTAMANTE GONZÁLEZ RODRIGO ARTURO',
                correo:'robustamante@utalca.cl',
                anho_ingreso:'2000',
                situacion_academica:'REGULAR',
                escuela:'INGENIERIA CIVIL EN COMPUTACIÓN',
            },
            {
                matricula: '2000407026',
                rut: '13352079',
                nombre_completo:'BUSTAMANTE GONZÁLEZ RODRIGO ARTURO',
                correo:'robustamante@utalca.cl',
                anho_ingreso:'2000',
                situacion_academica:'REGULAR',
                escuela:'INGENIERIA CIVIL EN COMPUTACIÓN',
            },
            {
                matricula: '2000407026',
                rut: '13352079',
                nombre_completo:'BUSTAMANTE GONZÁLEZ RODRIGO ARTURO',
                correo:'robustamante@utalca.cl',
                anho_ingreso:'2000',
                situacion_academica:'REGULAR',
                escuela:'INGENIERIA CIVIL EN COMPUTACIÓN',
            },
            
        ],
        dessertsAux:[],
    }),
    computed: {
        ...mapState(['admin','secretariaEscuela'])
    },
    watch: {
    },
    created () {
        
    },
    methods: {
        nada(item){
            
        }
    },
}
</script>

<style scoped>

</style>>

</style>