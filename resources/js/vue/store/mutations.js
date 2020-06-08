import axios from '@/axios';

const mutations = {
  RETRIEVED_USER(state, user) {
    state.user = user;
  },
  
  RETRIEVED_TOKEN(state, token) {
    localStorage.setItem('token', token);
    state.token = token;
    // add the token to axios Authorization header
    axios.defaults.headers.Authorization = `Bearer ${token}`;
  },

  LOGOUT_USER(state) {
    localStorage.removeItem('token');
    state.token = null;
    state.user = {};
  },
};

export default mutations;
