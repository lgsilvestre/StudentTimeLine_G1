import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import es from 'vuetify/es5/locale/es';
import '@fortawesome/fontawesome-free/css/all.css'

Vue.use(Vuetify);

export default new Vuetify({
  theme: {
      options: {
        customProperties: true,
      },
    themes: {
      light: {
        primary: '#001f54',
        secondary: '#034078',
        fondo: '#ffffff',
        accent: '#1282a2',
        error: '#E63946',
        info: '#1e1b18',
        success: '#4CAF50',
        warning: '#E63946',
      },
    },
  },
    lang: {
      locales: { es },
      current: 'es',
    },
    icons: {
      iconfont: 'fa',
    },
});
