require('./vue-assets');
Vue.component('create-project', require('./components/project/CreateProject.vue').default);
Vue.component('view-project', require('./components/project/ViewProject.vue').default);
Vue.component('assign-equipment', require('./components/project/assign-equipment/AssignEquipment.vue').default);
Vue.component('view-assigned-equipment', require('./components/project/assign-equipment/ViewAssignedEquipment.vue').default);


var app = new Vue({

    el: '#content'
});