import Vue from 'vue';
import VueRouter from 'vue-router';
import PanelLayout from "./layouts/PanelLayout";
import i18n from "./lang";
import AuthLayout from "./layouts/AuthLayout";
import DashboardView from "./views/panel/DashboardView";
import AgreementsView from "./views/panel/AgreementsView";
import LoginView from "./views/auth/LoginView";
import SendResetPasswordTokenView from "./views/auth/SendResetPasswordTokenView";
import RegisterView from "./views/auth/RegisterView";
import ResetPasswordView from "./views/auth/ResetPasswordView";
import CreateAgreementView from "./views/panel/agreements/CreateView";
import MyProfileView from "./views/panel/MyProfileView";
import AccountsView from "./views/panel/AccountsView";
import CreateView from "./views/panel/accounts/CreateView";

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    { path: '/', redirect: 'panel' },
    {
      path: '/panel',
      component: PanelLayout,
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
          path: 'agreements',
          name: 'agreements',
          component: AgreementsView,
          meta: {
            title: i18n.t('pageMeta.panel.agreements.title')
          }
        },
        {
          path: 'agreements/create',
          name: 'createAgreement',
          component: CreateAgreementView,
          meta: {
            title: i18n.t('pageMeta.panel.agreements.create.title')
          },
        },
        {
          path: 'accounts',
          name: 'accounts',
          component: AccountsView,
          meta: {
            title: i18n.t('pageMeta.panel.accounts.title')
          }
        },
        {
          path: 'accounts/create',
          name: 'createAccount',
          component: CreateView,
          meta: {
            title: i18n.t('pageMeta.panel.accounts.create.title')
          },
        },
        {
          path: 'my_profile',
          name: 'my_profile',
          component: MyProfileView,
          meta: {
            title: i18n.t('pageMeta.panel.profile.title')
          }
        },
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
          path: 'resetPassword/:token',
          name: 'resetPassword',
          component: ResetPasswordView,
          meta: {
            title: i18n.t('pageMeta.auth.resetPassword.title'),
            noRequireAuthorization: true
          }
        },
      ]
    },
  ],
});

router.beforeEach((to, from, next) => {
  const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title);

  if(nearestWithTitle)
    document.title = nearestWithTitle.meta.title;

  if (to.matched.some(record => record.meta.noRequireAuthorization)) {
    next();
  } else {
    if (to.path !== '/login') {
      window.auth.checkAuth()
          .then((returned)=>{
            if(returned){
              next();
            }else{
              next({
                path: '/auth/login',
                query: {
                  redirect: to.fullPath ? to.fullPath : null,
                }
              });
            }
          })
          .catch(()=>{
            next({
              path: '/auth/login',
              query: {
                redirect: to.fullPath ? to.fullPath : null,
              }
            });
          });
    } else {
      next();
    }
  }
});

export default router;


