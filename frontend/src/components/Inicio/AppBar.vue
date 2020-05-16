<template>
    <div class="AppBar">
        <v-app-bar 
        color="primary"

        elevate-on-scroll 
        :collapse=false
        >
        <div class="d-flex align-center">
        <v-img 
            class="shrink mr-2"
            src="@/assets/Inicio/utalca.png"
           
            width="300"
        />
        </div>
        <v-spacer></v-spacer>
        <v-btn text rounded color="white" >
            <h4 class="white--text">Inicio Sesión</h4>
            <h4 class="primary--text">1</h4>
            <v-icon large >mdi-account-circle</v-icon>
            
        </v-btn>
        </v-app-bar>
        
    </div>
</template>

<script>
export default {
    name: 'AppBar',
    methods:{
        
    },
    computed:{

    },

}