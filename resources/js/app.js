/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import Antd from 'ant-design-vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import WeatherDashboardComponent from './components/WeatherDisplay.vue';
app.component('weather-display', WeatherDashboardComponent);

import WelcomePage from './components/WelcomePage.vue';
app.component('welcome-display', WelcomePage);


app.mount('#app');
