import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from "./components/ExampleComponent";
import Dashboard from "./components/Dashboard";
import PanelLayout from "./layouts/PanelLayout";

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/panel',
      component: PanelLayout,
      children: [
        {
          path: '/',
          name: 'dashboard',
          component: Dashboard
        },
      ]
    },
  ],
});

export default router;


