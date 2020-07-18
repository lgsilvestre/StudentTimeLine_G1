<template>
<v-navigation-drawer app right v-model="drawers.drawer" :mini-variant="drawers.miniVarianteAdm"  :permanent="$vuetify.breakpoint.mdAndUp" :temporary="$vuetify.breakpoint.smAndDown"
    src="@/assets/Globales/background-panel-02.jpg"
>
        <v-list-item class="px-2 py-1 difuminado" active-class="activacion" to="/profesor/perfil">
            <v-list-item-avatar >
                <v-img :src="usuario.usuario.foto"
                ></v-img>
            </v-list-item-avatar>
            <v-list-item-title class="white--text letra"><strong>Profesor</strong></v-list-item-title>
        </v-list-item>
        <v-divider></v-divider>
        <v-list > 
            <v-menu open-on-hover offset-x left>
                <template v-slot:activator="{ on }">
                    <v-list-item  v-on="on" class="difuminado" active-class="activacion" to="/profesor/estudiantes"> 
                        <v-list-item-icon>
                            <v-icon color="white">fas fa-user-graduate</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title class="white--text letra"><strong>Estudiantes</strong></v-list-item-title>
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
                    <v-list-item  v-on="on" class="difuminado" active-class="activacion">
                        <v-list-item-icon>
                            <v-icon color="white" >fas fa-archway</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title class="white--text letra"><strong>Observaciones</strong></v-list-item-title>
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
                    <v-list-item  v-on="on" class="difuminado" active-class="activacion">
                        <v-list-item-icon>
                            <v-icon color="white">fab fa-accusoft</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title class="white--text letra"><strong>Cursos</strong></v-list-item-title>
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
                    <v-list-item  v-on="on" class="difuminado" active-class="activacion">
                        <v-list-item-icon>
                            <v-icon color="white">fas fa-envelope</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title class="white--text letra"><strong>Contactar</strong></v-list-item-title>
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
        <v-list-item class=" difuminado" style="background-color: #FF6B6B" @click="unLogin">
            <v-list-item-icon >
                <v-icon color="white" style="font-size: 125%">fas fa-power-off</v-icon>
            </v-list-item-icon>
            <v-list-item-title class="white--text letra" ><strong>Cerrar sesion</strong></v-list-item-title>
        </v-list-item>
        </template>
    
    </v-navigation-drawer>
</template>

<script>
import {mapState, mapMutations} from 'vuex';

export default {
    name:'Navegacion',
    data() {
        return {
            drawer: true,
            on: '',
        }
    },
    computed: {
        ...mapState(['drawers', 'usuario']),
    },
    icons:{
        iconfont: (['mdiSvg', 'mdi','mdiSvg' , 'md' , 'fa' ,'fa4' ,'faSvg'])
    },
    methods: {
        ...mapMutations(['unLogin']),
        cerrarSesion(){
            console.log('cerrar sesion')
        },
        verPerfil(){
            console.log('ver perfil')
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
    .activacion {
        color:#fff;
        background-color: rgba(0,0,0,0.6);
    }
</style>