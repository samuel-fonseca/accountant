import Index from '@components/Index';
import RouterView from '@components/RouterView';
// Auth Components
import Login from '@components/Auth/Login';
import Register from '@components/Auth/Register';
// Dashboard
import DashboardIndex from '@components/Dashboard/Index';
// Clients
import Clients from '@components/Clients/Index';
import ClientCreate from '@components/Clients/Create';

import Invoices from '@components/Invoices/Index';
import InvoiceCreate from '@components/Invoices/Create';
// Expenses
// import Expenses from '@components/Expenses/Index';

import Passport from '@components/passport/Index';

import NotFound from '@components/NotFound';

import multiguard from 'vue-router-multiguard';
import { isAuthenticated } from './guards';

const routes = [
  {
    path: '/',
    name: 'home',
    component: Index
  },
  {
    path: '/passport',
    name: 'passport',
    component: Passport
  },
  {
    path: '/login',
    name: 'login',
    component: Login
  },
  {
    path: '/register',
    name: 'register',
    component: Register
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: DashboardIndex,
    beforeEnter: multiguard([isAuthenticated])
  },
  {
    path: '/clients',
    component: RouterView,
    beforeEnter: multiguard([isAuthenticated]),
    children: [{
      path: '',
      name: 'clients.home',
      component: Clients,
    }, {
      path: 'create',
      name: 'clients.create',
      component: ClientCreate
    }],
  },
  {
    path: '/invoices',
    component: RouterView,
    beforeEnter: multiguard([isAuthenticated]),
    children: [{
      path: '',
      name: 'invoices.home',
      component: Invoices,
    }, {
      path: 'create',
      name: 'invoices.create',
      component: InvoiceCreate
    }],
  },

  {
    path: '*',
    name: '404',
    component: NotFound
  }
];

export default routes;