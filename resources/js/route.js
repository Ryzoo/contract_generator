import Vue from 'vue';
import VueRouter from 'vue-router';
import PanelLayout from "./layouts/PanelLayout";
import i18n from "./lang";
import AuthLayout from "./layouts/AuthLayout";
import DashboardView from "./views/panel/DashboardView";
import LoginView from "./views/auth/LoginView";
import ResetPassword from "./views/auth/ResetPassword";
import RegisterView from "./views/auth/RegisterView";

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/panel',
      component: PanelLayout,
      children: [
        {
          path: '/',
          name: 'dashboard',
          component: DashboardView,
          meta: {
            title: i18n.t('pageMeta.panel.dashboard.title')
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
            title: i18n.t('pageMeta.auth.login.title')
          }
        },
        {
          path: 'register',
          name: 'register',
          component: RegisterView,
          meta: {
            title: i18n.t('pageMeta.auth.register.title')
          }
        },
        {
          path: 'resetPassword',
          name: 'resetPassword',
          component: ResetPassword,
          meta: {
            title: i18n.t('pageMeta.auth.resetPassword.title')
          }
        },
      ]
    },
  ],
});

router.beforeEach((to, from, next) => {
  const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title);

  console.log(window.i18n);

  if(nearestWithTitle)
    document.title = nearestWithTitle.meta.title;

  next();
});

export default router;


