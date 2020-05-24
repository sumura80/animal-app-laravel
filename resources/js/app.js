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

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

// Import TinyMCE
import tinymce from 'tinymce/tinymce';
// A theme is also required
// import 'tinymce/themes/modern/theme';
import 'tinymce/themes/silver/theme';
// Any plugins you want to use has to be imported
import 'tinymce/plugins/paste';
import 'tinymce/plugins/link';
// Initialize the app
tinymce.init({
  selector: '#tiny',
  plugins: ['paste', 'link','table','image'],
  toolbar: "image",
  images_upload_url: '/image/upload',
  menu: {
    table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
    //入力時に改行が<p>にならないように
    // force_br_newlines : true,
    // force_p_newlines : false,
    // forced_root_block : 'div',　// 標準だとpタグ。''だと文字修正を入れるためのstyle="text-align:..."が入らなくなるのでdivタグにしておく
    
  },
  

});
//When you add plugins or menu, you need to run 'npm run dev' and it will be influenced.