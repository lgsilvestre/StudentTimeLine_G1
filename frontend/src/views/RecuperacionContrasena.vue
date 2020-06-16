<template>
    <div class="RecuperacionContrasena">
        <AppBarRC/>
        <BodyRC/>
        <FooterGlobal/>
    </div>
</template>

<script>
import AppBarRC from '@/components/RecuperarContrasena/AppBarRC.vue';
import BodyRC from '@/components/RecuperarContrasena/BodyRC.vue';
import FooterGlobal from '@/components/Globales/FooterGlobal.vue';
export default {
    name:'RecuperacionContrasena',
    components: {
        AppBarRC,
        BodyRC,
        FooterGlobal,
    },
}
</script>
