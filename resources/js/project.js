require('./vue-assets');
Vue.component('create-project', require('./components/project/CreateProject.vue').default);
Vue.component('view-project', require('./components/project/ViewProject.vue').default);


var app = new Vue({

    el: '#content'
});