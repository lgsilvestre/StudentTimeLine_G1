<template>
    <div class="Inicio">
        <AppBar/>
        <Cuerpo/>
        <FooterInicio/>
    </div>
  
</template>

<script>
import AppBar from '@/components/Inicio/AppBar.vue';
import Cuerpo from '@/components/Inicio/Cuerpo.vue';
import FooterInicio from '@/components/Inicio/FooterInicio.vue';



export default {
    name: 'Inicio',
    components: {
        AppBar,
        Cuerpo,
        FooterInicio,
    },
}
</script>

