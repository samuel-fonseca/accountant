const mutations = {
  RETRIEVED_USER(state, user) {
    state.user = user;
  },
  
  RETRIEVED_TOKEN(state, token) {
    localStorage.setItem('token', token);
    state.token = token;
  },

  LOGOUT_USER(state) {
    localStorage.removeItem('token');
    state.token = null;
    state.user = {};
  },
};

export default mutations;
