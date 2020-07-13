require('./vue-assets');
import { MonthPicker } from 'vue-month-picker'
import { MonthPickerInput } from 'vue-month-picker'
Vue.use(MonthPicker)
Vue.use(MonthPickerInput)
Vue.component('create-equipmentexpenseheads', require('./components/expense_heads/equipment/CreateEquipmentExpenseHead.vue').default);
Vue.component('view-equipmentexpenseheads', require('./components/expense_heads/equipment/ViewEquipmentExpenseHead.vue').default);

Vue.component('create-projectexpenseheads', require('./components/expense_heads/project/CreateProjectExpenseHead.vue').default);
Vue.component('view-projectexpenseheads', require('./components/expense_heads/project/ViewProjectExpenseHead.vue').default);

Vue.component('create-officeexpenseheads', require('./components/expense_heads/office_expense/CreateOfficeExpenseHead.vue').default);
Vue.component('view-officeexpenseheads', require('./components/expense_heads/office_expense/ViewOfficeExpenseHead.vue').default);

Vue.component('create-projectexpense', require('./components/expense/project/CreateProjectExpense.vue').default);
Vue.component('view-projectexpense', require('./components/expense/project/ViewProjectExpense.vue').default);

Vue.component('create-equipmentexpense', require('./components/expense/equipment/CreateEquipmentExpense.vue').default);
Vue.component('view-equipmentexpense', require('./components/expense/equipment/ViewEquipmentExpense.vue').default);

Vue.component('create-officeexpense', require('./components/expense/office/CreateOfficeExpense.vue').default);
Vue.component('view-officeexpense', require('./components/expense/office/ViewOfficeExpense.vue').default);

var app = new Vue({

    el: '#content'
});