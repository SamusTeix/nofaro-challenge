/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('name-field', require('./components/NameField.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#user-create',
// });

// verificacao ddd
$('input[name="ddd"]').on('keyup', function() {
    if (this.value.length > 2) {
        this.value = this.value.slice(0,2); 
    }
});

// verificacao telefone
$('input[name="phone"]').on('keyup', function() {
    if (this.value.length > 9) {
        this.value = this.value.slice(0,9); 
    }
});

$('#modal-primary').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var id = button.data('id');
  var name = button.data('name');
  var modal = $(this);

  modal.find('.modal-body .name').text(name);
  modal.find('.modal-body .js-delete-user').attr('value', id);
});

$('.js-btn-delete').on('click', function() {
    $.ajax({
        url: 'usuarios/' + $('.js-delete-user').attr('value'),
        type: 'DELETE',
        data: {
            'X-CSRFToken': $('meta[name="csrf-token"]').attr('content')
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function($response) {
            location.reload();
        }
    });
});