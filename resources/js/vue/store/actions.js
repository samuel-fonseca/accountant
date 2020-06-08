import axios from '@/axios';

const actions = {

  async attemptLogin ({commit}, credentials) {
    return await axios.post('/login', credentials)
      .then(response => {
        const token = response.data.access_token;
        commit('RETRIEVED_TOKEN', token);
      });
  },

  async fetchUser ({commit}) {
    return await axios.get('/user')
      .then(response => {
        const user = response.data;
        commit('RETRIEVED_USER', user);
      });
  },

};

export default actions;