import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
//window.axios.defaults.headers.common['Authorization'] = "Bearer " + access_token;

window.axios.defaults.withCredentials = true;
window.axios.defaults.withXSRFToken = true;
