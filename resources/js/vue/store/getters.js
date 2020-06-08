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

  token: state => {
    return state.token;
  },
};

export default getters;