<template>
  <div>dashboard</div>
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
            window.location = "/dashboard";
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
