<template>
    <div class="AppBar">
        <v-app-bar 
        color="primary"
        elevate-on-scroll 
        >
        <div class="d-flex align-center">
        <v-img 
            class="shrink mr-2 d-none d-sm-flex"
            src="@/assets/Inicio/utalca.png"
            width="300"
        />
        <v-img 
            class="shrink mr-2 d-flex d-sm-none"
            src="@/assets/Inicio/utalca2.png"
            width="45"
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

}