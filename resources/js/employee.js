require('./vue-assets');

Vue.component('create-employee', require('./components/employee/CreateEmployee.vue').default);
Vue.component('view-employee', require('./components/employee/ViewEmployee.vue').default);
Vue.component('create-employee-salary', require('./components/expense/employee-salary/CreateSalary.vue').default);
Vue.component('view-employee-salary', require('./components/expense/employee-salary/ViewSalary.vue').default);



var app = new Vue({
    el: '#content'
});