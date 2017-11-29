import Vue from 'vue'
import Menu from './Menu.vue'

import VueEcho from 'vue-echo';
  
Vue.use(VueEcho, {
    broadcaster: 'pusher',
    key: '47588a2db3baf0214bef',
    cluster: 'eu'
});

new Vue({
  components: {
  	//"app-menu": Menu
  },
  el: '#vue-app',
  data(){
  	return {
	  	
	  }
  },
  render: h => h(Menu),
  mounted(){
  	/*this.$echo.channel('ch1').listen('ev1', (payload) => {
      console.log("PUSHER ECHO::::: "+payload.message);
    });*/
  }

});
