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

  async registerUser ({commit, dispatch}, credentials) {
    return await axios.post('/register', credentials)
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
      })
      .catch(() => {
        commit('LOGOUT_USER');
      });
  },

  async logoutUser ({commit}) {
    return await axios.post('/logout')
      .then(() => {
        commit('LOGOUT_USER');
      });
  },

  async fetchExpenses({commit}) {
    return await axios.get('/expenses')
      .then(res => {
        commit('RETRIVED_EXPENSES', res.data);
      });
  },

  async fetchIncomes({commit}) {
    return await axios.get('/incomes')
      .then(res => {
        commit('RETRIVED_INCOMES', res.data);
      });
  },

  async fetchClients({commit}) {
    return await axios.get('/clients')
      .then(res => {
        commit('RETRIVED_CLIENTS', res.data);
      });
  },

  async createClient({commit}, client) {
    return await axios.post('/clients')
      .then(res => {
        commit('NEW_CLIENT', res.data);
      });
  },

};

export default actions;