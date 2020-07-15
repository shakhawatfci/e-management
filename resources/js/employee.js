require('./vue-assets');

Vue.component('create-employee', require('./components/employee/CreateEmployee.vue').default);
Vue.component('view-employee', require('./components/employee/ViewEmployee.vue').default);



var app = new Vue({
    el: '#content'
});