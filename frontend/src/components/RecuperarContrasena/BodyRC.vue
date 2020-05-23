<template>
    <div class="BodyRC " >        
        
        <v-container fluid >
            <v-row >
                <v-col cols="12">
                    <v-row align="center" justify="center" style="display: flex;flex-direction: column;height:75vh; ">
                        <v-container >
                             <v-row
                                class="mb-6"
                                justify="center"
                                no-gutters
                                >
                                <v-col lg="3" >
                                    <h3 class="primary--text pt-10 ">Recuperar su contraseña en SGDA</h3>
                                    <v-text-field 
                                    class="pt-5 "
                             
                                        label="Correo"
                                        outlined
                                        prepend-inner-icon="mdi-account-circle"
                                    ></v-text-field>
                                    <v-btn rounded block color="primary px-10" >
                                    Recuperar contraseña
                                    </v-btn>
                                </v-col>
                                
                            </v-row>
                            
                        </v-container>
                        <!--<h3 class="primary--text pt-10">Iniciar Sesión en SGDA</h3>
                        <v-text-field 
                            label="Correo"
                            outlined
                            prepend-inner-icon="mdi-account-circle" class="py-10"
                        ></v-text-field>-->

                        
                            
                        
                    </v-row>
                    
                </v-col>
            </v-row>

        </v-container>
        
    </div>
</template>

<script>
export default {
    name: 'BodyRC',

    methods:{
        
    },
    computed:{

    },

}
</script>