const mutations = {
  /**
   * Assign user to the state
   * @param {*} state 
   * @param {Object} user 
   */
  RETRIEVED_USER(state, user) {
    state.user = user;
    state.authenticated = true;
  },

  /**
   * Log user out and delete token
   * @param {*} state 
   */
  LOGOUT_USER(state) {
    localStorage.removeItem('token');
    state.authenticated = false;
    state.token = null;
    state.user = {};
  },
  
  RETRIEVED_TOKEN(state, token) {
    localStorage.setItem('token', token);
    state.token = token;
    state.authenticated = true;
  },
  
  RETRIVED_EXPENSES(state, expenses) {
    state.expenses = expenses;
  },

  RETRIVED_INCOMES(state, incomes) {
    state.incomes = incomes;
  },

  // Clients
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

  // Invoices
  INVOICES_RETRIEVED(state, invoices) {
    state.invoices = invoices;
  },

  INVOICE_DELETED(state, id) {
    let index = state.invoices.findIndex(i => i.id === id);
    
    if (index)
      state.invoices.splice(index, 1);
  },

  INVOICE_CREATED(state, invoice) {
    state.invoices.push(invoice);
  },

  INVOICE_UPDATED(state, invoice) {
    let index = state.invoices.findIndex(i => i.id === invoice.id);

    if (index) {
      state.invoices[index] = invoice;
    }
  },
};

export default mutations;
