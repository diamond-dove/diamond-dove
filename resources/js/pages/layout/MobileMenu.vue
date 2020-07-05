<template>
  <ul class="nav nav-mobile-menu">
    <li>
      <drop-down>
        <a slot="title" class="dropdown-toggle" data-toggle="dropdown">
          <i class="material-icons">notifications</i>
          <span class="notification">5</span>
          <p>Notifications</p>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
        </ul>
      </drop-down>
    </li>
    <li>
      <drop-down>
        <a slot="title" class="dropdown-toggle" data-toggle="dropdown">
          <i class="material-icons">person</i>
          <p>Profile</p>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><a @click="logout" href="#">Logout</a></li>
        </ul>
      </drop-down>
    </li>
  </ul>
</template>
<script>
export default {
  data() {
    return {
      search: null,
      selectedEmployee: null,
      employees: [
      ]
    };
  },
  methods: {
    logout() {
      this.$store.dispatch('logout');
    }
  }
};
</script>
