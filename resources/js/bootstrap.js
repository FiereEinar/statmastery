import axios from 'axios';
import $ from 'jquery';
import * as datefns from 'date-fns';
window.$ = $;
window.jQuery = $;
window.axios = axios;
window.datefns = datefns;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
