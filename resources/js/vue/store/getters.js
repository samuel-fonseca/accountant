const getters = {
  user: state => {
    return state.user;
  },

  authenticated: state => {
    return state.authenticated;
  },

  token: state => {
    return state.token;
  },

  invoices: state => {
    return state.invoices;
  },

  expenses: state => {
    return state.expenses;
  },

  incomes: state => {
    return state.incomes;
  },

  clients: state => {
    return state.clients;
  },
};

export default getters;