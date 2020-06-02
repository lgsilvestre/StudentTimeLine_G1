<template>
    <div class="BodyRegistroUsuarios">
        <v-container fluid>
            <!-- <v-row no-gutters justify="center" align="center" style="display: flex;height:80vh; " >
                <v-col class="d-none d-sm-none d-md-block " md="1">
                </v-col>
                <v-col class="d-none d-sm-flex " sm="12" md ="4" lg="4">
                    <v-container class="text-center">
                        <v-row justify="center">
                            <v-img  
                            src="@/assets/Administrador/registrarUsuario.png"                         
                        ></v-img>                    
                        <h2 class="primary--text pt-5">Registrar Nuevo Usuario</h2>
        
                        </v-row>
                    </v-container>
                </v-col>

                <v-col class="d-block" sm="12" md ="8" lg="6" >
                    <v-card
                        raised
                        min-width="400"
                    >
                        <v-card-text class="px-12" >
                            <v-form>
                                <v-text-field
                                    class="mx-12"
                                    v-model="datosUsuario.nombre"
                                    label="Nombre de Usuario"
                                    :rules="[() => !!datosUsuario.nombre ||'Requerido']"
                                    outlined
                                    prepend-inner-icon="mdi-account"
                                ></v-text-field>
                                <v-select
                                    class="mx-12"
                                    v-model="datosUsuario.escuela"
                                    label="Escuela"
                                    :items="items"
                                    :rules="[() => !!datosUsuario.escuela ||'Requerido']"
                                    outlined
                                    prepend-inner-icon="mdi-school"
                                >                                
                                </v-select>
                                <v-select
                                    class="mx-12"
                                    v-model="datosUsuario.rol"
                                    label="Rol"
                                    :items="roles"
                                    :rules="[() => !!datosUsuario.rol ||'Requerido']"
                                    outlined
                                    prepend-inner-icon="mdi-account-tie"
                                >                                
                                </v-select>
                                <v-text-field
                                    class="mx-12"
                                    v-model="datosUsuario.correo"
                                    label="Correo Electronico"
                                    :rules="[() => !!datosUsuario.correo ||'Requerido']"
                                    outlined
                                    prepend-inner-icon="mdi-email"
                                >
                                </v-text-field>
                                <v-text-field
                                    class="mx-12"
                                    v-model="datosUsuario.contrasena"
                                    :prepend-inner-icon= "mostrar ? 'mdi-eye' : 'mdi-eye-off'"
                                    :type="mostrar ? 'text' : 'password'"
                                    :rules="reglas"
                                    label="Contraseña"
                                    outlined
                                    hint="Al menos 8 caracteres"
                                    @click:prepend-inner="mostrar = !mostrar"                              
                                >
                                </v-text-field>
                                <v-file-input
                                    class="mx-12"
                                    chips
                                    solo
                                    label="Fotografia del Usuario"
                                    placeholder="Seleccionar Imagen"
                                    outlined                                
                                    prepend-inner-icon="mdi-camera"
                                    prepend-icon=""
                                ></v-file-input>   

                                <v-btn                                 
                                    rounded 
                                    block 
                                    color="primary " 
                                    @click="registrarUsuario(datosUsuario)"
                                > Registrar
                                </v-btn>   
                            </v-form>
                        </v-card-text>
                    </v-card>
                </v-col>

                <v-col class="d-none d-sm-none d-md-block " md="1">
                </v-col>
            </v-row> -->
            <v-card
                class="mx-auto"
                max-width="800"
            >
                <v-img
                    class="mx-auto white--text align-end justify-center"
                    height="200px"
                    src="@/assets/Globales/background-panel-02.jpg"
                    >
                    <v-card-title> 
                        <v-icon class="mx-2" color="white">fas fa-plus-circle</v-icon>
                        Registrar Nuevo Usuario
                    </v-card-title>
                    
                </v-img>

                <v-card-text class="px-12 my-3" >
                    <v-form 
                    ref="form"
                    >
                        <v-text-field
                            class="mx-2"
                            v-model="datosUsuario.nombre"
                            label="Nombre de Usuario"
                            :rules="[() => !!datosUsuario.nombre ||'Requerido']"
                            outlined
                            prepend-inner-icon="mdi-account"
                        ></v-text-field>
                        <v-select
                            class="mx-2"
                            v-model="datosUsuario.escuela"
                            label="Escuela"
                            :items="items"
                            :rules="[() => !!datosUsuario.escuela ||'Requerido']"
                            outlined
                            prepend-inner-icon="mdi-school"
                        >                                
                        </v-select>
                        <v-select
                            class="mx-2"
                            v-model="datosUsuario.rol"
                            label="Rol"
                            :items="roles"
                            :rules="[() => !!datosUsuario.rol ||'Requerido']"
                            outlined
                            prepend-inner-icon="mdi-account-tie"
                        >                                
                        </v-select>
                        <v-text-field
                            class="mx-2"
                            v-model="datosUsuario.correo"
                            label="Correo Electronico"
                            :rules="reglasEmail"
                            outlined
                            prepend-inner-icon="mdi-email"
                        >
                        </v-text-field>
                        <v-text-field
                            class="mx-2"
                            v-model="datosUsuario.contrasena"
                            :prepend-inner-icon= "mostrar ? 'mdi-eye' : 'mdi-eye-off'"
                            :type="mostrar ? 'text' : 'password'"
                            :rules="reglas"
                            label="Contraseña"
                            outlined
                            hint="Al menos 8 caracteres"
                            @click:prepend-inner="mostrar = !mostrar"                              
                        >
                        </v-text-field>
                        <v-file-input
                            class="mx-2"
                            chips
                            solo
                            label="Fotografia del Usuario"
                            placeholder="Seleccionar Imagen"
                            outlined                                
                            prepend-inner-icon="mdi-camera"
                            prepend-icon=""
                        ></v-file-input>   

                        <v-btn                                 
                            rounded 
                            block 
                            color="primary " 
                            @click="validate"
                        > Registrar
                        </v-btn>   
                    </v-form>
                </v-card-text>
            </v-card>
        </v-container>
    </div>    
</template>

<script>
import {mapMutations} from 'vuex';
export default {
    name: "RegistroUsuarios",
    data () {
        return {
            datosUsuario:[ {nombre:''},{escuela:''},{rol:''},{correo:''},{contrasena:''} ,{imagen:''}],
            mostrar: false,     
            items: ['Ingenieria Civil en Computación', 'Ingenieria Civil Industrial','Ingenieria Civil en Minas', 'Ingenieria Civil en Obras Civiles', 'Ingenieria Civil Mecánica','Ingenieria Civil Mecatrónica', 'Ingenieria Civil Eléctrica' ],
            roles: ['Administrador', 'Secretaría de Escuela', 'Profesor'],   
            reglas:[
                value => !!value || 'Requerido.',
                value => (value && value.length >= 8) || 'Minimo 8 characters',
            ],
            reglasEmail: [
                v => !!v || 'E-mail is required',
                v => /.+@utalca.cl/.test(v) || 'E-mail must be valid',
            ],
        }
    },
    methods:{
        validate () {
            this.$refs.form.validate()
        },
        ...mapMutations(['registrarUsuario']),
    },
}
</script>