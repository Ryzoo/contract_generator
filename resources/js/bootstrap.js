import Notify from './additionalModules/Notify'
import Auth from './additionalModules/Auth'
import Notification from './additionalModules/Notification'

try {
  window.$ = window.jQuery = require('jquery')
} catch (e) {}

window.Notify = window.notify = new Notify()
window.auth = new Auth()
window.Notification = new Notification()

window.axios = require('axios')
window.axios.defaults.baseURL = '/api'
window.axios.defaults.headers.post['Content-Type'] = 'application/json'
window.axios.interceptors.response.use(
  function (response) {
    return response
  },
  function (error) {
    if (error.response !== undefined && error.response.data && ((error.response.data.error && error.response.data.error.length > 0) || error.response.data.errors)) {
      if (error.response.status === 401 && window.auth && !window.location.pathname.includes('/auth/login')) {
        window.auth.logout()
        return
      }

      if (error.response.data.errors) {
        const errorMsg = error.response.data.errors[Object.keys(error.response.data.errors)[0]][0]

        if (errorMsg) { window.notify.push(errorMsg, window.notify.ERROR) }
      } else {
        window.notify.push(error.response.data.error, window.notify.ERROR)
      }
    }
    return Promise.reject(error)
  }
)
