<template>
    <v-container>
        <v-row >
            <v-col cols="12" md="1">
            </v-col>
            <v-col cols="12" md="10">
                <v-card>
                    <v-img
                    class="mx-auto white--text align-end justify-center"
                    width="100%"
                    height="180px"
                    src="@/assets/Globales/fondo3.jpg"
                    >
                    <v-card-title class="white--text" style="padding:0;" > 
                        <v-row class="px-5"> 
                            <v-col cols="12" class="pt-1">
                                <strong :style=" $vuetify.breakpoint.smAndDown ? 'font-size: 140%;' : 'font-size: 180%;'" style="text-shadow: #000000 3px 3px 4px;" >Mis observaciones</strong>
                            </v-col>
                            <v-col cols="7" sm="9" md="9" class="align-self-end" >
                                <v-text-field
                                    v-model="buscar"
                                    append-icon="mdi-magnify"
                                    label="Buscar"
                                    hide-details
                                    outlined
                                    clearable
                                    dense
                                    solo
                                    rounded
                                    color="secondary"
                                    background-color="white"
                                ></v-text-field>
                            </v-col>
                            <v-col  cols="5" sm="3" md="3" class="align-self-end" style="text-align:right;">
                                <v-tooltip bottom color="primary">
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                    class="ml-2"
                                    fab
                                    :small="$vuetify.breakpoint.smAndDown ? true : false"
                                    bottom
                                    left
                                    v-on="on"
                                    >
                                        <v-icon  color="secondary">fas fa-envelope</v-icon>
                                    </v-btn>
                                </template>
                                <span><strong>Contactar</strong></span>
                                </v-tooltip>
                            </v-col>
                        </v-row>
                    </v-card-title>
                    </v-img>
                <!--<v-data-table
                :headers="headers"
                :items="listaEstudiantes"
                :search="buscar"
                :loading="cargando"
                style="font-size: 140%;"
                class="elevation-1 "
                >
                    <template v-slot:item.actions="{ item }">
                        <v-tooltip bottom color="primary">
                            <template v-slot:activator="{ on }">
                                <v-btn color="white" fab small depressed class="mr-2 py-2" v-on="on" @click="perfilEstudiante(item)">
                                    <v-icon  
                                    color="primary"
                                    >
                                    fas fa-external-link-alt
                                    </v-icon>
                                </v-btn>
                            </template>
                            <span><strong>Ver Perfil</strong></span>
                        </v-tooltip>
                    </template>                                                         
                </v-data-table>!-->
                </v-card>
            </v-col>
            <v-col cols="12" md="1">
            </v-col>          
        </v-row>
        <v-snackbar
        v-model="alertError"
        :timeout=delay
        bottom
        color="warning"
        left
        class="mb-1 pb-12 pr-0 mr-0"
        >
        <div>
            <v-icon color="white" class="mr-2">
            fas fa-exclamation-triangle
            </v-icon>
            <strong>{{textoError}} </strong>
        </div>
        <v-btn
            color="white"
            elevation="0"
            x-small
            fab
            @click="alertError = ! alertError"
        > 
            <v-icon color="warning">fas fa-times</v-icon>
        </v-btn>
        </v-snackbar>
        <v-snackbar
        v-model="alertAcept"
        :timeout=delay
        bottom
        color="secondary"
        left
        class="mb-1 pb-12 pr-0 mr-0"
        >
        <div>
            <v-icon color="white" class="mr-2">
            fas fa-check-circle
            </v-icon>
            <strong>{{textoAcept}}</strong>
        </div>
        <v-btn
            color="white"
            elevation="0"
            x-small
            fab
            @click="alertAcept = ! alertAcept"
        > 
            <v-icon color="secondary">fas fa-times</v-icon>
        </v-btn>
        </v-snackbar>
    </v-container>

</template>

<script>
    import axios from 'axios'
    export default {
        data:{
            buscar: '',
            alertError: false,
            textoError: '',
            alertAcept: false,
            textoAcept: '',
            delay: 4000,
        },

    }
</script>

<style>

</style>