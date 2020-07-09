require('./vue-assets');
Vue.component('create-operator', require('./components/operator/operator/CreateOperator.vue').default);
Vue.component('view-operator', require('./components/operator/operator/ViewOperator.vue').default);
// Operator Salary
Vue.component('create-operatorsalary', require('./components/operator/operator_salary/CreateOperatorsalary.vue').default);
Vue.component('view-operatorsalary', require('./components/operator/operator_salary/ViewOperatorsalary.vue').default);

var app = new Vue({

    el: '#content'
});