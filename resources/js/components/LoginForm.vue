<template>
  <form>
    <md-card>
      <md-card-header :data-background-color="dataBackgroundColor">
        <h4 class="title">Login</h4>
      </md-card-header>

      <md-card-content>
        <div class="md-layout">
          <div class="md-layout-item md-small-size-100 md-size-100">
            <div class="alert alert-danger" v-if="error" >
              <button type="button" aria-hidden="true" class="close">
                ×
              </button>
              <span
              ><b> Error - </b> Su login fue invalido, verifique su usuario y contraseña</span
              >
            </div>
          </div>
          <div class="md-layout-item md-small-size-100 md-size-100">
            <md-field>
              <label>Email</label>
              <md-input v-model="email" type="text"></md-input>
            </md-field>
          </div>
          <div class="md-layout-item md-small-size-100 md-size-100">
            <md-field>
              <label>Password</label>
              <md-input v-model="password" type="password"></md-input>
            </md-field>
          </div>
          <div class="md-layout-item md-size-100 text-right">
            <md-button @click="login" class="md-raised md-success">Login</md-button>
          </div>
        </div>
      </md-card-content>
    </md-card>
  </form>
</template>
<script>
  import { mapActions } from 'vuex'

export default {
  name: "login-form",
  props: {
    dataBackgroundColor: {
      type: String,
      default: ""
    }
  },
  data() {
    return {
      email: null,
      password: null,
      error: null
    };
  },
  methods: {
    ...mapActions({
      signIn: 'auth/signIn'
    }),
    async login () {

      try {
        await this.signIn({
          email: this.email,
          password: this.password
        });
        this.$router.push({ name: 'Dashboard' });
      } catch (e) {
        this.error = true;
      }



    }
  }
};
</script>
<style></style>
