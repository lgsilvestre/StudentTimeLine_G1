<template>
    <div class="Inicio">
        <AppBar/>
        <Cuerpo/>
    </div>
  
</template>

<script>
import AppBar from '@/components/Inicio/AppBar.vue';
import Cuerpo from '@/components/Inicio/Cuerpo.vue';

export default {
    name: 'Inicio',
    components: {
        AppBar,
        Cuerpo,
    },
}
</script>

