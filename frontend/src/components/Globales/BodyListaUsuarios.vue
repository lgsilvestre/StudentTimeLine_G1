<template>
    <v-card
        class="mx-auto my-10"
        max-width="70%"        
    >
        <v-img
            class="mx-auto white--text align-end justify-center"
            height="180px"        
            src="@/assets/Globales/background-panel-07.jpg"            
            >                    
            <v-card-title>     
                <v-icon class="mx-3" color="white">fas fa-users</v-icon>    

                <!-- Titulo -->
                <strong> Lista Usuarios </strong>

                <v-spacer></v-spacer>

                <v-btn  
                fab
                color="white"
                @click.stop="registrarUsuario()"
                >
                    <v-icon color="red">fas fa-plus</v-icon>
                </v-btn> 
                
            </v-card-title>                                                                                   
        </v-img>

        <v-card-subtitle>
            <!-- campo de filtrado -->
            <v-text-field
                v-model="search"
                label="Filtrar"
                outlined
                hide-details
            ></v-text-field>
        </v-card-subtitle>
        
        <!-- propiedades tablas -->
        <v-data-table        
            :headers="columnas"
            :items="datosAlumnos"
            :search="search"
            :items-per-page="10"            
        >            
            <template v-slot:item.opciones="{ item }">
                <!-- boton para modificar usuario seleccionado -->
                <v-icon     
                    class="mx-1 justify-center"           
                    @click="modificarUsuario(item)"
                >
                fas fa-edit
                </v-icon>
                <!-- boton para eliminar usuario seleccionado -->
                <v-icon
                    class="mx-1 justify-center"            
                    @click="eliminarUsuario(item)"
                >
                fas fa-trash-alt
                </v-icon>
            </template>
        </v-data-table>

    </v-card>
</template>

<script>
export default {
    data() {
        name: 'listaEstudiantes'
        return{
            search:'',
            columnas:[
                {text:'Matricula', value:'matricula'},
                {text:'RUT', value:'rut'},
                {text:'Apellido Paterno', value:'apellidoP'},                             
                {text:'Apellido Materno', value:'apellidoM'},
                {text:'Nombre', value:'nombre'},
                {text:'Opciones', value:'opciones'},
            ],
            datosAlumnos:[

                /* Datos de prueba */
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
                {matricula: '2016424151', rut: '12.345.678-9', apellidoP:'gonzales', apellidoM: 'gonzalez', nombre: 'Juan'},
                {matricula: '2016125125', rut: '12.345.678-9', apellidoP:'martinez', apellidoM: 'martinez', nombre: 'Juan'},
                {matricula: '2010592243', rut: '12.345.678-9', apellidoP:'carrasco', apellidoM: 'carrasco', nombre: 'Juan'},
                {matricula: '2015648584', rut: '12.345.678-9', apellidoP:'pizarro', apellidoM: 'pizarro', nombre: 'Juan'},
                {matricula: '2017523985', rut: '12.345.678-9', apellidoP:'milla', apellidoM: 'milla', nombre: 'Juan'},
                {matricula: '2125282343', rut: '12.345.678-9', apellidoP:'ibarra', apellidoM: 'ibarra', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'ramirez', apellidoM: 'ramirez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'bustamante', apellidoM: 'bustamante', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'pinto', apellidoM: 'pinto', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'parraguez', apellidoM: 'parraguez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'escobar', apellidoM: 'escobar', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'alvarez', apellidoM: 'alvarez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
                {matricula: '2016407001', rut: '12.345.678-9', apellidoP:'Perez', apellidoM: 'Perez', nombre: 'Juan'},
            ],
        }

    },
    methods: {
        modificarUsuario(){

        },
        eliminarUsuario(){
            
        }
    }
}
</script>