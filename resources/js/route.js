import Vue from 'vue';
import VueRouter from 'vue-router';
import PanelLayout from "./layouts/PanelLayout";
import LoginView from "./views/LoginView";
import i18n from "./lang";
import AuthLayout from "./layouts/AuthLayout";
import DashboardView from "./views/DashboardView";

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


