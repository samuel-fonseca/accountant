const mutations = {
  RETRIEVED_USER(state, user) {
    state.user = user;
  },
  
  RETRIEVED_TOKEN(state, token) {
    localStorage.setItem('token', token);
    state.token = token;
  },

  RETRIVED_EXPENSES(state, expenses) {
    state.expenses = expenses;
  },

  RETRIVED_INCOMES(state, incomes) {
    state.incomes = incomes;
  },

  RETRIVED_CLIENTS(state, clients) {
    state.clients = clients;
  },

  NEW_CLIENT(state, client) {
    state.clients.push(client);
  },

  UPDATE_CLIENT(state, client) {
    let index = state.clients.findIndex(c => c.id === client.id);

    if (index) {
      state.clients[index] = client;
    } else {
      state.clients.push(client);
    }
  },

  LOGOUT_USER(state) {
    localStorage.removeItem('token');
    state.token = null;
    state.user = {};
  },
};

export default mutations;
