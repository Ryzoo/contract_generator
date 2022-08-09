<template>
  <v-row>
    <v-col v-if="isAdmin">
      <AdminDashboard />
    </v-col>
    <v-col v-else>
      <UserDashboard />
    </v-col>
  </v-row>
</template>

<script>
import { Roles } from "../../additionalModules/Roles";
import UserDashboard from "../../components/Dashboard/UserDashboard";
import AdminDashboard from "../../components/Dashboard/AdminDashboard";

export default {
  name: "Dashboard",
  components: {
    UserDashboard,
    AdminDashboard,
  },
  data() {
    return {
      isAdmin: false,
    };
  },
  mounted() {
    this.isAdmin = this.Auth.checkRole(Roles.ADMIN);
  },
};
</script>
