<template>
  <form class="container" @submit="checkForm" autocomplete="off">
    <div class="alert alert-danger" role="alert" v-if="errorMessage">
      {{ errorMessage }}
    </div>

    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <input
      type="email"
      id="inputEmail"
      class="form-control"
      placeholder="Email address"
      required
      autofocus
      v-model="email"
    />
    <label for="inputPassword" class="sr-only">Password</label>
    <input
      type="password"
      id="inputPassword"
      class="form-control"
      placeholder="Password"
      required
      v-model="password"
    />

    <button class="btn btn-lg btn-primary btn-block" type="submit">
      Sign in
    </button>
    <router-link :to="{ name: 'dashboard' }">Home</router-link>
  </form>
</template>
<style scoped>
input {
  margin-bottom: 10px;
}
</style>

<script>
export default {
  mounted() {
    console.log("Component mounted login.");
  },
  data: function () {
    return {
      errorMessage: "",
      email: "",
      password: "",
    };
  },

  methods: {
    checkForm: function (e) {
      let self = this;
      axios
        .post("/api/login", {
          email: this.email,
          password: this.password,
        })
        .then(function (response) {
          if (response.data.success === true) {
            localStorage.setItem("token", response.data.data);
            self.$router.push({ name: 'dashboard'})
          }
        })
        .catch(function (error) {
          self.errorMessage = error.response.data.message;
        });

      e.preventDefault();
    },
  },
};
</script>
