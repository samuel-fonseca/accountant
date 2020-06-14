import store from '@/vue/store/index';

const isAuthenticated = (to, from, next) => {
  let authenticated = store.getters.authenticated,
      user = store.getters.user;

  console.log(authenticated, user);

  if(authenticated) {
    next();
  } else {
    if (to.name.toLowerCase() !== 'login' || to.name.toLowerCase() !== 'register')
      next({ name: 'login' });
  }
};

export { isAuthenticated };