require('./bootstrap');
import Vue from 'vue'

import Welcome from './components/Welcome.vue';
import Example from './components/Example.vue';

const app = new Vue({
	el: '#app',
	components: { Welcome, Example }
});