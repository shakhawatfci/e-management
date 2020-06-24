require('./vue-assets');
Vue.component('create-equipmentexpenseheads', require('./components/expense_heads/equipment/CreateEquipmentExpenseHead.vue').default);
Vue.component('view-equipmentexpenseheads', require('./components/expense_heads/equipment/ViewEquipmentExpenseHead.vue').default);

Vue.component('create-projectexpenseheads', require('./components/expense_heads/project/CreateProjectExpenseHead.vue').default);
Vue.component('view-projectexpenseheads', require('./components/expense_heads/project/ViewProjectExpenseHead.vue').default);

Vue.component('create-officeexpenseheads', require('./components/expense_heads/office_expense/CreateOfficeExpenseHead.vue').default);
Vue.component('view-officeexpenseheads', require('./components/expense_heads/office_expense/ViewOfficeExpenseHead.vue').default);

var app = new Vue({

    el: '#content'
});