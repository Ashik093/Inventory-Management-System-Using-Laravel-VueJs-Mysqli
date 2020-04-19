

require('./bootstrap');



import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//route
import {routes} from './routes'



//user class import
import User from './Helpers/User'
window.User = User

//sweetalert
import Swal from 'sweetalert2'
window.Swal = Swal

window.Reload = new Vue()

//notification
import Notification from "./Helpers/Notification"
window.Notification = Notification

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.Toast = Toast

const router = new VueRouter({
	routes,
	mode:'history'
})

const app = new Vue({
    el: '#app',
    router,
});
