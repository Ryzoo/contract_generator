export default class Auth {
  constructor () {
    this.store = null
    this.router = null
  }

  login (userData, route) {
    this.authorize(userData)
    this.router.push((route && route.length > 0) ? route : '/panel/')
  }

  isAuthorized () {
    return !!this.store.getters.authUser.loginToken
  }

  checkPermission (permission) {
    if (!this.store) { return true }
    if (!this.store.getters.authUser || !this.store.getters.authUser.permissions) { return false }

    return this.store.getters.authUser.permissions.some(x => x.slug === permission)
  }

  checkRole (role) {
    if (!this.store) { return true }
    if (!this.store.getters.authUser || !this.store.getters.authUser.roles) { return false }

    return this.store.getters.roles.some(x => x.slug === role)
  }

  authorize (userData) {
    localStorage.setItem('login_token', userData.loginToken)
    window.axios.defaults.headers.common.Authorization = 'Bearer ' + userData.loginToken
    this.store.dispatch('authUser', userData)
  }

  logout () {
    localStorage.removeItem('login_token')
    window.axios.defaults.headers.common.Authorization = ''
    this.store.dispatch('authUser', null)
    this.router.push('/auth/login')
  }

  setStore (localStore) {
    this.store = localStore
  }

  setRouter (localRouter) {
    this.router = localRouter
  }

  checkAuth () {
    return new Promise((resolve, reject) => {
      const loginTokenCache = localStorage.getItem('login_token')
      let loginTokenStore = (this.store && this.store.getters.authUser) ? this.store.getters.authUser.loginToken : ''

      if (loginTokenStore.length === 0) {
        loginTokenStore = loginTokenCache
      }

      if (loginTokenStore) {
        window.axios.defaults.headers.common.Authorization = 'Bearer ' + loginTokenStore
        axios.post('/auth/authorize', { loginToken: loginTokenStore })
          .then((response) => {
            if (response.data) {
              auth.authorize(response.data)
              resolve(response.data)
            } else {
              resolve(null)
            }
          })
          .catch((error) => {
            reject(error)
          })
      } else {
        resolve(null)
      }
    })
  }
};
