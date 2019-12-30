import Vue from 'vue'
import VueRouter from 'vue-router'
import AdminPanelLayout from './layouts/AdminPanelLayout'
import i18n from './lang'
import AuthLayout from './layouts/AuthLayout'
import DashboardView from './views/panel/DashboardView'
import ContractListView from './views/panel/contracts/ContractListView'
import LoginView from './views/auth/LoginView'
import SendResetPasswordTokenView
  from './views/auth/SendResetPasswordTokenView'
import RegisterView from './views/auth/RegisterView'
import ResetPasswordView from './views/auth/ResetPasswordView'
import ContractBuilderView
  from './views/panel/contracts/ContractBuilderView'
import MyProfileView from './views/panel/settings/MyProfileView'
import AccountsView from './views/panel/settings/AccountsView'
import AccountPreview
  from './views/panel/settings/accounts/AccountPreview'
import CreateView from './views/panel/settings/accounts/CreateView'
import EditView from './views/panel/settings/accounts/EditView'
import EditRoleView from './views/panel/settings/roles/EditView'
import ContractForm from './views/client/contract/ContractForm'
import CreateBaseView from './views/panel/contracts/CreateBaseView'
import RolesView from './views/panel/settings/RolesView'
import CreateRolesView from './views/panel/settings/roles/CreateView'
import NoAccessView from './views/common/NoAccessView'
import NotFoundView from './views/common/NotFoundView'

import { Permissions } from './additionalModules/Permissions'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/no-access',
      component: NoAccessView,
      meta: {
        title: i18n.t('pageMeta.common.noAccess.title'),
        noRequireAuthorization: true
      }
    },
    {
      path: '/not-found',
      component: NotFoundView,
      meta: {
        title: i18n.t('pageMeta.common.notFound.title'),
        noRequireAuthorization: true
      }
    },
    {
      path: '/form',
      component: ContractForm,
      meta: {
        noRequireAuthorization: true
      }
    },
    { path: '/', redirect: 'auth/login' },
    {
      path: '/panel',
      component: AdminPanelLayout,
      children: [
        { path: '/', redirect: 'dashboard' },
        {
          path: 'dashboard',
          name: 'dashboard',
          component: DashboardView,
          meta: {
            title: i18n.t('pageMeta.panel.dashboard.title')
          }
        },
        {
          path: 'contracts/list',
          name: 'contractList',
          component: ContractListView,
          meta: {
            title: i18n.t('pageMeta.panel.contract.title'),
            access: [
              Permissions.MANAGE_CONTRACTS
            ]
          }
        },
        {
          path: 'contracts/new',
          name: 'createContract',
          component: CreateBaseView,
          meta: {
            title: i18n.t('pageMeta.panel.contract.create.title'),
            access: [
              Permissions.MANAGE_CONTRACTS
            ]
          }
        },
        {
          path: 'contracts/edit/:id',
          name: 'editContract',
          component: CreateBaseView,
          meta: {
            title: i18n.t('pageMeta.panel.contract.edit.title'),
            access: [
              Permissions.MANAGE_CONTRACTS
            ]
          }
        },
        {
          path: 'contracts/builder',
          name: 'buildContract',
          component: ContractBuilderView,
          meta: {
            title: i18n.t('pageMeta.panel.contract.builder.title'),
            access: [
              Permissions.MANAGE_CONTRACTS
            ]
          }
        },
        {
          path: 'settings/accounts',
          name: 'accounts',
          component: AccountsView,
          meta: {
            title: i18n.t('pageMeta.panel.accounts.title'),
            access: [
              Permissions.MANAGE_USERS
            ]
          }
        },
        {
          path: 'settings/accounts/create',
          name: 'createAccount',
          component: CreateView,
          meta: {
            title: i18n.t('pageMeta.panel.accounts.create.title'),
            access: [
              Permissions.MANAGE_USERS
            ]
          }
        },
        {
          path: 'settings/accounts/:id/edit',
          name: 'editAccount',
          component: EditView,
          meta: {
            title: i18n.t('pageMeta.panel.accounts.edit.title'),
            access: [
              Permissions.MANAGE_USERS
            ]
          }
        },
        {
          path: 'settings/accounts/:id',
          name: 'accountPreview',
          component: AccountPreview,
          meta: {
            title: i18n.t('pageMeta.panel.accounts.preview.title')
          }
        },
        {
          path: 'settings/my_profile',
          name: 'my_profile',
          component: MyProfileView,
          meta: {
            title: i18n.t('pageMeta.panel.profile.title')
          }
        },
        {
          path: 'settings/roles',
          name: 'roles',
          component: RolesView,
          meta: {
            title: i18n.t('pageMeta.panel.roles.title'),
            access: [
              Permissions.MANAGE_ROLES
            ]
          }
        },
        {
          path: 'settings/roles/create',
          name: 'createRoles',
          component: CreateRolesView,
          meta: {
            title: i18n.t('pageMeta.panel.roles.create.title'),
            access: [
              Permissions.MANAGE_ROLES
            ]
          }
        },
        {
          path: 'settings/roles/:id/edit',
          name: 'editRole',
          component: EditRoleView,
          meta: {
            title: i18n.t('pageMeta.panel.roles.edit.title'),
            access: [
              Permissions.MANAGE_ROLES
            ]
          }
        }
      ]
    },
    {
      path: '/auth',
      component: AuthLayout,
      children: [
        {
          path: 'login',
          name: 'login',
          component: LoginView,
          meta: {
            title: i18n.t('pageMeta.auth.login.title'),
            noRequireAuthorization: true
          }
        },
        {
          path: 'register',
          name: 'register',
          component: RegisterView,
          meta: {
            title: i18n.t('pageMeta.auth.register.title'),
            noRequireAuthorization: true
          }
        },
        {
          path: 'sendResetPasswordToken',
          name: 'sendResetPasswordToken',
          component: SendResetPasswordTokenView,
          meta: {
            title: i18n.t('pageMeta.auth.sendResetPasswordToken.title'),
            noRequireAuthorization: true
          }
        },
        {
          path: 'resetPassword',
          name: 'resetPassword',
          component: ResetPasswordView,
          meta: {
            title: i18n.t('pageMeta.auth.resetPassword.title'),
            noRequireAuthorization: true
          }
        }
      ]
    }
  ]
})

router.beforeEach((to, from, next) => {
  const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title)

  if (nearestWithTitle) {
    document.title = nearestWithTitle.meta.title
  }

  if (to.matched.length === 0) {
    next({
      path: '/not-found'
    })
  }

  if (to.meta && to.meta.access && !to.meta.access.every(z => auth.checkPermission(z))) {
    next({
      path: '/no-access'
    })
  }

  if (to.matched.some(record => record.meta.noRequireAuthorization)) {
    window.auth.checkAuth()
      .finally(() => {
        next()
      })
  } else {
    if (to.path !== '/login') {
      window.auth.checkAuth()
        .then((returned) => {
          if (returned) {
            next()
          } else {
            next({
              path: '/auth/login',
              query: {
                redirect: to.fullPath ? to.fullPath : null
              }
            })
          }
        })
        .catch(() => {
          next({
            path: '/auth/login',
            query: {
              redirect: to.fullPath ? to.fullPath : null
            }
          })
        })
    } else {
      next()
    }
  }
})

export default router
