<template>
<v-navigation-drawer app right v-model=drawer  :mini-variant.sync=drawelAdmin permanentt  >
        <v-list-item class="px-2 py-1" @click="verPerfil">
            <v-list-item-avatar >
                <v-img src="@/assets/Profesor/unnamed.png"></v-img>
            </v-list-item-avatar>
            <v-list-item-title>Profesor</v-list-item-title>
        </v-list-item>
        <v-divider></v-divider>
        <v-list > 
            <v-menu open-on-hover offset-x left>
                <template v-slot:activator="{ on }">
                    <v-list-item  v-on="on" >
                        <v-list-item-icon>
                            <v-icon>fas fa-user-graduate</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Estudiantes</v-list-item-title>
                    </v-list-item>
                </template>
                <v-list>
                    <v-list-item @click="prueba" >
                        <v-list-item-icon>
                            <v-icon medium>fas fa-user-graduate</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Listar estudiante</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
            <v-menu open-on-hover offset-x left>
                <template v-slot:activator="{ on }">
                    <v-list-item  v-on="on" >
                        <v-list-item-icon>
                            <v-icon>fas fa-archway</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Observaciones</v-list-item-title>
                    </v-list-item>
                </template>
                <v-list>
                    <v-list-item @click="prueba" >
                        <v-list-item-icon>
                            <v-icon medium>fas fa-archway</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Crear observación</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="prueba" >
                        <v-list-item-icon>
                            <v-icon medium>fas fa-archway</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Listar observaciones</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="prueba" >
                        <v-list-item-icon>
                            <v-icon medium>fas fa-archway</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Modificar observación</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="prueba" >
                        <v-list-item-icon>
                            <v-icon medium>fas fa-archway</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Eliminar observación</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
            <v-menu open-on-hover offset-x left>
                <template v-slot:activator="{ on }">
                    <v-list-item  v-on="on" >
                        <v-list-item-icon>
                            <v-icon>fab fa-accusoft</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Cursos</v-list-item-title>
                    </v-list-item>
                </template>
                <v-list >
                    <v-list-item @click="prueba" >
                        <v-list-item-icon>
                            <v-icon medium>fab fa-accusoft</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Listar cursos</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
            <v-menu open-on-hover  offset-x left>
                <template v-slot:activator="{ on }">
                    <v-list-item  v-on="on" >
                        <v-list-item-icon>
                            <v-icon>fas fa-envelope</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Contactar</v-list-item-title>
                    </v-list-item>
                </template>
                <v-list >
                    <v-list-item @click="prueba" >
                        <v-list-item-icon>
                            <v-icon medium>fas fa-envelope</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Contactar Admin.</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="prueba" >
                        <v-list-item-icon>
                            <v-icon medium>fas fa-envelope</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Contactar Sria. Escuela</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-list>
        <template v-slot:append >
            <div >
                <v-btn block  @click="cerrarSesion">Cerrar sesión</v-btn>
            </div>
        </template>
    
    </v-navigation-drawer>
</template>

<script>
import {mapState} from 'vuex';

export default {
    name:'Navegacion',
    data() {
        return {
            drawer: true,
            on: '',
        }
    },
    computed: {
        ...mapState(['drawelAdmin']),
    },
    icons:{
        iconfont: (['mdiSvg', 'mdi','mdiSvg' , 'md' , 'fa' ,'fa4' ,'faSvg'])
    },
    methods: {
        cerrarSesion(){
            console.log('cerrar sesion')
        },
        verPerfil(){
            console.log('ver perfil')
        },
        prueba(){

        }
    },
}
</script>