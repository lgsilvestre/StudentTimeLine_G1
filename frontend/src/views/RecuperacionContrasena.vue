<template>
    <div class="RecuperacionContrasena">

        <AppBarRC/>
        <BodyRC/>
        <FooterGeneral/>
    </div>
</template>

<script>
import AppBarRC from '@/components/RecuperarContrasena/AppBarRC.vue';
import BodyRC from '@/components/RecuperarContrasena/BodyRC.vue';
import FooterGeneral from '@/components/Globales/FooterGeneral.vue';
export default {
    name:'RecuperacionContrasena',
    components: {
        AppBarRC,
        BodyRC,
        FooterGeneral,
    },
}
</script>
