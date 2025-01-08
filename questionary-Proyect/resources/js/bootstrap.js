
import 'bootstrap/dist/css/bootstrap.min.css';


import 'bootstrap';

// Si usas axios, ya lo has configurado correctamente
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
