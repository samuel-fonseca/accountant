import Index from '@/views/Index';
import RouterView from '@/views/RouterView';
// Auth Components
import Login from '@/views/Auth/Login';
import Register from '@/views/Auth/Register';
// Dashboard
import DashboardIndex from '@/views/Dashboard/Index';
// Clients
import Clients from '@/views/Clients/Index';
import ClientCreate from '@/views/Clients/Create';

import Invoices from '@/views/Invoices/Index';
import InvoiceCreate from '@/views/Invoices/Create';
import InvoiceReceivePayment from '@components/Invoices/Payments/Receive';
// Expenses
// import Expenses from '@components/Expenses/Index';

import Passport from '@/views/Passport';

import NotFound from '@/views/NotFound';

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
    path: '/invoices/:id',
    component: RouterView,
    beforeEnter: multiguard([isAuthenticated]),
    children: [{
      path: 'payment',
      component: InvoiceReceivePayment
    }, {
      path: 'edit',
      component: InvoiceReceivePayment
    }]
  },
  {
    path: '*',
    name: '404',
    component: NotFound
  }
];

export default routes;