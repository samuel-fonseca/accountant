const getters = {
  user: state => {
    return state.user;
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

  token: state => {
    return state.token;
  },
};

export default getters;