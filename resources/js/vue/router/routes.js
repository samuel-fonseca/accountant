import RouterView from '@components/RouterView';
// Auth Components
import Login from '@components/Auth/Login';
import Register from '@components/Auth/Register';
// Dashboard
import DashboardIndex from '@components/Dashboard/Index';
// Clients
import Clients from '@components/Clients/Index';
import ClientCreate from '@components/Clients/Create';
// Expenses
// import Expenses from '@components/Expenses/Index';

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
    component: DashboardIndex,
  },
  {
    path: '/clients',
    component: RouterView,
    children: [{
      path: '',
      name: 'clients.home',
      component: Clients,
    }, {
      path: 'create',
      name: 'clients.create',
      component: ClientCreate
    }],
  }
];

export default routes;