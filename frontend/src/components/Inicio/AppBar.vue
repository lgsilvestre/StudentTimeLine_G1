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
        <inicioSesion/>
        </v-app-bar>
         
        
    </div>
</template>

<script>

export default {
    name: 'AppBar',

    components: {
       

    },
    data: () => ({
      sheet: false,
    }),
    methods:{
        
    },
    computed:{

    },

}