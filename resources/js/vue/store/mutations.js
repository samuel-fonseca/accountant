const mutations = {
  RETRIEVED_USER(state, user) {
    state.user = user;
  },
  
  RETRIEVED_TOKEN(state, token) {
    localStorage.setItem('token', token);
    state.token = token;
  },
};

export default mutations;
