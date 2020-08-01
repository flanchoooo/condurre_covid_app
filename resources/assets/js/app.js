require('./bootstrap');
window.Vue = require('vue');
import Chartkick from 'vue-chartkick'
import Chart from 'chart.js'

Vue.use(Chartkick.use(Chart))



Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('add-question', require('./components/AddQuestionComponent.vue'));
Vue.component('temp', require('./components/AverageTemperatureComponent.vue'));

const app = new Vue({
    el: '#app'
});
