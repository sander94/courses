window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from 'vue';

window.Vue = Vue;


import Multiselect from 'vue-multiselect'
import DatePicker from 'vue2-datepicker';

// register globally
Vue.component('multiselect', Multiselect)
Vue.component('datepicker', DatePicker)

