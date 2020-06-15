import store from '@/vue/store/index';

// const user = store.getters.user;

const isAuthenticated = (to, from, next) => {
  const authenticated = store.getters.authenticated;
  
  if(authenticated) {
    next();
  } else {
    if (to.name.toLowerCase() !== 'login' || to.name.toLowerCase() !== 'register')
      next({ name: 'login' });
  }
};

export { isAuthenticated };