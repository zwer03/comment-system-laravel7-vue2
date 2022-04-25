/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 import './bootstrap';
 import router from './routes';
 import vuetify from './vuetify';
 import Application from './Application';
 /* Services */
 import {
     errorService
 } from './services/error.service';
 
 new Vue({
     el: '#app',
     router,
     vuetify,
     components: {
         Application
     },
     created() {
         axios.interceptors.response.use(
             response => response,
 
             error => {
                 alert(errorService.handleError(error))
                 return Promise.reject(error)
             }
         )
 
     },
 
     template: '<Application/>'
 });
