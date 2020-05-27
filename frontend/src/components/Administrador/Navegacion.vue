<template>
<v-navigation-drawer app right v-model=drawer  :mini-variant.sync=drawelAdmin permanentt  >
        <v-list-item class="px-2 py-1" @click="verPerfil">
            <v-list-item-avatar >
                <v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
            </v-list-item-avatar>

        <v-list-item-title>John Leider</v-list-item-title>

        </v-list-item>

        <v-divider></v-divider>


    <v-list style=" margine-right: 0; margine-left:0;"  > 
        <v-menu open-on-hover  offset-x left>
            <template v-slot:activator="{ on }">
                <v-list-item  v-on="on" >
                    <v-list-item-icon>
                        <v-icon>fas fa-school</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Escuela</v-list-item-title>
                </v-list-item>
            </template>
            <v-list>
                <v-list-item v-for="(item, index) in itemsEscuela" :key="index"  @click="CrearEscuela">
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>

        <v-menu open-on-hover offset-x left>
            <template v-slot:activator="{ on }">
                <v-list-item  v-on="on" >
                    <v-list-item-icon>
                        <v-icon>fas fa-users</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Usuario</v-list-item-title>
                </v-list-item>
            </template>
            <v-list>
                <v-list-item v-for="(item, index) in itemsUsuario" :key="index" @click="CrearEscuela">
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>

        <v-menu open-on-hover offset-x left>
            <template v-slot:activator="{ on }">
                <v-list-item  v-on="on" >
                    <v-list-item-icon>
                        <v-icon>fab fa-accusoft</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Curso</v-list-item-title>
                </v-list-item>
            </template>
            <v-list>
                <v-list-item v-for="(item, index) in itemsCurso" :key="index" @click="CrearEscuela" >
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>

        <v-menu open-on-hover offset-x left>
            <template v-slot:activator="{ on }">
                <v-list-item  v-on="on" >
                    <v-list-item-icon>
                        <v-icon>fas fa-chalkboard-teacher</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Profesor</v-list-item-title>
                </v-list-item>
            </template>
            <v-list>
                <v-list-item v-for="(item, index) in itemsProfesor" :key="index" @click="CrearEscuela">
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>

        <v-menu open-on-hover offset-x left>
            <template v-slot:activator="{ on }">
                <v-list-item  v-on="on" >
                    <v-list-item-icon>
                        <v-icon>fas fa-user-graduate</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Estudiante</v-list-item-title>
                </v-list-item>
            </template>
            <v-list>
                <v-list-item v-for="(item, index) in itemsEstudiantes" :key="index" @click="CrearEscuela" >
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>

        <v-menu open-on-hover  offset-x left>
            <template v-slot:activator="{ on }">
                <v-list-item  v-on="on" >
                    <v-list-item-icon>
                        <v-icon>fas fa-archway</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Observaciones</v-list-item-title>
                </v-list-item>
            </template>
            <v-list>
                <v-list-item v-for="(item, index) in itemsObservaciones" :key="index" @click="CrearEscuela">
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
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
            <v-list>
                <v-list-item v-for="(item, index) in itemsContactar" :key="index" @click="CrearEscuela" >
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
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
            itemsUsuario: [
          { title: 'Crear usuario', icon: 'fas fa-asterisk' },
          { title: 'Listar Usuario', icon: 'fas fa-asterisk' },
          { title: 'Modificar usuario', icon: 'fas fa-asterisk' },
          { title: 'Eliminar usuario', icon: 'fas fa-asterisk' }

        ],
        itemsEscuela:[
            {title:'Crear escuela', icon:'fas fa-asterisk'},
            {title:'Listar escuela', icon:'fas fa-asterisk'},
           { title:'habilitar escuela', icon:'fas fa-asterisk'},
            {title:'Deshabilitar escuela', icon:'fas fa-asterisk'}
            ],
        itemsCurso: [
            {title:'Crear curso', icon:'fas fa-asterisk'},
            {title:'Listar curso', icon:'fas fa-asterisk'},
            {title:'Modificar curso', icon:'fas fa-asterisk'},
            {title:'Eliminar curso', icon:'fas fa-asterisk'},
        ],
        itemsProfesor:[
            {title:'Vincular profesor', icon:'fas fa-asterisk'},
            {title:'Desvincular profesor', icon:'fas fa-asterisk'},
        ],
        itemsEstudiantes:[
            {title:'Listar estudiante', icon:'fas fa-asterisk'},
            
        ],
        itemsObservaciones: [
            {title:'Crear observación', icon:'fas fa-asterisk'},
            {title:'Listar observación', icon:'fas fa-asterisk'},
            {title:'Modificar observación', icon:'fas fa-asterisk'},
            {title:'Eliminar observación', icon:'fas fa-asterisk'},
        ],
        itemsContactar:[
            {title:'Contactar administrador', icon:'fas fa-asterisk'},
            {title:'contactar secretaria de escuela', icon:'fas fa-asterisk'},
        ],



        
        }
    },
    computed: {
        ...mapState(['drawelAdmin']),
        // drawelAdmin:{
        //     get(){
        //         return this.$store.state.drawelAdmin
        //     },
        //     set(){
        //         this.$store.commit('setDrawelAdmin')
        //     }
        // }
       
    },
    icons:{
        iconfont: (['mdiSvg', 'mdi','mdiSvg' , 'md' , 'fa' ,'fa4' ,'faSvg'])
    },
    methods: {
        CrearEscuela(){
            console.log('crear Escuela')
        },
        cerrarSesion(){
            console.log('cerrar sesion')
        },
        verPerfil(){

        }
    },
}
</script>