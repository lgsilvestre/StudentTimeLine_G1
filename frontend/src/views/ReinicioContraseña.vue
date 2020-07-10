<template>
    <div class="reinicioContrasena">
        <AppBar/>
        <Cuerpo/>
        <FooterInicio/>
    </div>
</template>

<script>
import AppBar from '@/components/RecuperarContrasena/AppBarRC.vue';
import Cuerpo from '@/components/RecuperarContrasena/BodyReinicioC.vue';
import FooterInicio from '@/components/Inicio/FooterInicio.vue';
import axios from 'axios';
export default {
    name: 'reinicioContrasena',
    components: {
        AppBar,
        Cuerpo,
        FooterInicio,
    },
}
</script>
