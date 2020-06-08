import axios from '@/axios';

const actions = {

  async loginUser ({commit, dispatch}, credentials) {
    return await axios.post('/login', credentials)
      .then(response => {
        const token = response.data.access_token;
        commit('RETRIEVED_TOKEN', token);
        // add the token to axios Authorization header
        axios.defaults.headers.Authorization = `Bearer ${token}`;
        dispatch('fetchUser');
      });
  },

  async fetchUser ({commit}) {
    return await axios.get('/user')
      .then(response => {
        const user = response.data;
        commit('RETRIEVED_USER', user);
      });
  },

  async logoutUser ({commit}) {
    return await axios.post('/logout')
      .then(() => {
        commit('LOGOUT_USER');
      });
  },

};

export default actions;