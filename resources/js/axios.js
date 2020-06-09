import axios from 'axios';
import { app } from './app';

const headers = {
  'Content-Type': 'application/json',
  'X-Requested-With': 'XMLHttpRequest',
};

let token = document.querySelector('meta[name="csrf-token"]'),
    api_token = localStorage.token;

// if there's a csrf token use it for requests
if (token) {
  headers['X-CSRF-TOKEN'] = token.content;
}

if (api_token) {
  headers.Authorization = `Bearer ${api_token}`;
}

const instance = axios.create({
  baseURL: '/api',
  headers: headers
});

instance.interceptors.response.use(
  response => {
    return response;
  },
  error => {
    if (error.response.status === 401) {
      if (app.$route.name !== 'login' && app.$route.name !== 'register') {
        // localStorage.removeItem('token');
        app.$router.push({name: 'login'});
      }
    } else if (error.response.status === 422) {
      // 
    } else {
      console.error(error);
    }

    return Promise.reject(error);
  }
)

export default instance;