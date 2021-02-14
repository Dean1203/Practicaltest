/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
var Paginate = require('vuejs-paginate')
Vue.component('paginate', Paginate)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('modal', {
  template: '#modal-template'
})
var app = new Vue({
  el: '#vue-wrapper',

  data: {
    items: [],
    hasError: true,
    hasDeleted: true,
    hasPassError: true,
    showModal: false,
    e_name: '',
    e_email: '',
    e_id: '',
    e_password: '',
    laravelData: {},
    newItem: {'name': '','email': '', 'password': ''},
   },
  mounted: function mounted() {
    this.getVueItems();
  },
  methods: {
    getVueItems: function getVueItems() {
      var _this = this;

      axios.get('/vueitems').then(function (response) {
        _this.items = response.data;
        this.laravelData = response.data;
      });
    },
    setVal(val_id, val_name, val_email) {
        this.e_id = val_id;
        this.e_name = val_name;
        this.e_email = val_email;
    },


    createItem: function createItem() {
      var _this = this;
      var input = this.newItem;
      
      if (input['name'] == '' || input['email'] == '') {
        this.hasError = false;
      } else {
        this.hasError = true;
        axios.post('/vueitems', input).then(function (response) {
          _this.newItem = { 'name': '', 'email': '', 'password': ''};
          _this.getVueItems();
        });
        this.hasDeleted = true;
      }
    },
    editItem: function(){
         var e_id = document.getElementById('e_id');
         var e_name = document.getElementById('e_name');
         var e_email = document.getElementById('e_email');

          axios.post('/edititems/' + e_id.value, {val_1: e_name.value})
            .then(response => {
              this.getVueItems();
              this.showModal=false
            });
          this.hasDeleted = true;
        
  },
    deleteItem: function deleteItem(item) {
      var _this = this;
      axios.post('/vueitems/' + item.id).then(function (response) {
        _this.getVueItems();
        _this.hasError = true, 
        _this.hasDeleted = false
        
      });
    }
  }
});