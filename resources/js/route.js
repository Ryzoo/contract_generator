import Vue from 'vue';
import VueRouter from 'vue-router';
import AdminPanelLayout from "./layouts/AdminPanelLayout";
import i18n from "./lang";
import AuthLayout from "./layouts/AuthLayout";
import DashboardView from "./views/panel/admin/DashboardView";
import ContractView from "./views/panel/admin/ContractView";
import LoginView from "./views/auth/LoginView";
import SendResetPasswordTokenView from "./views/auth/SendResetPasswordTokenView";
import RegisterView from "./views/auth/RegisterView";
import ResetPasswordView from "./views/auth/ResetPasswordView";
import ContractBuilderView from "./views/panel/admin/contracts/ContractBuilderView";
import MyProfileView from "./views/panel/admin/settings/MyProfileView";
import AccountsView from "./views/panel/admin/settings/AccountsView";
import AccountPreview from "./views/panel/admin/settings/accounts/AccountPreview";
import CreateView from "./views/panel/admin/settings/accounts/CreateView";
import EditView from "./views/panel/admin/settings/accounts/EditView";
import ContractForm from "./views/client/contract/ContractForm";
import CreateBaseView from "./views/panel/admin/contracts/CreateBaseView";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/form',
            component: ContractForm,
            meta: {
                noRequireAuthorization: true
            }
        },
        {path: '/', redirect: 'auth/login'},
        {
            path: '/panel/admin',
            component: AdminPanelLayout,
            children: [
                {path: '/', redirect: 'dashboard'},
                {
                    path: 'dashboard',
                    name: 'dashboard',
                    component: DashboardView,
                    meta: {
                        title: i18n.t('pageMeta.panel.admin.dashboard.title')
                    }
                },
                {
                    path: 'contracts',
                    name: 'contracts',
                    component: ContractView,
                    meta: {
                        title: i18n.t('pageMeta.panel.admin.contract.title')
                    }
                },
                {
                    path: 'contracts/new',
                    name: 'createContract',
                    component: CreateBaseView,
                    meta: {
                        title: i18n.t('pageMeta.panel.admin.contract.create.title')
                    },
                },
                {
                    path: 'contracts/edit/:id',
                    name: 'editContract',
                    component: CreateBaseView,
                    meta: {
                        title: i18n.t('pageMeta.panel.admin.contract.edit.title')
                    },
                },
                {
                    path: 'contracts/builder',
                    name: 'buildContract',
                    component: ContractBuilderView,
                    meta: {
                        title: i18n.t('pageMeta.panel.admin.contract.builder.title')
                    },
                },
                {
                    path: 'settings/accounts',
                    name: 'accounts',
                    component: AccountsView,
                    meta: {
                        title: i18n.t('pageMeta.panel.admin.accounts.title')
                    }
                },
                {
                    path: 'settings/accounts/create',
                    name: 'createAccount',
                    component: CreateView,
                    meta: {
                        title: i18n.t('pageMeta.panel.admin.accounts.create.title')
                    },
                },
                {
                    path: 'settings/accounts/:id/edit',
                    name: 'editAccount',
                    component: EditView,
                    meta: {
                        title: i18n.t('pageMeta.panel.admin.accounts.edit.title')
                    },
                },
                {
                    path: 'settings/accounts/:id',
                    name: 'accountPreview',
                    component: AccountPreview,
                    meta: {
                        title: i18n.t('pageMeta.panel.admin.accounts.preview.title')
                    },
                },
                {
                    path: 'settings/my_profile',
                    name: 'my_profile',
                    component: MyProfileView,
                    meta: {
                        title: i18n.t('pageMeta.panel.admin.profile.title')
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
                    path: 'resetPassword',
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

    if (nearestWithTitle) {
        document.title = nearestWithTitle.meta.title;
    }

    if (to.matched.some(record => record.meta.noRequireAuthorization)) {
        window.auth.checkAuth()
            .finally(()=>{
                next();
            });
    }
    else {
        if (to.path !== '/login') {
            window.auth.checkAuth()
                .then((returned) => {
                    if (returned) {
                        next();
                    }
                    else {
                        next({
                            path: '/auth/login',
                            query: {
                                redirect: to.fullPath ? to.fullPath : null,
                            }
                        });
                    }
                })
                .catch(() => {
                    next({
                        path: '/auth/login',
                        query: {
                            redirect: to.fullPath ? to.fullPath : null,
                        }
                    });
                });
        }
        else {
            next();
        }
    }
});

export default router;


