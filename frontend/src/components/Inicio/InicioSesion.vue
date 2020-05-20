<template>
  <div class="InicioSesion">
        <v-bottom-sheet v-model="sheet" inset  >  
            <template v-slot:activator="{ on }">
                <v-btn text rounded v-on="on" color="white" >
                    <h4 class="white--text">Inicio Sesión</h4>
                    <h4 class="primary--text">1</h4>
                    <v-icon large >mdi-account-circle</v-icon>
                </v-btn>
            </template>
            <v-sheet class="text-center" height="800px" color="white">
                <!--<v-footer
                    color="primary"
                    padless
                    absolute
                    width="70%"
                    class="text--center"
                >
                    <strong class="text--white">prueba</strong>
                </v-footer>-->
                <v-container fluid>
                    <v-row no-gutters>
                        <v-col class="d-none d-sm-none d-md-flex" md="6" >
                            <v-container>
                                <v-card
                                    width="100%"
                                    height="100%"
                                    outlined
                                    >
                                    <v-img
                                        width="100%"
                                        height="100%"
                                        src="@/assets/Inicio/acreditacion.png"
                                    >

                                    </v-img>
                                </v-card>
                            </v-container>
                            
                        </v-col>
                        <v-col class="d-none d-sm-none d-md-block " md="1">
                             <v-divider
                                :inset="inset"
                                vertical
                            ></v-divider>
                        </v-col>
                        <v-col  sm="12" md="5" lg="5">
                            <v-form>
                                <v-container>
                                    <h1 class="white--text">1</h1>
                                    <h3 class="primary--text mb-10 ">Iniciar Sesión en SGDA</h3>
                                </v-container>
                                <v-container class="px-10">
                                    <v-text-field v-model="lista.email"
                                        label="Correo"
                                        outlined
                                        prepend-inner-icon="mdi-account-circle"
                                    ></v-text-field>
                                    <v-text-field v-model="lista.pass"
                                        :prepend-inner-icon="mostrar ? 'mdi-eye' : 'mdi-eye-off'"
                                        :type="mostrar ? 'text' : 'password'"
                                        label="Contraseña"
                                        outlined
                                        @click:prepend-inner= "mostrar = !mostrar"
                                    ></v-text-field>
                                    <v-breadcrumbs class="px-0 py-0" :items="items"></v-breadcrumbs>
                                </v-container>
                                <v-container class="px-10">
                                    <v-btn rounded block color="primary" 
                                        :loading="verificandoLogin"
                                        @click="redireccionar"
                                        >
                                        <!--@click="cargar = 'verificandoLogin'"-->
                                        <h4 class="white--text">Iniciar Sesión</h4>
                                    </v-btn>
                                </v-container>
                            </v-form> 
                        </v-col>
                        
                    </v-row>
                
                </v-container>
            </v-sheet>
        </v-bottom-sheet>
  </div>
</template>

<script>
import {mapMutations} from 'vuex';
export default {
    name: 'InicioSesion',

    data () {
        
      return {
        sheet: false,
        mostrar: false,
        cargar: null,
        verificandoLogin: false,
        items: [
            {
            text: '¿Olvidaste tu contraseña?',
            disabled: false,
            href: 'por ver',
            },
        ],
        lista: [{email:''},{pass:''}], 
      }
    },
    methods:{
        ...mapMutations(['login']),
        redireccionar(){
            this.$router.push({path: '/prueba'});
        },
    },

    watch: {
      cargar () {
        //login(lista)
        const l = this.cargar
        this[l] = !this[l]
        setTimeout(() => (this[l] = false), 3000)
        this.cargar = null
      },
    },
}
</script>

