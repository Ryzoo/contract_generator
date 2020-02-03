const defaultState = {
  notifications: {
    unread: [],
    all: []
  }
}

const actions = {
  set_notifications_unread: (context, data) => {
    context.commit('SET_NOT_UNREAD', data)
  },
  set_notifications_all: (context, data) => {
    context.commit('SET_NOT_ALL', data)
  },
  notifications_clear_unread: (context, data) => {
    context.commit('CLEAR_NOT_UNREAD', data)
  }
}

const mutations = {
  SET_NOT_UNREAD: (state, data) => {
    state.notifications.unread = data
  },
  SET_NOT_ALL: (state, data) => {
    state.notifications.all = data
  },
  CLEAR_NOT_UNREAD: (state) => {
    state.notifications.unread = []
  }
}

const getters = {
  notificationUnread: state => state.notifications.unread,
  notificationAll: state => state.notifications.all
}

export default {
  state: defaultState,
  getters,
  actions,
  mutations
}
