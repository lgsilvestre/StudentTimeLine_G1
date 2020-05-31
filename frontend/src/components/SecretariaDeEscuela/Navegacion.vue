<template>
    <v-navigation-drawer
    app
    v-model="drawer"
    right
    premanent    
    :mini-variant.sync=drawelAdmin
    src="https://cdn.discordapp.com/attachments/445385683742490626/709958855747960862/weaverde.png"
    >
    <!-- Lista general del navigation drawer -->
        <!-- Seccion de Mi Perfil -->
        <v-list>
            <v-list-item link @click="Perfil">
                <!-- Imagen o Avatar -->
                <v-list-item-avatar>
                    <v-img src="http://www.ingenieria.utalca.cl/Repositorio/PNsAYcfZiO2QfjGDQMIyjMOAomsLch/Ruth%20Garrido.jpg"></v-img>
                </v-list-item-avatar>    
                <!-- Nombre del Usuario -->
                <v-list-item-title class="justify:center"> Secretaria de Escuela</v-list-item-title>                       
            </v-list-item>

            <v-divider class="my-1"></v-divider>

            <!-- Menu de Operaciones Profesor -->
            <v-menu            
            offset-y
            >
                <template v-slot:activator="{ on }">
                    <v-list-item v-on="on" >
                        <v-list-item-icon>
                            <v-icon color="white">fas fa-chalkboard-teacher</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Profesores</v-list-item-title>                            
                    </v-list-item>
                </template>

                <!-- Lista que se despliega del menu (opciones relacionadas con profesor) -->
                <v-list>
                    <v-list-item
                        v-for="opcion in profesores"
                        :key=opcion
                        @click="opcion"
                    >
                        <v-list-item-title> {{opcion}} </v-list-item-title>
                    </v-list-item>                                        
                </v-list>
            </v-menu> 

            <!-- Menu de Operaciones Cursos -->
            <v-menu
            absolute
            offset-y
            >    
                <template v-slot:activator="{ on }" >
                    <v-list-item v-on="on">
                        <v-list-item-icon>
                            <v-icon color="white">fas fa-book-reader</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title >Cursos</v-list-item-title>                            
                    </v-list-item>
                </template>
                <!-- Lista que se despliega del menu (opciones relacionadas con cursos) -->
                <v-list>
                    <v-list-item
                        v-for="opcion in cursos"
                        :key=opcion
                        @click="opcion"
                    >
                        <v-list-item-title> {{opcion}} </v-list-item-title>
                    </v-list-item>                                        
                </v-list>
            </v-menu>

            <!-- Menu de Operaciones Estudiantes -->
            <v-menu
            absolute
            offset-y
            >    
                <template v-slot:activator="{ on }">
                    <v-list-item v-on="on">
                        <v-list-item-icon>
                            <v-icon color="white">fas fa-user-graduate</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Estudiantes</v-list-item-title>                            
                    </v-list-item>
                </template>
                <!-- Lista que se despliega del menu (opciones relacionadas con estudiantes) -->
                <v-list>
                    <v-list-item
                        v-for="opcion in estudiantes"
                        :key=opcion
                        @click="opcion"
                    >
                        <v-list-item-title> {{opcion}} </v-list-item-title>
                    </v-list-item>                                        
                </v-list>
            </v-menu>

            <!-- Menu de Operaciones Observaciones -->
            <v-menu
            absolute
            offset-y
            >    
                <template v-slot:activator="{ on }">
                    <v-list-item v-on="on">
                        <v-list-item-icon>
                            <v-icon color="white">far fa-eye</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Observaciones</v-list-item-title>                            
                    </v-list-item>
                </template>
                <!-- Lista que se despliega del menu (opciones relacionadas con observaciones) -->
                <v-list>
                    <v-list-item
                        v-for="opcion in observaciones"
                        :key=opcion
                        @click="opcion"
                    >
                        <v-list-item-title> {{opcion}} </v-list-item-title>
                    </v-list-item>                                        
                </v-list>
            </v-menu>                               

        </v-list>        
    </v-navigation-drawer>
</template>

<script>
import {mapState} from 'vuex';
export default {
    data(){
        return{
            drawer: true,
            profesores: ['Habilitar Cuenta Profesor','Deshabilitar Cuenta Profesor'],
            cursos:['Crear Curso','Modificar Curso','Habilitar Curso', 'Deshabilitar Curso'],
            estudiantes:['Ver Lista Estudiantes'],
            observaciones:['Crear Observacion','Modificar Observacion','Eliminar Observacion'],
        }
    },
    computed: {
        ...mapState(['drawelAdmin']),
    },
}
</script>