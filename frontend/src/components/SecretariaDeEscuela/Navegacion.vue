<template>
    <v-navigation-drawer
    app
    v-model="drawer"
    right
    premanent    
    :mini-variant.sync=drawelAdmin  
    src="@/assets/Globales/background-panel-02.jpg"
    >
    <!-- Mis recomendaciones de fondo (?)  1, 2, 4, 7, 9,  -->  

    <!-- Lista general del navigation drawer -->
        <!-- Seccion de Mi Perfil -->
        <v-list >
            <v-list-item @click="verPerfil" class="px-2 difuminado">
                <!-- Imagen o Avatar -->
                <v-list-item-avatar>
                    <v-img src="http://www.ingenieria.utalca.cl/Repositorio/PNsAYcfZiO2QfjGDQMIyjMOAomsLch/Ruth%20Garrido.jpg"></v-img>
                </v-list-item-avatar>    
                <!-- Nombre del Usuario -->
                <v-list-item-title class="white--text letra"><strong>Sria. de Escuela</strong></v-list-item-title>                       
            </v-list-item>

            <v-divider></v-divider>
            <v-list-item @click="profesores" class="difuminado">
                <v-list-item-icon>
                    <v-icon color="white">fas fa-chalkboard-teacher</v-icon>
                </v-list-item-icon>
                <v-list-item-title class="white--text letra"><strong>Profesores</strong></v-list-item-title>                            
            </v-list-item>

            <v-list-item @click="cursos" class="difuminado">
                <v-list-item-icon >
                    <v-icon color="white">fab fa-accusoft</v-icon>
                </v-list-item-icon>
                <v-list-item-title class="white--text letra"><strong>Cursos</strong></v-list-item-title>                            
            </v-list-item>

            <v-list-item @click="estudiantes" class="difuminado">
                <v-list-item-icon >
                    <v-icon color="white">fas fa-user-graduate</v-icon>
                </v-list-item-icon>
                <v-list-item-title class="white--text letra"><strong>Estudiantes</strong></v-list-item-title>                            
            </v-list-item>

            <v-list-item @click="observaciones" class="difuminado">
                <v-list-item-icon >
                    <v-icon color="white">fas fa-archway</v-icon>
                </v-list-item-icon>
                <v-list-item-title class="white--text letra"><strong>Observaciones</strong></v-list-item-title>                            
            </v-list-item>

            <v-list-item @click="contactar" class="difuminado">
                <v-list-item-icon>
                    <v-icon color="white">fas fa-envelope</v-icon>
                </v-list-item-icon>
                <v-list-item-title class="white--text letra" ><strong>Contactar</strong></v-list-item-title>                            
            </v-list-item>
                     
        </v-list>

        <template v-slot:append >
        <div >
          <v-btn block color="primary   " @click="cerrarSesion">Cerrar sesión</v-btn>
        </div>
      </template>        

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
    methods: {
        verPerfil(){

        },
        contactar(){
            
        },
    },
}
</script>

<style scoped>
    .difuminado{
        text-shadow: #555 2px 2px 3px;
    }
    .letra{
        font-size: 125%;
    }
</style>