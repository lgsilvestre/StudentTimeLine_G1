<template>
    <v-container  fluid >
        <v-row   class="align-center justify-center" >
                <v-col cols="2" >
                </v-col>
                <v-col  cols="3" >
                   <v-card elevation="1" shaped> 
                        <v-card-title
                        class="headline primary text--center"
                        primary-title>
                            <h5 class="white--text ">Perfil de usuario</h5>
                        </v-card-title>
                        <v-container fluid class="px-10 text-center">
                            <v-avatar size="100">
                                <img
                                    src="https://randomuser.me/api/portraits/men/85.jpg"
                                >
                            </v-avatar>
                        </v-container >
                        <v-divider></v-divider>
                        <v-container fluid class="px-5 text-left">
                            <p class="font-weight-black">Nombre:</p>
                            <p class="font-weight-black">Cargo:</p>
                            <p class="font-weight-black">Carrera:</p>
                            <p class="font-weight-black">Correo:</p>
                            
                        </v-container>

                    </v-card>

                </v-col>
                <v-col cols="1"></v-col>
                <v-col cols="4" >
                    <v-card elevation="1" shaped>
                        <v-card-title
                            class="headline primary text--center"
                            primary-title
                            >
                            <h5 class="white--text ">Editar perfil</h5>
                            </v-card-title>
                            <v-form>
                                <v-container class="px-10 pt-10">
                                    <v-text-field 
                                        label="Nombre"
                                        outlined
                                        color="secondary"
                                        prepend-inner-icon="mdi-account-circle"
                                    ></v-text-field>
                                    <v-text-field 
                                        label="Correo"
                                        outlined
                                        color="secondary"
                                        prepend-inner-icon="mdi-email"
                                    ></v-text-field>
                                    <v-text-field 
                                        :prepend-inner-icon="mostrar ? 'mdi-eye' : 'mdi-eye-off'"
                                        :type="mostrar ? 'text' : 'password'"
                                        label="Contraseña"
                                        color="secondary"
                                        outlined
                                        @click:prepend-inner= "mostrar = !mostrar"
                                    ></v-text-field>

                                      <v-file-input 
                                      accept="image/png, image/jpeg, image/bmp" 
                                      label="Seleccione una imagen"
                                      color="secondary"
                                    outlined
                                    prepend-icon=""
                                        
                                    prepend-inner-icon="mdi-camera"></v-file-input>

                                    
                                </v-container>
                                <v-container class="px-10">
                                    <v-btn rounded large block color="primary" 
                                        :loading="verificandoLogin"
                                        >
                                        <h4 class="white--text">Modificar Perfil</h4>
                                    </v-btn>
                                </v-container>
                            </v-form> 
                        
                            
                    </v-card>

                </v-col>
                <v-col cols="2">
                </v-col>
            </v-row>
      </v-container>  
</template>

<script>
export default {
    data: () => ({
        nombre:'',
        email:'',
        contraseña:'',
        mostrar: false,

      
    }),
}
</script>