require('./bootstrap');
import router from './routes';

window.Vue = require('vue').default;

//Import Moment for DateTime functions
import moment from 'moment';

//Import Progress Bar
import VueProgressBar from 'vue-progressbar';
Vue.use(VueProgressBar, {
    color: 'rgb(255, 255, 19)',
    failedColor: 'red',
    height: '5px',
    });

//Import Sweet Alert
import Swal from 'sweetalert2'
window.Swal = Swal;

const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

window.toast = toast;

//Import VueRouter for SPA Routing
import VueRouter from 'vue-router';
Vue.use(VueRouter);

//Import Simple Pagination
Vue.component('pagination', require('laravel-vue-pagination'));

//Import Vform for forms and Errors
import {Form, HasError, AlertError} from 'vform';
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
window.Form = Form;

//Import Cart and ChartKick for Charts
import Chart from 'chart.js';
import Chartkick from 'vue-chartkick'
Vue.use(Chartkick.use(Chart));

//Import Emit for all components
window.Fire = new Vue();

//Special Created Filters
Vue.filter('currency', function(value) {
    let val = (value/1).toFixed(2).replace(',', '.')
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
});

Vue.filter('ExcelDate', function(text){
    return moment(text).format('MMMM Do, YYYY');
});

Vue.filter('firstUp', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1).toLowerCase(); 
});
const app = new Vue({
    el: '#corner',
    router,
    data:{ search: '',},
    methods:{
        searchIt: _.debounce(()=>{Fire.$emit('searchInstance');}, 1000)
        
    },
});
