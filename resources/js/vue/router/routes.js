// Auth Components
import Login from '@components/Auth/Login';
import Register from '@components/Auth/Register';
// Dashboard
import DashboardIndex from '@components/Dashboard/Index';

const routes = [
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {},
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {},
  },

  {
    path: '/dashboard',
    name: 'dashboard',
    component: DashboardIndex
  }
];

export default routes;