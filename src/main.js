import Vue from 'vue'
import Menu from './Menu.vue'

new Vue({
  el: '#app',
  components: {
  	"app-menu": Menu
  }
  //render: h => h(Menu),

});
