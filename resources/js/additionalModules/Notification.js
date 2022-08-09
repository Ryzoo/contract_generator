export default class Notification {
  constructor() {
    this.store = null;
    this.router = null;
  }

  setStore(localStore) {
    this.store = localStore;
  }

  setRouter(localRouter) {
    this.router = localRouter;
  }

  getUnread() {
    return axios.get("notifications/unread").then((response) => {
      this.store.dispatch("set_notifications_unread", response.data);
    });
  }

  getAll() {
    return axios.get("notifications").then((response) => {
      this.store.dispatch("set_notifications_all", response.data);
    });
  }

  setAsRead() {
    return axios.post("notifications/asRead").then(() => {
      this.store.dispatch("notifications_clear_unread");
    });
  }
}
