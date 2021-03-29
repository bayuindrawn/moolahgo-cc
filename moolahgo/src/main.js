import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify';

Vue.config.productionTip = false

new Vue({
  vuetify,
  render: h => h(App),
  mounted() {
    let apiURL = "";
    if (process.env.NODE_ENV === "development") {
      apiURL = process.env.VUE_APP_LUMEN_DEV;
    } else if (process.env.NODE_ENV === "production") {
      apiURL = process.env.VUE_APP_LUMEN_PROD;
    }
    console.log("MODE : " + apiURL);
    localStorage.setItem("apiURL", apiURL);
  }
}).$mount('#app')
