import axios from '@/axios';

const actions = {

  // User Account
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

  // Expenses
  async fetchExpenses({commit}) {
    return await axios.get('/expenses')
      .then(res => {
        commit('RETRIVED_EXPENSES', res.data);
      });
  },

  // Income
  async fetchIncomes({commit}) {
    return await axios.get('/incomes')
      .then(res => {
        commit('RETRIVED_INCOMES', res.data);
      });
  },

  // Clients
  async fetchClients({commit}) {
    return await axios.get('/clients')
      .then(res => {
        commit('RETRIVED_CLIENTS', res.data);
      });
  },

  async fetchClientWithInvoices({commit}, id) {
    return await axios.get(`/clients/${id}`);
  },

  async fetchClientInvoices({commit}, id) {
    return await axios.get(`/clients/${id}/invoices`);
  },

  async createClient({commit}, client) {
    return await axios.post('/clients', client)
      .then(res => {
        commit('NEW_CLIENT', res.data);
      });
  },

  async updateClient({commit}, client) {
    return await axios.put('/clients', client)
      .then(res => {
        commit('UPDATED_CLIENT', res.data);
      });
  },

  // Invoices
  async fetchInvoices({commit}) {
    return await axios.get('/invoices')
      .then(res => {
        commit('RETRIVED_INVOICES', res.data);
      });
  },

  async createInvoice({commit}, invoice) {
    return await axios.post('/invoices', invoice)
      .then(res => {
        commit('NEW_INVOICE', res.data);
      });
  },

  async updateInvoice({commit}, invoice) {
    return await axios.put('/invoices', invoice)
      .then(res => {
        commit('UPDATED_INVOICE', res.data);
      });
  },

};

export default actions;