<template>
    <div class="AppBarRC">
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
        <v-btn
        color="primary"
        elevation="0"
        rounded
        @click="funcion"
        > 
            Volver <i class="fas fa-undo-alt pl-2"></i>
        </v-btn>
        </v-app-bar>
         
        
    </div>
</template>

<script>

export default {
    name: 'AppBarRC',

    components: {
       
    },
    
    methods:{
        
    },
    computed:{

    },

}